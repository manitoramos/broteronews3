<?php 
require_once('steamauth/steamauth.php');
@include_once('set.php');

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

/**
 * Constructs the SSE data format and flushes that data to the client.
 *
 * @param string $id Timestamp/id of this connection.
 * @param string $msg Line of text that should be transmitted.
 */
function sendMsg($id, $msg) {
  echo "id: $id" . PHP_EOL;
  echo "data: $msg" . PHP_EOL;
  echo PHP_EOL;
  ob_flush();
  flush();
}
/*
$serverTime = time();
while (1) {
	sendMsg($serverTime, 'server time: <div style="font-weight:bold;">' . date("h:i:s", time()));

	usleep(1000000); //1000000 = 1 seconds
}*/
$serverTime = time();
$messagesq=mysql_query('SELECT * FROM messages');
while($message=mysql_fetch_assoc($messagesq))
{
	$userinfo=mysql_fetch_assoc(mysql_query('SELECT * FROM `users` WHERE `steamid`="'.$message['userid'].'"'));
	$username=$userinfo['name'];
	$messagecontent=$message['msg'];
	if($message['system']==1 && $_SESSION['steamid']==$message['userid'])
	{
		sendMsg($serverTime,'<b>System message:</b> '.$messagecontent.'<br/><br/>');
	}
	else
	{
		sendMsg($serverTime,'');
	}
}