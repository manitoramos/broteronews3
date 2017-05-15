<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";
$lang = $_COOKIE["lang"];

$gamenum = fetchinfo("value","info","name","current_game");
if(!isset($_SESSION["steamid"])) $admin = 0;
else $admin = fetchinfo("admin","users","steamid",$_SESSION["steamid"]);
$ls2=0;
$rs69 = mysql_query("SELECT * FROM `game".$gamenum."` GROUP BY `userid` ORDER BY `id` DESC");
//$rs69 = mysql_query("SELECT * FROM `game25` GROUP BY `userid` ORDER BY `id` DESC");?>
<?php if(mysql_num_rows($rs69) == 0): ?>
<?php else: ?>
	<?php $row69 = mysql_fetch_array($rs69); ?>
		<?php
		if(!empty($row69['userid'])):
		$ls2++;
		$avatar = $row69["avatar"];
		$userid = $row69["userid"];
		$username = fetchinfo("name", "users", "steamid", $userid);
		$usn = '"item" title="'.$username.'"';
		$steamid = fetchinfo("steamid", "users", "steamid", $userid);
		$rs2 = mysql_query("SELECT SUM(value) AS value FROM `game".$gamenum."` WHERE `userid`='$userid'");
		$row = mysql_fetch_assoc($rs2);
		$sumvalue = $row69["value"];
		?>

<?php //item stuff
 		//$rs322=mysql_query("SELECT * FROM `game".$gamenum."` WHERE `userid`='$userid' ORDER BY `value` DESC ");
 		//$rs322=mysql_query("SELECT * FROM `game25` ORDER BY `value` DESC ");
 		$rs322=mysql_query("SELECT * FROM `game".$gamenum."` ORDER BY `value` DESC ");
 		while ($row699 = mysql_fetch_array($rs322)):
 		$imglnk = 'http://steamcommunity-a.akamaihd.net/economy/image/'.$row699["image"].'/130fx98f';
 		$wepprice = $row699['value'];
 		$weppname = $row699['item'];
 		$height="0";
 		$ipx="px;";
 		$heipx = $height.' '.$ipx;
?>
		<div id = "dropbox" class="item i<?php echo $userid; ?>">
		<div class ="row">
		<div class="col-lg-11 col-lg-offset-1 img">
		<img src=<?php echo $imglnk; ?> class="mCS_img_loaded">
		</div>
		<div class="col-lg-11 desc">
		<span class="price">$<?php echo $wepprice; ?> </span>
		<span class="name"> <?php echo $weppname; ?> </span>
		<span class ="number hide"> 1337 </span>
		</div>
		</div>
		</div>
		<?php $height = $height + "15"; ?>
		<?php
		endwhile;
		endif; //end if(!empty...)
		endif;

		?>
 		<?php echo "<script>$(document).ready(function(){ if(bets < $ls2) { audioElement2.play();} bets = $ls2;})</script>";
 		/*if(isset($_SESSION['steamid'])) {
	$rs96 = mysql_query("SELECT * FROM messages WHERE `userid` = '".$_SESSION['steamid']."'");
	while($row96 = mysql_fetch_array($rs96)) {
		$mng = $row96["msg"];
		if(strlen($msg[$lang][$mng]) > 0) echo "<script type=\"text/javascript\">alert2('<span class=from>".$row96["from"].":</span><br/><span class=msg>".$msg[$lang][$mng]."</span>','information');</script>";
		else echo "<script type=\"text/javascript\">alert2('<span class=from>".$row96["from"].":</span><br/><span class=msg>".$row96["msg"]."</span>','alert');</script>";
		*///mysql_query("DELETE FROM messages WHERE `id`='".$row96["id"]."'");
 $rs96=mysql_query("SELECT * FROM messages");
 $row96=mysql_fetch_array($rs96);
 $currenttime=time();
 $time_check=$currenttime-20;
 mysql_query("DELETE FROM messages where time<$time_check");
 
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>