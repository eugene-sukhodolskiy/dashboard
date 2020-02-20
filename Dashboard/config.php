<?php

return [
	"app_name" => "Dashboard",
	"debug" => true,
	"default_db_wrap" => false,
	"db" => [
		"dblib" => "mysql",
		"host" => "127.0.0.1",
		"dbname" => "sample",
		"charset" => "utf8",
		"user" => "root",
		"password" => "pass"
	],
	"app_file" => "App.php",
	"templates_folder" => "Templates",
	"logs_enable" => true,
	"logs_folder" => "Dashboard/Logs",

	"controllers_folder" => "Controllers",
	"projects_folder" => "/var/www/html",
]; 