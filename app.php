<?php

include "utils.php";

function scan_hosts(){
	$dir = scandir('..');
	$dirs = [];
	foreach ($dir as $i => $item) {
		if(!is_file($item) and $item != '.' and $item != '..'){
			$path = str_replace("/dashboard", "/", __DIR__) . $item;
			$project = project_file($path);
			$last_update = filemtime($path);

			$dirs[] = [
				"name" => $item,
				"path" => $path,
				"project" => $project,
				"last_update" => $last_update
			];
		}
	}
	return $dirs;
}

function project_file($path_to_dir){
	$project_file = $path_to_dir.'/project.json';
	if(!file_exists($project_file)){
		return null;
	}

	return json_decode(file_get_contents($project_file), true);
}

function sort_by_date($projects){
	usort($projects, function($a, $b){
		return $b['last_update'] - $a['last_update'];
	});

	return $projects;
}
