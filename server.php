<?php
$serv = new swoole_server('0.0.0.0', 8080);
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

	$serv->send($fd, 'swoole'.$data."  fd:".$fd."  from_id:".$from_id);
	$serv->close($fd);
});
$serv->on('close', function($serv, $fd){
	echo "client:close\n";
});
$port = $serv->addlistener("0.0.0.0", 8080, SWOOLE_SOCK_TCP);
echo $port->port;
$serv->start();