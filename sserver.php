<?php 
	$http = new swoole_http_server("0.0.0.0", 8080);
	$http->on('request', function($resquest, $responese){
		$responese->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
	});
	$http->start();