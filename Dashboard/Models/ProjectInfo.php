<?php

namespace Dashboard\Models;
use \Dashboard\Utils;
use \Dashboard\PipeLine;

class ProjectInfo extends \Dashboard\Middleware\Model{
	protected $utils;
	public function __construct(){
		$this -> utils = new Utils();
	}

	public function get_project_info($project_data){
		$project = new PipeLine();

		// SEARCH INFO FILES
		$project -> pipe(function($data){
			$dashboard_json = $this -> get_dashboard_json_file($data['path']);
			if(isset($dashboard_json['path_to_project'])){
				if(file_exists($dashboard_json['path_to_project'])){
					$new_path = $dashboard_json['path_to_project'];
				}else{
					$new_path = $data['path'] . '/' . $dashboard_json['path_to_project'];
				}
				$dashboard_json = $this -> get_dashboard_json_file($new_path);
				$data['path'] = $new_path;
			}

			$data['info_files'] = [
				'dashboard.json' => $dashboard_json,
				'package.json' => $this -> get_package_json_file($data['path'])
			];

			return $data;
		});

		// LAST UPDATE
		$project -> pipe(function($data){
			$data['last_update'] = filemtime($data['path']);
			return $data;
		});

		$project -> pipe(function($data){
			$data['project'] = [];
			return $data;
		});

		// BASE PROJECT DATA
		$project -> pipe(function($data){
			$data['project'] = !isset($data['info_files']['dashboard.json']) ? [] : $data['info_files']['dashboard.json'];
			return $data;
		});

		// Default type is web
		$project -> pipe(function($data){
			if(!isset($data['project']['type']) or !$data['project']['type']){
				$data['project']['type'] = 'web';
			}
			return $data;
		});

		// IF dashboard.json not exists
		$project -> pipe(function($data){
			if(!isset($data['project']['name'])){
				if(isset($data['info_files']['package.json']) and isset($data['info_files']['package.json']['name'])){
					$data['project']['name'] = $data['info_files']['package.json']['name'];
				}
			}
			if(!isset($data['project']['ver'])){
				if(isset($data['info_files']['package.json']) and isset($data['info_files']['package.json']['version'])){
					$data['project']['ver'] = $data['info_files']['package.json']['version'];
				}
			}
			if(!isset($data['project']['author']) or !$data['project']['author']){
				if(isset($data['info_files']['package.json']) and isset($data['info_files']['package.json']['author'])){
					$data['project']['author'] = $data['info_files']['package.json']['author'];
				}
			}
			if(!isset($data['project']['git_url'])){
				if(isset($data['info_files']['package.json']) and isset($data['info_files']['package.json']['homepage'])){
					$data['project']['git_url'] = $data['info_files']['package.json']['homepage'];
				}
			}
			if(!isset($data['project']['description'])){
				if(isset($data['info_files']['package.json']) and isset($data['info_files']['package.json']['description'])){
					$data['project']['description'] = $data['info_files']['package.json']['description'];
				}
			}
			return $data;
		});

		// FAVICON
		$project -> pipe(function($data){
			if(!isset($data['project']) or !isset($data['project']['type']) or $data['project']['type'] != 'web'){
				return $data;
			}

			if(!isset($data['project']['favicon']) or !$data['project']['favicon']){
				$favicon = $this -> utils() -> deep_search_file($data['path'], 'favicon.');

				if(isset($favicon) and $favicon){
					$path_to_fav = explode($data['name'], $favicon['path']);
					$path_to_fav[1] = 'http://' . $data['name'] . $path_to_fav[1];
					unset($path_to_fav[0]);
					$data['project']['favicon'] = implode($data['name'], $path_to_fav);
				}
			}
			return $data;
		});

		// SEARCH GIT URL
		$project -> pipe(function($data){
			if(!isset($data['project']['git_url']) or !$data['project']['git_url']){
				$git_conf = $data['path'] . DIRECTORY_SEPARATOR . '.git/config';
				if(file_exists($git_conf)){
					$git_conf_file = file_get_contents($git_conf);
					$sep = '.git';
					list($git_conf_file) = explode($sep, $git_conf_file);
					list(, $git_url) = explode('url = ', $git_conf_file);
					$data['project']['git_url'] = $git_url;
				}
			}

			return $data;
		});

		// INFO ABOUT PROJECT FILES
		$project -> pipe(function($data){
			$data['project']['scan'] = [
				'list' => ['all' => $this -> utils -> scandirs($data['path'])],
				'fsize' => 0
			];

			if(is_array($data['project']['scan']['list']['all'])){
				$filtered = array_filter($data['project']['scan']['list']['all'], function($item){
					return strpos($item, DIRECTORY_SEPARATOR . '.') === false;
				});
			}else{
				$filtered = [];
			}

			$data['project']['scan']['list']['filtered'] = [
				'folders' => [],
				'files' => [],
				'total' => []
			];

			foreach($filtered as $i => $item){
				if(is_file($item)){
					$data['project']['scan']['list']['filtered']['files'][] = $item;
					$data['project']['scan']['fsize'] += filesize($item);
				}else{
					$data['project']['scan']['list']['filtered']['folders'][] = $item;
				}
			}
			$data['project']['scan']['list']['filtered']['total'] = [
				'folders' => count($data['project']['scan']['list']['filtered']['folders']),
				'files' => count($data['project']['scan']['list']['filtered']['files'])
			];

			$data['project']['scan']['fsize'] = $this -> utils -> filesize_formatted($data['project']['scan']['fsize']);
			return $data;
		});

		return $project -> through_the_pipe($project_data);
	}

	public function get_package_json_file($path_to_dir){
		$package_json_file = $path_to_dir . '/package.json';
		if(!file_exists($package_json_file)){
			return null;
		}

		return json_decode(file_get_contents($package_json_file), true);
	}

	public function get_dashboard_json_file($path_to_dir){
		$project_file = $path_to_dir . '/dashboard.json';
		$project_file_legacy = $path_to_dir . '/project.json';
		if(!file_exists($project_file)){
			if(!file_exists($project_file_legacy)){
				return null;
			}
			$project_file = $project_file_legacy;
		}

		$project_json = json_decode(file_get_contents($project_file), true);
		return $project_json;
	}
}