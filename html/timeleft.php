<?php
@include_once ("set.php");
$game = fetchinfo("value","info","name","current_game");
$r = fetchinfo("starttime","games","id",$game);
$somebodywon = fetchinfo("winner","games","id",$game);
if($r == 2147483647) die("120");

$r += 120-time();

if($r < 0)
{
	$r = 0;
	/*if(empty($somebodywon))
		include_once('getwinner34634f.php');*/
}
echo $r;
?>