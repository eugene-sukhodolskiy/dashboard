<?php

function load_data($number, $phone){
	$api_request = [
		"apiKey" => "30a21f07aa81c782b980022533e59bfa",
		"modelName" => "TrackingDocument",
		"calledMethod" => "getStatusDocuments",
		"methodProperties" => [
			"Documents" => [
				[
					"DocumentNumber" => $number,
					"Phone" => $phone
				]
			]
		]
	];

	$api_request = json_encode($api_request);
	$api_url = "https://api.novaposhta.ua/v2.0/json/";

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $api_url,
		CURLOPT_RETURNTRANSFER => True,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $api_request,
		CURLOPT_HTTPHEADER => ["content-type: application/json",],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if(!$err){
		return $response;
	}

	return false;
}

while(true){
	echo "Try load data\n";
	$data = load_data('59000526168505', '380637161195');
	
	if($data){
		$filename = date('d-m-Y H-i-s') . '.json';
		$path = __DIR__ . '/logs/' . $filename;
		file_put_contents($path, $data);
		echo "Load data was successful. File " . $filename . "\n\n";
	}

	sleep(5 * 60); // 5 minutes
}
