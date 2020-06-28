<?php

namespace Dashboard\Models;
use \Dashboard\Utils;

class Projects extends \Dashboard\Middleware\Model{
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

		return $project;
	}

	public function get_projects_list($filters){
		$dirs = scandir(FCONF['projects_folder']);
		$projects = [];
		foreach ($dirs as $i => $item) {
			if(!is_file($item) and $item != '.' and $item != '..'){
				$path = FCONF['projects_folder'] . '/' . $item;
				$project = $this -> analize_project_file($path);
				$project = $this -> data_addition($item, $project, $path);

				$last_update = filemtime($path);

				$projects[] = [
					"name" => $item,
					"path" => $path,
					"project" => $project,
					"last_update" => $last_update
				];
			}
		}

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

	protected function analize_project_file($path_to_dir){
		$project_file = $path_to_dir . '/project.json';
		if(!file_exists($project_file)){
			return null;
		}

		$project_json = json_decode(file_get_contents($project_file), true);
		if(isset($project_json['path_to_project'])){
			return $this -> analize_project_file($path_to_dir . '/' . $project_json['path_to_project']);
		}
		return $project_json;
	}
}