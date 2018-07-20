<?php 
$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('120.78.51.75', 8080, -1)) {
	exit("connect failed . Error: {$client->errCode}\n");
}
$client->send("hello world\n");
echo $client->recv();
$client->close();