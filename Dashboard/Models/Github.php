<?php

namespace Dashboard\Models;

class GitHub extends \Dashboard\Middleware\Model{
	public function auth(){
		$dev_token = '6c1506b8c923aca3207363679cbf4e6e3104df42';
		$username = 'eugene-sukhodolskiy';
		dd($this -> get_repo('dashboard', $username, $dev_token));

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
		curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/users/' . $username);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "{$username}:{$dev_token}");
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		$result = curl_exec($ch);
		curl_close($ch);

		// print_r($status_code);
		dd($result); 
	}

	public function get_repo($repo_name, $username, $dev_token){
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
		curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/user/repos');
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "{\"name\":\"{$repo_name}\"}");
		curl_setopt($ch, CURLOPT_USERPWD, "{$username}:{$dev_token}");
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}
}