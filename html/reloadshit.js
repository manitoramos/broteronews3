<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";
$lang = $_COOKIE["lang"];

$gamenum = fetchinfo("value","info","name","current_game");
if(!isset($_SESSION["steamid"])) $admin = 0;
else $admin = fetchinfo("admin","users","steamid",$_SESSION["steamid"]);
$ls=0;
$rs = mysql_query("SELECT * FROM `game".$gamenum."` GROUP BY `userid` ORDER BY `id` DESC");?>
<?php if(mysql_num_rows($rs) == 0): ?>
<?php else: ?> 

	<?php
	while($row = mysql_fetch_array($rs)):
		$ls++;
		$avatar = $row["avatar"];
		$userid = $row["userid"];
		$username = fetchinfo("name", "users", "steamid", $userid);
		$steamprofile2x = fetchinfo("steamprofile", "users", "steamid", $userid);
		$usn = "item ".$username;
		$steamid = fetchinfo("steamid", "users", "steamid", $userid);
		$rs2 = mysql_query("SELECT SUM(value) AS value FROM `game".$gamenum."` WHERE `userid`='$userid'");
		$row = mysql_fetch_assoc($rs2);
		$sumvalue = $row["value"];
		?>
		
		<div class="item" style="I'M LOST HERE">
		<div class = "row u"<?php echo $userid; ?> data-openid="<?php echo $userid; ?>" data-count-additions="1">
		<a href="<?php echo $steamprofile2x; ?>" target="_blank">
		<img src ="<?php echo $avatar; ?>"></a>
		<div class="desc">
		<a class="name" href="<?php echo $steamprofile2x;?> <?php echo $username; ?>">
		<span class="skins">
		<span class="count_items">X </span>
		Skin(s) </span>
		<span class="right" onclick="system.items.sort("<?php echo $steamid; ?>, "this)">
		<span class="si">User Items</span>
		<span class="price_all"><?php echo $sumvalue; ?> </span>
		<span class="winner hide"> 0 </span>
		</span>
		<span class="room-price hide"> </span>
		<span class="number hide"> 260 </span>
		</div>
}
 <?php endwhile; ?>
<?php endif; ?>

<?php
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once "langdoc.php";
$lang = $_COOKIE["lang"];

$gamenum = fetchinfo("value","info","name","current_game");
if(!isset($_SESSION["steamid"])) $admin = 0;
else $admin = fetchinfo("admin","users","steamid",$_SESSION["steamid"]);
$ls=0;
$rs = mysql_query("SELECT * FROM `game".$gamenum."` GROUP BY `userid` ORDER BY `id` DESC");?>
<?php if(mysql_num_rows($rs) == 0): ?>
<?php else: ?> 

	<?php
	while($row = mysql_fetch_array($rs)):
		$ls++;
		$avatar = $row["avatar"];
		$userid = $row["userid"];
		$username = fetchinfo("name", "users", "steamid", $userid);
		$steamprofile2x = fetchinfo("steamprofile", "users", "steamid", $userid);
		$usn = "item ".$username;
		$steamid = fetchinfo("steamid", "users", "steamid", $userid);
		$rs2 = mysql_query("SELECT SUM(value) AS value FROM `game".$gamenum."` WHERE `userid`='$userid'");
		$row = mysql_fetch_assoc($rs2);
		$sumvalue = $row["value"];
		?>
		<div class="item" style="I'M LOST HERE">
		<div class = "row u"<?php echo $userid; ?> data-openid= <?php echo $userid; ?> data-count-additions="1">
		<a href=<?php echo $steamprofile2x; ?> target="_blank">
		<img src = <?php echo $avatar; ?></a>
		<div class="desc">
		<a class="name" href=<?php echo $steamprofile2x;?> <?php echo $username; ?> >
		<span class="skins">
		<span class="count_items">X </span>
		Skin(s) </span>
		<span class="right" onclick="system.items.sort("<?php echo $steamid; ?>, "this)">
		<span class="si">User Items</span>
		<span class="price_all"><?php echo $sumvalue; ?> </span>
		<span class="winner hide"> 0 </span>
		</span>
		<span class="room-price hide"> </span>
		<span class="number hide"> 260 </span>

}
 <?php endwhile; ?>
<?php endif; ?>
