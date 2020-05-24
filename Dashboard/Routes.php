<?php

namespace Dashboard;

class Routes{
	/**
	 * Instance of Router module
	 * @var [type]
	 */
	protected $router;

	/**
	 * Controllers folder
	 * @var [type]
	 */
	protected $cf;

	/**
	 * Controllers namespace
	 * @var [type]
	 */
	protected $cn;

	/**
	 * @method __construct
	 * @param \Fury\Modules\Router\Router $router [description]
	 */
	public function __construct(\Fury\Modules\Router\Router $router){
		$this -> router = $router;
		$this -> cf = FCONF['controllers_folder'];
		$this -> cn = "\\" . FCONF['app_name'] . "\\" . FCONF['controllers_folder'];
	}

	public function routes_init(){
		$this -> uri_routes();
		$this -> get_routes();
		$this -> post_routes();
	}

	protected function uri_routes(){
		$this -> router -> uri('/', "{$this -> cn}\\Dashboard@board");
	}

	protected function get_routes(){
		$this -> router -> get(['url'], "{$this -> cn}\\Dashboard@throw_img");
	}

	protected function post_routes(){

	}
}