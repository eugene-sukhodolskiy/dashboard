<?php

function process(){
	if(isset($_POST['create'])){
		echo $_POST['create'];
		create();
	}
}

function create(){
	// exec("sudo php");
	exec("sudo php /home/eugene/home/projects/hostmanager/create.php {$_POST['create']}", $ans);
	// header('location: /');
	// echo "<script>document.location = '';</script>";
}

process();