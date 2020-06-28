<?php

namespace Dashboard;

class Utils{
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
}

