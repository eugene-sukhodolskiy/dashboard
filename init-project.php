<?php

function collect_data(){
	$data = [];
	$questions = [
		'Project name:' => 'name',
		'Version:' => 'ver',
		'Author name:' => 'author',
		'Tags:' => 'tags',
		'Project type:' => 'type',
		'Main language:' => 'main_lang'
	];

	foreach ($questions as $q => $prop_name) {
		$data[$prop_name] = readline($q . ' ');
	}

	$data['tags'] = array_map(function($item){
		return trim($item);
	}, explode(',', $data['tags']));

	if($data['ver'] == "\n" or $data['ver'] == ''){
		$data['ver'] = '1.0';
	}

	$data['status'] = "open";
	$data['project_color'] = null;
	$data['git_url'] = null;
	$data['release_url'] = null;
	$data['project_color'] = null;
	$data['favicon'] = null;
	$data['description'] = null;

	return $data;
}

function create_json($data){
	$json = json_encode($data, JSON_PRETTY_PRINT);
	$dir = readline("Path to root dir of project: ");
	if($dir == "\n" or $dir == ""){
		$dir = getcwd();
	}

	$dir .= '/project.json';
	return file_put_contents($dir, $json);
}

$data = collect_data();
create_json($data);