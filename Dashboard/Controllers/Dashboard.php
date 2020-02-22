<?php

namespace Dashboard\Controllers;

use Dashboard\Models\Projects;

class Dashboard extends \Dashboard\Middleware\Controller{
	public function board(){
		$projects = new Projects();
		return $this -> new_template() -> make('project.list', [
			'projects' => $projects -> get_projects_list()
		]);
	}
}