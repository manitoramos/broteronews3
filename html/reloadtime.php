<?php
include("set.php");
 $rs96=mysql_query("SELECT * FROM messages");
 $row96=mysql_fetch_array($rs96);
 $currenttime=time();
 $time_check=$currenttime-60;
 mysql_query("DELETE FROM messages where time<$time_check");
 echo "current time:";
 echo $currenttime;
 echo "<br> time from DB:";
 echo $row96['time'];
 echo "<br> timecheck: ";
 echo $time_check;
 echo "<br> timeleft:";
 echo $row96['time']-60;
 ?>