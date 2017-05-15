<?php
@include_once ("set.php");

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

$serverTime = time();
while (1) {

	//$state=mysql_fetch_assoc(mysql_query('SELECT `value` FROM `info` WHERE `name`="state"'));
	$current_game=mysql_fetch_assoc(mysql_query('SELECT `value` FROM `info` WHERE `name`="current_game"'));
	$var=array();

	//$var['state']=$state['value']; // game state
	$var['current_game']=(int)$current_game['value']; // game id (that is running)

	$starttime=mysql_fetch_assoc(mysql_query('SELECT `starttime`,`cost`,unix_timestamp(now()) AS `time` FROM `games` WHERE `id`='.$var['current_game'].'')); //if 2147483647 then it hasnt started
	$var['starttime']=(int)$starttime['starttime'];
	$var['bank']=(float)$starttime['cost'];
	$var['time']=(int)$starttime['time'];
	if($var['starttime'] == 2147483647){
		$var['timeleft']=120;
	}else{
		$var['timeleft'] = $var['starttime'] + (120-time());
		if($var['timeleft'] < 0)
		{
			$var['timeleft'] = 0;
		}
	}
	
	sendMsg($serverTime, json_encode($var));

	usleep(2000000); //1000000 = 1 seconds
}
?>