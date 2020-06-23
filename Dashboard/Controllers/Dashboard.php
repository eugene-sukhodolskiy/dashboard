<?php

namespace Dashboard\Controllers;

use Dashboard\Models\Projects;
use Dashboard\Models\Github;

class Dashboard extends \Dashboard\Middleware\Controller{
	public function board($filter_status = false){
		// $git = new GitHub();
		// dd($git -> auth());
		$projects = new Projects();
		$filters = [
			'status' => $filter_status
		];
		return $this -> new_template() -> make('project.list', [
			'projects' => $projects -> get_projects_list($filters),
			'filters' => $filters
		]);
	}

	public function throw_img($url){
		$img = file_get_contents($url);
		$format = explode('.', $url);
		$format = $format[count($format) - 1];

		switch($format) {
	    case "gif": $ctype="image/gif"; break;
	    case "png": $ctype="image/png"; break;
	    case "jpeg":
	    case "jpg": $ctype="image/jpeg"; break;
	    case "svg": $ctype="image/svg+xml"; break;
	    case "ico": $ctype="image/ico"; break;
	    default:
		}

		header('Content-type: ' . $ctype);
		echo $img;
	}
}