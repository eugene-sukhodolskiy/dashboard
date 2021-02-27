<?php

namespace Dashboard\Models;
use \Dashboard\Utils;

class Projects extends \Dashboard\Middleware\Model{
	protected $path_to_hidden_list_file = PROJECT_FOLDER . '/hidden-list.json';
	protected $utils;

	public function __construct(){
		$this -> utils = new Utils();
	}

	public function data_addition($name, $project, $path){
		$project = is_array($project) ? $project : [];

		if(!isset($project['favicon'])){
			$favicon = $this -> utils() -> deep_search_file($path, 'favicon.');

			if(isset($favicon) and $favicon){
				$path_to_fav = explode($name, $favicon['path']);
				$path_to_fav[1] = 'http://' . $name . $path_to_fav[1];
				unset($path_to_fav[0]);
				$project['favicon'] = implode($name, $path_to_fav);
			}
		}

		if(!isset($project['git_url'])){
			$git_conf = $path . DIRECTORY_SEPARATOR . '.git/config';
			if(file_exists($git_conf)){
				$git_conf_file = file_get_contents($git_conf);
				$sep = '.git';
				list($git_conf_file) = explode($sep, $git_conf_file);
				list(, $git_url) = explode('url = ', $git_conf_file);
				$project['git_url'] = $git_url;
			}
		}


		$project['scan'] = [
			'list' => ['all' => $this -> utils -> scandirs($path)],
			'fsize' => 0
		];

		if(is_array($project['scan']['list']['all'])){
			$filtered = array_filter($project['scan']['list']['all'], function($item){
				return strpos($item, DIRECTORY_SEPARATOR . '.') === false;
			});
		}else{
			$filtered = [];
		}

		$project['scan']['list']['filtered'] = [
			'folders' => [],
			'files' => [],
			'total' => []
		];

		foreach($filtered as $i => $item){
			if(is_file($item)){
				$project['scan']['list']['filtered']['files'][] = $item;
				$project['scan']['fsize'] += filesize($item);
			}else{
				$project['scan']['list']['filtered']['folders'][] = $item;
			}
		}
		$project['scan']['list']['filtered']['total'] = [
			'folders' => count($project['scan']['list']['filtered']['folders']),
			'files' => count($project['scan']['list']['filtered']['files'])
		];

		$project['scan']['fsize'] = $this -> utils -> filesize_formatted($project['scan']['fsize']);

		return $project;
	}

	public function get_projects_list($filters){
		$folders = FCONF['projects_folders'];
		$self = $this;
		$projects = [];
		foreach($folders as $folder){
			$projects = array_merge($projects, (function($projects_folder) use($self){
				$dirs = scandir($projects_folder);
				$projects = [];
				foreach ($dirs as $i => $item) {
					if(!is_file($item) and $item != '.' and $item != '..'){
						$path = $projects_folder . '/' . $item;
						$project = $self -> analize_project_file($path);
						$project = $self -> data_addition($item, $project, $path);

						$last_update = filemtime($path);

						$projects[] = [
							"name" => $item,
							"path" => $path,
							"project" => $project,
							"last_update" => $last_update
						];
					}
				}

				return $projects;
			})($folder));
		}

		$hidden_list = $this -> get_hidden_projects();
		$projects = array_filter($projects, function($project) use($hidden_list){
			return !in_array(strtolower($project['name']), $hidden_list);
		});
		
		usort($projects, function($a, $b){
			return $b['last_update'] - $a['last_update'];
		});

		if(isset($filters['status']) and $filters['status']){
			foreach($projects as $i => $project){
				if(!isset($project['project']['status']) or $project['project']['status'] != $filters['status']){
					unset($projects[$i]);
				}
			}
		}

		return $projects;
	}

	protected function analize_project_file(&$path_to_dir){
		$project_file = $path_to_dir . '/dashboard.json';
		$project_file_legacy = $path_to_dir . '/project.json';
		if(!file_exists($project_file)){
			if(!file_exists($project_file_legacy)){
				return null;
			}
			$project_file = $project_file_legacy;
		}

		$project_json = json_decode(file_get_contents($project_file), true);
		if(isset($project_json['path_to_project'])){
			$path_to_dir = $path_to_dir . '/' . $project_json['path_to_project'];
			return $this -> analize_project_file($path_to_dir);
		}
		return $project_json;
	}

	public function get_hidden_projects(){
		return json_decode(file_get_contents($this -> path_to_hidden_list_file));
	}

	public function add_to_hidden_list($project_name){
		$project_name = strtolower($project_name);
		$hidden_list = $this -> get_hidden_projects();
		if(!in_array($project_name, $hidden_list)){
			$hidden_list[] = $project_name;
			return file_put_contents($this -> path_to_hidden_list_file, json_encode($hidden_list, JSON_PRETTY_PRINT));
		}

		return false;
	}

	public function remove_from_hidden_list($project_name){
		$project_name = strtolower($project_name);
		$hidden_list = $this -> get_hidden_projects();
		$pr_inx = array_search($project_name, $hidden_list);
		if($pr_inx !== false){
			array_splice($hidden_list, $pr_inx, 1);
			return file_put_contents($this -> path_to_hidden_list_file, json_encode($hidden_list, JSON_PRETTY_PRINT));
		}

		return false;
	}
}