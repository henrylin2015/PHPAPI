<?php
header('Content-Type:text/html;charset=utf-8');

function httpPost($url, $parms){
	$url = $url.$parms;
	if(($ch = curl_init($url)) == false){
		throw new Exception(sprintf("curl_init error for url %s.", $url));
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HEADER,0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,600);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	if(is_array($parms)){
		curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type:multipart/form-data;'));
	}
	$postResult = @curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($postResult === false || $http_code != 200 || curl_errno($ch)){
		$error = curl_error($ch);
		curl_close($ch);
		throw new Exception("HTTP POST FAILED:".$error);
	}else{
		switch(curl_getinfo($ch, CURLINFO_CONTENT_TYPE)){
		case 'application/json':
			$postResult = json_decode($postResult);
			break;
		}
		curl_close($ch);
		return $postResult;
	}
}

echo "init...<br>";
$postUrl = "http://127.0.0.1:8888/PHPAPI/server.php";
// $postUrl = "server.php";
$parms = "?action=adduserinfo&username=henry&password=admin&email=lin_hailing@sina.com";

$res = httpPost($postUrl,$parms);
$res = json_decode($res);
print_r(urldecode(json_decode($res)));