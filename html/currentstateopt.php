<?php
@include_once ("set.php");
//$state=mysql_fetch_assoc(mysql_query('SELECT `value` FROM `info` WHERE `name`="state"'));
$current_game=mysql_fetch_assoc(mysql_query('SELECT `value` FROM `info` WHERE `name`="current_game"'));
$var=array();

//$var['state']=$state['value']; // game state
$var['current_game']=(int)$current_game['value']; // game id (that is running)

$starttime=mysql_fetch_assoc(mysql_query('SELECT `starttime`,`cost`,unix_timestamp(now()) AS `time` FROM `games` WHERE `id`='.$var['current_game'].'')); //if 2147483647 then it hasnt started
$var['starttime']=(int)$starttime['starttime'];
$var['bank']=(float)$starttime['cost'];
$var['time']=(int)$starttime['time'];

//var_dump($r);


echo json_encode($var);

?>