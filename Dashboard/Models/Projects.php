<?php

namespace Dashboard\Models;

class Projects extends \Dashboard\Middleware\Model{
	public function deep_search_file($dir, $file_to_search, $exactly = false){
		$files = scandir($dir);

		foreach($files as $i => $file){
			$path = realpath($dir . DIRECTORY_SEPARATOR . $file);
			if(is_file($path)) {
				if(!$exactly){
					if(strpos($file, $file_to_search) !== false){
						return ["file" => $file, "path" => $path];
					}
				}else{
					if($file == $file_to_search){
						return ["file" => $file, "path" => $path];
					}
				}
			}else if($file != "." and $file != "..") {
				$ret = $this -> deep_search_file($path, $file_to_search, $exactly);
				if($ret){
					return $ret;
				}
			}  
		} 

		return false;
	}

	public function data_addition($name, $project, $path){
		$project = is_array($project) ? $project : [];

		if(!isset($project['favicon'])){
			$favicon = $this -> deep_search_file($path, 'favicon.');

			if(isset($favicon) and $favicon){
				$path_to_fav = explode($name, $favicon['path']);
				$path_to_fav[1] = 'http://' . $name . $path_to_fav[1];
				unset($path_to_fav[0]);
				$project['favicon'] = implode($name, $path_to_fav);
			}
		}

		return $project;
	}

	public function get_projects_list(){
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

		return $projects;
	}

	protected function analize_project_file($path_to_dir){
		$project_file = $path_to_dir . '/project.json';
		if(!file_exists($project_file)){
			return null;
		}

		return json_decode(file_get_contents($project_file), true);
	}
}