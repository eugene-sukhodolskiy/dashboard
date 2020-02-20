<?php

namespace Dashboard\Models;

class Projects extends \Dashboard\Middleware\Model{
	public function get_projects_list(){
		$dirs = scandir(FCONF['projects_folder']);
		$projects = [];
		foreach ($dirs as $i => $item) {
			if(!is_file($item) and $item != '.' and $item != '..'){
				$path = FCONF['projects_folder'] . '/' . $item;
				$project = $this -> analize_project_file($path);
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