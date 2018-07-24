<?php
$server = new swoole_websocket_server('0.0.0.0', 8080);
$server->on('open', function(swoole_websocket_server $server, $request){
	echo "server:handshake success with fd{$request->fd}\n";
});
$server->on('message', function(swoole_websocket_server $server, $frame){
	echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode}, find:{$frame->finish}\n";
	$server->push($frame->fd, $frame->data);
});
$server->on('close' , function($ser, $fd){
	echo "client {$fd} closed\n";
});
$server->on('request', function(swoole_http_request $request, swoole_http_response $response){
	global $server;
	foreach ($server->connections  as $fd) {
		$server->push($fd, $resquest->get['message']);
	}
});
$server->start();