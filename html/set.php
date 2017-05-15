<?php
$sitename = "localhost/CSGOJackpot_Simple_v1.4_CSGO.network/html"; // YOUR DOMAIN
$link = mysql_connect("localhost", "root", ""); // MYSQL , LOCALHOOST , USERNAME , PASSWORD 
$db_selected = mysql_select_db('csgo', $link); // MYSQL DATABASE
mysql_query("SET NAMES utf8");

function fetchinfo($rowname,$tablename,$finder,$findervalue) {
	if($finder == "1") $result = mysql_query("SELECT $rowname FROM $tablename");
	else $result = mysql_query("SELECT $rowname FROM $tablename WHERE `$finder`='$findervalue'");
	$row = mysql_fetch_assoc($result);
	return $row[$rowname];
}
?>