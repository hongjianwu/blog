<?php
$serv = new swoole_server('0.0.0.0', 80);
$serv->set([
	'reactor' => 3,
	'worker_num' => 2,
	'daemonize' => true,
	'backlog' => 128
]);

$serv->on('connect', function(){
	echo "client:connect.\n";

});
$serv->on('receive', function($serv, $fd, $from_id, $data){

	$serv->send($fd, 'swoole1:'.$data);
	$serv->close($fd);
});
$serv->on('close', function($serv, $fd){
	echo "client:close\n";
});
$serv->start();