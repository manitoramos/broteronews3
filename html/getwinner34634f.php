<?php
$mov = "0.".mt_rand(100000000,999999999);

@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";

function logsqlerror($error)
{
	$errortofile=$error."\n\r\n\r";
	$file='logsqlerror.txt';

	// Write the contents of a file,
    // Using the flag FILE_APPEND flag to append content to the file
    // Flag LOCK_EX to prevent the recording of the file someone else at this time
    file_put_contents($file, $errortofile, FILE_APPEND | LOCK_EX);
}

$current_game = fetchinfo("value","info","name","current_game");
mysql_query("UPDATE games SET `module`='$mov' WHERE `id`='$current_game'");

$rs = mysql_query("SELECT * FROM games WHERE `id`='$current_game'");
$row = mysql_fetch_array($rs);

$jackpotcost = $row["cost"];
$jackpot1 = round($jackpotcost,2);

$wincost = $row["cost"]*$mov;

$lookforwinner = mysql_fetch_array(mysql_query("SELECT * FROM `game$current_game` WHERE `from` <= '$wincost' AND `to` >= '$wincost'")) or die(logsqlerror(mysql_error()));

$test = fetchinfo("userid","games","id",$current_game);

if(strlen($test) > 5) $winuser = $test;
else $winuser = $lookforwinner["userid"];

$winname = mysql_real_escape_string(fetchinfo("name","users","steamid",$winuser));

$rs = mysql_query("SELECT SUM(value) AS ValueSum FROM `game$current_game` WHERE `userid`='$winuser'") or die(logsqlerror(mysql_error()));
$row = mysql_fetch_array($rs);
$wonpercent = 100*$row["ValueSum"]/$jackpotcost;
mysql_query("UPDATE games SET `percent`='$wonpercent', `winner`='$winname', `userid`='$winuser' WHERE `id`='$current_game'") or die(logsqlerror(mysql_error()));

$rs = mysql_query("SELECT userid FROM `game$current_game` GROUP BY userid") or die(logsqlerror(mysql_error()));
$currenttime=time();

while($row = mysql_fetch_array($rs)) {
	if($row["userid"] == $winuser) {
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`, `value`, `percent`, `win`, `system`, `time`) VALUES ('','$winuser','won','SYSTEM','$jackpot1', '$wonpercent', '1', '0', '$currenttime') ") or die(logsqlerror(mysql_error()));
	} else {
		$tc = $row["userid"];
		mysql_query("INSERT INTO `messages` (`id`,`userid`,`msg`,`from`, `value`, `percent`, `win`, `system`, `time`) VALUES ('','$winuser','won','SYSTEM','$jackpot1', '$wonpercent', '1', '0', '$currenttime') ") or die(logsqlerror(mysql_error()));

	}
}

$rs = mysql_query("SELECT item,value FROM `game$current_game`") or die(logsqlerror(mysql_error()));
$ila = 0;
while($row = mysql_fetch_array($rs)) {
	$itemsar[$ila] = $row["item"];
	$valuear[$ila] = $row["value"];
	$ila++;
}
for ($j = 0; $j < $ila-1; $j++) {
	for ($i = 0; $i < $ila-$j-1; $i++) {
		if ($valuear[$i] > $valuear[$i+1]) {
			$b = $valuear[$i];
            $valuear[$i] = $valuear[$i+1];
            $valuear[$i+1] = $b;
			$cc = $itemsar[$i];
            $itemsar[$i] = $itemsar[$i+1];
            $itemsar[$i+1] = $cc;
        }
    }
}

mysql_query("UPDATE users SET `won`=`won`+'$jackpotcost', `games`=`games`+1 WHERE `steamid`='$winuser'") or die(logsqlerror(mysql_error()));
if($jackpotcost>1) //if jackpot value is lower than 5$ dont take any items from the pot (winner gets it all)
{
	$rake = fetchinfo("value","info","name","rake");
	$rake += $rake*0.33;
	if(stristr(strtolower($winname),"yourwebsite.com") != NULL) { // PUT YOUR WEBSITE DOMAIN HERE
		$rake -= 99/100; // 99 MEANS 1% BONUS FOR THE USER , SO 95 MEANS 5% BONUS 
	}
	$rake /= 100;
	$rake *= $jackpotcost;
	for($i = $ila-1; $i >= 0; $i--) {
		if($valuear[$i] < $rake) {
			mysql_query("INSERT INTO `rakeitems` (`item`) VALUES ('".$itemsar[$i]."')") or die(logsqlerror(mysql_error()));
			$itemsar[$i] = "";
			$rake -= $valuear[$i];
		}
	}
}
$boolv = false;
for($i=0; $i < $ila; $i++) {
	if($itemsar[$i] == "") continue;
	if($boolv == false) $itemstring = $itemsar[$i];
	else $itemstring .= "/".$itemsar[$i];
	$boolv = true;
}
$rs = mysql_query("SELECT * FROM users WHERE `steamid`='$winuser'");
$row = mysql_fetch_array($rs);
$tradelink = $row["tlink"];
$token = substr(strstr($tradelink, 'token='),6);

mysql_query("INSERT INTO `queue` (`userid`,`status`,`token`,`items`) VALUES ('$winuser','active','$token','$itemstring')") or die(logsqlerror(mysql_error()));	
//echo $token."<br/>";
//echo $itemstring."<br/>";
//echo mysql_error()."<br/>";

$current_game++;

mysql_query("INSERT INTO `games` (`id`,`starttime`,`cost`,`winner`,`userid`,`percent`,`itemsnum`,`module`) VALUES ('$current_game','2147485547','0','','',NULL,'0','')") or die(logsqlerror(mysql_error()));

mysql_query("CREATE TABLE `game$current_game` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `item` text,
  `color` text,
  `value` text,
  `avatar` varchar(512) NOT NULL,
  `image` text NOT NULL,
  `from` text NOT NULL,
  `to` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;") or die(logsqlerror(mysql_error()));

mysql_query("TRUNCATE TABLE `game$current_game`") or die(logsqlerror(mysql_error()));
mysql_query("UPDATE info SET `value`='$current_game' WHERE `name`='current_game'") or die(logsqlerror(mysql_error()));
mysql_query("UPDATE info SET `value`='waiting' WHERE `name`='state'") or die(logsqlerror(mysql_error()));
?>