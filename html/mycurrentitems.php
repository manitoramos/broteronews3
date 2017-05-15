<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
if(!isset($_SESSION["steamid"])) {
	die("0");
}
$lastgame = fetchinfo("value","info","name","current_game");
$steam = $_SESSION["steamid"];
$bank = fetchinfo("cost","games","id",$lastgame);
if($bank == 0) die("0");
$results = mysql_query("SELECT * FROM `game$lastgame` WHERE `userid`='$steam'");
$row = mysql_num_rows($results);
echo $row;
?>