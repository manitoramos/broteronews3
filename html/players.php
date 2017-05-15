<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";
$lang = $_COOKIE["lang"];

$gamenum = fetchinfo("value","info","name","current_game");
if(!isset($_SESSION["steamid"])) $admin = 0;
else $admin = fetchinfo("admin","users","steamid",$_SESSION["steamid"]);
$ls=0;
$rs = mysql_query("SELECT * FROM `game".$gamenum."` GROUP BY `userid` ORDER BY `id` DESC");
//$rs = mysql_query("SELECT * FROM `game39` GROUP BY `userid` ORDER BY `id` DESC");
//$rs23 = mysql_query("SELECT * FROM `currentplayers` GROUP BY `value` ORDER BY `value` DESC");
echo mysql_error();

?>
<?php if(mysql_num_rows($rs) == 0):  //if there's no game going delete new players
mysql_query("DELETE FROM `currentplayers`");
?>


<?php else:
	
 ?> 

	<?php
	//var_dump($xda['uid']);
	while($row=mysql_fetch_array($rs)):
		$avatar = $row["avatar"];
		$uid = $row['userid'];
		$rowcurrent = mysql_query("SELECT * FROM `currentplayers` WHERE `uid` = '$uid'");
		$xda = mysql_fetch_array($rowcurrent);

		$username = mysql_real_escape_string(fetchinfo("name", "users", "steamid", $uid));
		$steamprofile2x = fetchinfo("steamprofile", "users", "steamid", $uid);
		$steamid = fetchinfo("steamid", "users", "steamid", $uid);
		$rs2 = mysql_query("SELECT SUM(value) AS value FROM `game".$gamenum."` WHERE `userid`='$uid'");
		//$rs2 = mysql_query("SELECT SUM(value) AS value FROM `game39` WHERE `userid`='$uid'");
		$row2 = mysql_fetch_assoc($rs2);
		//var_dump($xda['uid']);
		//var_dump($xda['uid']);
		$value =$row2['value'];	
		$value2 =$row2["value"];
		$value2 = str_replace(".","",$value2);
		mysql_query("INSERT INTO currentplayers (id, uid, value, username, steamprofile2x, steamid, avatar, byvalue) VALUES ('', '$uid', '$value', '$username', '$steamprofile2x', '$steamid', '$avatar', '$value2') " );
		//var_dump($xda['uid']);
		switch ($xda) {
			case (is_null($xda['value'])):
			mysql_query("INSERT INTO currentplayers (id, uid, value, username, steamprofile2x, steamid, avatar, byvalue) VALUES ('', '$uid', '$value', '$username', '$steamprofile2x', '$steamid', '$avatar', '$value2') " );
				break;
			case ($xda['uid'] == $row['userid']):
				mysql_query("UPDATE `currentplayers` SET `value`='".$value."', `username`='".$username."', `steamprofile2x`='".$steamprofile2x."', `byvalue`='".$value2."' , `steamid`='".$steamid."', `avatar`='".$avatar."' WHERE `uid`='".$row['userid']."' ");
				break;
			case(mysql_num_rows(mysql_query('SELECT * FROM `currentplayers` WHERE `uid`="'.$uid.'" AND `value`="'.$value.'"'))==0):
			mysql_query("INSERT INTO currentplayers (id, uid, value, username, steamprofile2x, steamid, avatar, byvalue) VALUES ('', '$uid', '$value', '$username', '$steamprofile2x', '$steamid', '$avatar', '$value2') " );
			break;

			case($xda['value'] != $value):
			mysql_query("UPDATE `currentplayers` SET `value`='$value', `username`='$username',`byvalue`='$value2', `steamprofile2x`='$steamprofile2x', `steamid`='$steamid', `avatar`='$avatar', `value`='$value' WHERE `value`='$value ");
			break;
			default:
				mysql_query("INSERT INTO currentplayers (id, uid, value, username, steamprofile2x, steamid, avatar, byvalue) VALUES ('', '$uid', '$value', '$username', '$steamprofile2x', '$steamid', '$avatar', '$value2') " );
				break;

			 }
 ?>
<?php endwhile; 


 endif; 

 $rs23 = mysql_query("SELECT * FROM currentplayers ORDER BY value DESC ");
if(mysql_num_rows($rs) == 0): 
	else:

		while($rsx=mysql_fetch_array($rs23)):?>
		<?php
$thisgame = fetchinfo("value","info","name","current_game");
$bank = fetchinfo("cost","games","id",$thisgame);

$thisuserid=$rsx['uid'];

$result = mysql_query("SELECT SUM(value) AS value FROM `game$thisgame` WHERE `userid`='$thisuserid'");
$getrowval = mysql_fetch_assoc($result);
$generatechance=round($getrowval["value"]*100/$bank,1);
$howmanyitems=mysql_num_rows(mysql_query('SELECT * FROM `game'.$thisgame.'` WHERE `userid`="'.$thisuserid.'"'));

$profilele='http://steamcommunity.com/profiles/'.$thisuserid;
?>
			<?php $val = $rsx['value']; ?>

		<div style="padding:10px;">
		<div style="float:left;">
		<img src="<?php echo $rsx['avatar']; ?>" style="max-width:70px;padding:0px;margin:10px;-webkit-border-radius: 70px;
-moz-border-radius: 70px;
border-radius: 70px;"/>
		</div>
		<div style="padding:10px;">
			<!-- <a href="#" onclick="system.items.sort('.<?php echo $thisuserid; ?>', this);" style="float:right;margin-top:8px;margin-right:10px">&nbsp;</a> -->

			<h4 style="margin-top:7px;margin-bottom:5px"><a href="<?php echo $profilele; ?>" target="_blank"><?php echo htmlspecialchars($rsx['username']); ?></a></h4>
			<span style="font-size: 12px;color: #818181;font-weight:normal;"><?php echo $generatechance; ?>% chance with <?php echo $howmanyitems; ?> item<?php if($howmanyitems>1) echo 's'; ?> valued at $<?php echo round($val, 2); ?></span>
			</span>

<?php //echo'<img style="margin-top:1px;max-width:78%;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;" src="http://csgoevo.com/generateimage.php?per='.$generatechance.'" alt=""/>';
?>
    <div id="progressbar" style="margin-top:3px;margin-left:80px;max-width:78%;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;">
      <div style="width:<?php echo $generatechance; ?>%"></div>
    </div>
    

		</div>
		</div><br/>

 <?php endwhile; ?>
<?php endif; ?>

