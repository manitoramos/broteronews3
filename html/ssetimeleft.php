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
while (1) {
	$game = fetchinfo("value","info","name","current_game");
	$r = fetchinfo("starttime","games","id",$game);
	if($r == 2147483647){
		$var=120;
	}else{
		$var = $r += 120-time();
		if($r < 0)
		{
			$var = 0;
			/*if(empty($somebodywon))
				include_once('getwinner34634f.php');*/
		}
	}
	sendMsg(time(),$var);
	usleep(500000); //1000000 = 1 seconds

}
?>