<?php

@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
  setcookie("lang","en",2147485547);
  $lang = "en";
} else $lang = $_COOKIE["lang"];
$sitename = "localhost";
$title = "CSGOmanito.com";
@include_once('set.php');


require('steamauth/steamauth.php');

if(isset($_SESSION["steamid"])) {
  include_once('steamauth/userInfo.php');
}

include 'adminlist.php'; //include AFTER session is started (session_start();)
include 'chatfunctions.php';
?>

<!DOCTYPE html> <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--> <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]--> <!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]--> <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--> 

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head> <title>Website.com - jackpot? ez right</title> 
<base > <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="author" content="Website.com"/> 
<meta name="keywords" content="Your keywords"> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100&amp;subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'> 

<link type="text/css" rel="stylesheet" media="all" href="plugins/bootstrap-grid-12/css/bootstrap.min.css"> 
<link type="text/css" rel="stylesheet" media="all" href="plugins/font-awesome/css/font-awesome.min.css"> 
<link type="text/css" rel="stylesheet" media="all" href="plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"> 
<link type="text/css" rel="stylesheet" media="all" href="plugins/pnotify/pnotify.custom.min.css"> 
<link type="text/css" rel="stylesheet" media="all" href="plugins/scrollbar/jquery.mCustomScrollbar.css"> 
<link type="text/css" rel="stylesheet" media="all" href="css/ranim.css"> 
<link type="text/css" rel="stylesheet" media="all" href="css/animate.css">
<script src="js/progressbar.js"></script>
<script type="text/javascript">
 
function timedMsg(){
var t=setTimeout("document.getElementById('systemalert').innerHTML='';",10000);
}
 
 
</script>


<style type="text/css">
  #progressbar {
      background-color: white;
      border-radius: 4px; /* (height of inner div) / 2 + padding */
      padding: 1px;
      border:1px solid lightgray;
    }
    
    #progressbar > div {
       background-color: #3E83BF;
       height: 6px;
       border-radius: 10px;
    }
</style>

<link type="text/css" rel="stylesheet" media="all" href="frontend/css/animate.css"> 
<link type="text/css" rel="stylesheet" media="all" href="frontend/css/front7f6fy.css?112"> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 



<script type="text/javascript" src="js/main.php"></script>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> <link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png"> <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png"> 
<link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png"> <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png"> 
<link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png"> <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png"> 
<link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png"> <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png"> 
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png"> <link rel="icon" type="image/png" sizes="192x192" href="android-icon-192x192.png"> 
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"> <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png"> 
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"> <link rel="manifest" href="manifest.json"> 
<meta name="msapplication-TileColor" content="#ffffff"> <meta name="msapplication-TileImage" content="ms-icon-144x144.png"> 
<meta name="theme-color" content="#ffffff"> <meta property="og:title" content="Double your skins in CS GO!"> 
<meta property="og:site_name" content="website.com"> <meta property="og:url" content="index.php"> 
<meta property="og:description" content="your content"> 
<meta property="og:image" content="steamlogo.png"> <meta property="og:type" content="website"> <meta property="og:locale" content="en_US"> 

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
  newwindow=window.open(url,'name','height=500,width=350');
  if (window.focus) {newwindow.focus()}
  return false;
}

// -->
</script>
<script type="text/javascript">
		test();
		
		function test()
		{
			$.ajax({
				type: "GET",
				url: "raffleanim.php",
				error: function(err) {
					console.log(err);
				},
				success: function(result) {
					$("section.rounditems").html(result);
				}
			});
			
			setTimeout(test, 1000);
		}
		</script>
<script src="js/nscript.js"></script>
<script src="js/chat2.js"></script>

<script>
function load_messes()
  {
    $.ajax({
                type: "POST",
                url:  "chatread.php",
                data: "req=ok",
                success: function(test)
        {
          $("#mcaht").empty();
          $("#mcaht").append(test);
          $("#mcaht").scrollTop();
                }
        });
  }
</script>
<style type="text/css">
.ava_top{
  height: 40px;
  border-radius: 32px;
}

.caht-box {
  background: #fff;
  height: 600px;
  height: auto;
  padding: 5px;
  width: 320px;
}
.boxs {
  height: 20px;
  width: 100%;
}
.left-chat {
  font-size: 11px;
  height: 700px;
  overflow: auto;
  padding: 5px;
  position: relative;
  text-align: left;
  width: 344px;
}
.chat-btn:hover {
  background: #BB5D1E;
}
.chat-o span {
  color: #fff;
}
.chat-msg {
  height: auto;
  margin-top: 7px;
  overflow: hidden;
  bottom: 5px;
  display:block;
  word-wrap: break-word;
  font-weight: normal;
  font-size: 13px;
}
.chat-o {
  color: #EA7526;
  float: right;
  margin-right: 5px;
}
.caht-avat {
/* Rounded avatars */
    float: left;
    margin-top: 1em;
    margin-right: 1em;
    position: relative;

    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;

    -webkit-box-shadow: 0 0 0 3px #fff, 0 0 0 4px #999, 0 2px 5px 4px rgba(0,0,0,.2);
    -moz-box-shadow: 0 0 0 3px #fff, 0 0 0 4px #999, 0 2px 5px 4px rgba(0,0,0,.2);
    box-shadow: 0 0 0 3px #fff, 0 0 0 4px #999, 0 2px 5px 4px rgba(0,0,0,.2);

}
.caht-ava {
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  margin-right:2px;
}
.caht-name {
  margin-top: 2px;
  display:inline !important;
}
.caht-dateid {
  color: #6C9FCE;
  float: left;
  font-size: 10px;
  height: 15px;
  margin-top: 3px;
  width: 140px;
}
.msg-text {
  float: left;
  margin-top: 2px;
  width: 100%;
}
.result {
  box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.75);
  color: #fff;
  display: none;
  font-weight: 400;
  height: 60;
  line-height: 55px;
  moz-box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.75);
  position: absolute;
  text-align: center;
  text-shadow: 2px 2px 2px rgba(0, 0, 0, 1);
  webkit-box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.75);
  width: 100%;
  z-index: 999;
}
.error {
  background: #B83A26;
}
.success {
  background: #EA7526;
}
.cht-au {
  width: 100%;
}

a .xtooltip {
  display: none;
  position: absolute;
  font: 300 11px/12px "Roboto","Arial",sans-serif ;
  color: #fff;
  bottom: 56px;
  left: 50%;
  margin: 0 0 0 -64px;
  width: 127px;
  padding: 5px 1px 4px 8px;
  background: #202124;
  border-bottom: 3px #282a2f solid;
  text-align: center;
  border-radius: 7px;
  z-index: 50;
}
a .xtooltip:after {
  content: '';
  display: block;
  position: absolute;
  width: 0px;
  height: 0px;
  border-left: 11px solid transparent;
  border-top: 12px solid #282a2f;
  border-right: 11px solid transparent;
  top: 100%;
  left: 50%;
  margin: 0 0 0 -11px;
}
a:hover .xtooltip {
  display: block;
}
</style>
</head> 
<body> 
<div class="result success" id="success"></div>
<div class="result error" id="error"></div>

<div id="left"> 
<ul> <li class="logo">
<a href="index.php" data-page="play"></a></li> <li class="active">
<a href="index.php" class="play" data-page="play"><span></span>Play</a></li> 
<li class="separator"></li> <li><a href="en/winners.php" class="winners" data-page="winners"><span></span>Top players</a></li> 
<li class="separator"></li> <li><a href="history.php" class="history" data-page="history"><span></span>History</a></li> 
<?php if(!isset($_SESSION["steamid"])):?>
<li class="separator"></li> <li class="mini"><a href="en/faq.php" class="faq" data-page="faq"><i class="fa fa-question-circle"></i>FAQ</a></li>
<?php else: ?>
<li class="separator"></li> <li><a href="settings.php" class="settings" data-page="settings"> <span> </span>Settings</a></li>
<li class="separator"></li> <li class="mini"><a href="en/faq.php" class="faq" data-page="faq"><i class="fa fa-question-circle"></i>FAQ</a></li>
<?php endif; ?> 
<li class="separator"></li> <li class="mini"><a href="en/rules.php" class="rules" data-page="rules"><i class="fa fa-shield"></i>Rules</a></li> 
<li class="separator"></li> <li class="mini"><a href="https://Website.com/support" class="support" target="_blank"><i class="fa fa-life-ring">
</i>Support</a></li> </ul> </div> <div id="container"> <div id="content-hidden"> <div class="col-lg-offset-19 col-lg-5 bglayer"></div> </div> <div id="top"> 
<a href="index.php" class="sitename transition" data-page="play">WEB<span class="transition">site</span>.com - your skins etc!</a><ul id="right-section"> 

<li class="el promo leadtext">Add <span>website.com</span> to your steam name and get <span>+6%</span> bonus<br/> to your winnings! (relog website)</li> 
 <li class="el" id="sign-in">
 <?php 
 if(!isset($_SESSION["steamid"])): ?>
        <?php steamlogin(); ?>
  <a href="?login" id="steam-login-url" rel="nofollow"></a> </li>
 <?php
 else: ?>

  <li class="el" id="user-panel">
  <?php $timenow = time(); ?>
  <?php mysql_query("UPDATE users SET lastseen=".$timenow." WHERE steamid=".$_SESSION['steamid'].""); ?>
  <a href=<?php echo $steamprofile['profileurl']; ?> target="_blank" rel="nofollow"></a>
  <img src=<?php echo $steamprofile['avatar']; ?>>
  <div class="desc">
  <a class="name" href=<?php echo $steamprofile['profileurl']; ?> target="_blank" rel="nofollow"> <?php echo $steamprofile['personaname']; ?></a>
  <a class="deposit" href="https://steamcommunity.com/tradeoffer/new/?partner=427986800&token=Lv8txF4G">MAKE A DEPOSIT </a>  
  <a class="logout" href="steamauth/logout.php">Logout </a>
  </div>
  </li>
  <?php mysql_query("UPDATE users SET steamprofile='".$steamprofile['profileurl']."', name='".$steamprofile['personaname']."', avatar='".$steamprofile['avatarfull']."' WHERE steamid='".$_SESSION["steamid"]."'");?>
 <?php endif; ?>
  <li class="el" id="langs"> <div class="btn-group"> <button type="button" class="dropdown-toggle lang-en" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> EN <span class="caret"></span>
   </button> <ul class="dropdown-menu dropdown-menu-right"> <li class="ru"><a class="lang-ru" href="ru.php"></a></li> 
    <li class="en"><a class="lang-en" href="en.php"></a></li>
   </ul> </div> </li> </ul> </div> <div id="top-bar">
<center>



		<div class="itemsdiv">
		<div class="hhdgfbd"></div>
		<div class="kjmhgd"></div>
		<section class="rounditems" style="margin: auto;"> 
		<?php include('raffleanim.php'); ?>
		
		</section>
				
		</div>

		
</center>

   <div id="spinner" class=" col-lg-13"> <div class="line"></div> <div class="spinner"> 
   <ul class="cont"> </ul> </div> </div> <div class="col-lg-13 col border-right col-spinner"> <div class="col-xs-12 col-sm-8 col-md-8 icon-col"> 
   <div class="users-online ico"> <div class="img"></div> 
   <span id="users-online" class="h3"><?php
                      $result = mysql_query("SELECT id FROM games WHERE `starttime` > ".(time()-86400));
                      $result2 = mysql_query("SELECT id FROM users WHERE `lastseen` > ".(time()-86400));
                      echo mysql_num_rows($result2);
                    ?></span> <?php echo $msg[$lang]["ptd"]; ?> </div> </div> <div class="col-xs-12 col-sm-8 col-md-8 icon-col"> 
   <div class="games-today ico"> <div class="img"></div> <span id="games-today" class="h3"><?php
                    $result2 = mysql_query("SELECT id FROM users WHERE `lastseen` > ".(time()-86400));
                    echo mysql_num_rows($result); ?></span> <?php echo $msg[$lang]["gtd"]; ?> </div> </div> <div class="col-sm-8 col-md-8 icon-col hidden-xs"> <div class="biggest-win ico"> 
   <div class="img">
   </div> <span id="biggest-win" class="h3">
   <?php /*
            $result = mysql_query("SELECT MAX(cost) AS cost FROM games");
            $row = mysql_fetch_assoc($result);
            $maxcost =  $row["cost"];
            */
            $result = mysql_query("SELECT * FROM games ORDER BY cost*1 DESC LIMIT 1");
            $row = mysql_fetch_assoc($result);
            $maxcost =  $row["cost"];
            ?>
            $<?php echo round($maxcost,2); ?></span> <?php echo $msg[$lang]["mwin"]; ?> </div> 
   </div> </div> 
   <div class="col-lg-6 col hidden-md hidden-xs hidden-sm"> 
   <div id="user-room-panel"> 
   <div class="ico"> </div>
   <ul> <li>NO SOUVENIR ITEMS! TO DEPOSIT YOU MUST HAVE STEAM AUTHENTICATOR ENABLED!</li> <li>Probably to win <span id="mychance">0%</span>. Min bet <span>$0.5</span></li> </ul> </div>  </div>
   <div align="center" class="col-lg-5 border-left social col hidden-md hidden-xs hidden-sm"> 
   <br><br>Hello my friend</br>Change this bar to anything you want.
</div> </div> 
   <div id="content"> <div class="col-lg-9 affix-room "> <div id="affix-room" class="">


<br/><br/> <div id="circle-container"> <div id="circle" class=""> 
  <script>/*
    var source = new EventSource('systemmessages.php');
    source.onmessage = function(e) {
      document.getElementById("systemalert").innerHTML = e.data;
      timedMsg();
      console.log('Data received from ssesystemmessages: '+e.data);
    };*/
  </script>

<span id="systemalert" style="text-align:center;">

</span>
<span id="alert" style="text-align:center;">
</span>
<!--circleeeeeeeeeeeeeeeeeeeeeeeeee -->
<div class="visual" style="float: left;">
<p class="progressbar__label" style=" color: #008BFF;font-weight: 300; font-size: 42px;">0/50</p>
<div id="prograsd" style="position: relative;">

<span id="money_round" class="bankbbas">$<span id="bank"><?php echo round(fetchinfo("cost","games","id",$lastgame),2); ?>
</span></span> </div>
</br>
</br>

 <?php 
 if(!isset($_SESSION["steamid"])): ?>
        <?php steamlogin(); ?>
  <a class="btn btn-primary btn-lg" href="?login">LOG IN TO DEPOSIT</a>
<?php else: ?>
  <?php $token = fetchinfo("tlink","users","steamid",$_SESSION["steamid"]); ?>
  <?php if(strlen($token)<2): ?>
   <a class="btn btn-primary btn-lg" href="/settings.php" class="settings" data-page="settings">ADD TRADE URL</a>
<?php else: ?>


  Time left: <h4 id="countdown-timer"><span id="timeleft">0</span></h4>
  <a class="btn btn-primary btn-lg" style="text-decoration: none;" href="https://steamcommunity.com/tradeoffer/new/?partner=427986800&token=Lv8txF4G" target="_blank" ><?php echo $msg[$lang]["ingame"]; ?> </a>

  <?php endif; ?>
<?php endif; ?>
</div>


<br>

  </div> </div><h5 id="round-hash" class="hidden"><?php echo md5(3); ?></h5> 
   <h6 id="room-id" class="hide"></h6> </div> </div>

   <div class="col-lg-4 border-right border-left affix-items scrollbar" id="room-items"> 


   <div id="dropboxy">
    <?php
    ?>
   </div>

 </div>

   <div class="col-lg-6 affix-players" style="padding:10px;">
  <div id="playersdropboxy">
   <?php include_once("players.php"); ?>
  </div>
   <div id="affix-players" class="scrollbar"> 
   <div id="rooms"></div> </div> </div> <div class="col-lg-5 affix-right"> <div id="affix-right" class="border-left"> 
   <div class="col-xs-24 chat"> <div class="row chat-container">

   <div class="row chat-buttons"> <div class="col-xs-24"> <div class="media-body"> <div class="input-group"> 

   <input type="text" class="form-control chat-message" id="text-massage" style="margin-left:6px;" maxlength="300"> <span class="input-group-btn"> 

   <?php if(isset($_SESSION['steamid'])) { ?>
    <button class="btn btn-primary" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> WAIT..." id="send_massage" style="margin-right:6px;">SEND</button>

  <div class="sml-bnt" id="smile"></div>
  <? }
  else { ?>
    <form method="get" action="index.php"><input type="hidden" name="login" value=""/><input type="submit" class="btn btn-primary" value="Log in to chat" style="margin-right:6px;"/></form>

  <?php }
  ?>

 </span> </div> </div> </div> </div>
    <div class="col-xs-24 messages messages-img" style="width:250px;">
      <?php if(isadmin($_SESSION['steamid'])){
      echo'Admin tools: [<a href="chatadm.php?do=clear" onclick="return popitup(\'chatadm.php?do=clear\');">clear chat</a>], [<a href="chatadm.php?do=toggle" onclick="return popitup(\'chatadm.php?do=toggle\');">turn '.(chaton() ? 'off' : 'on').'</a>]';
    } ?>
<? include ('mini-chat.php'); ?>
   </div> </div>
 </div>
   <div id="raffle"><div class="col-xs-24 raffle"> <div class="cont"> <div class="circle"> <img id="raffle-img"> </div> <h4 class="name" id="raffle-name"></h4> 
   <h4 id="countdown-raffle-timer" data-countdown="2020-08-08"></h4> 
   <a class="btn btn-default" href="?login">LOG IN</a> </div> </div> </div> </div> </div> </div> 
   <div class="site-overlay" onclick="system.menu.setHomepage()"></div> 
   <div class="site winners col-xs-24 col-sm-18 col-md-14 col-lg-12"> 
   <?php
   $rs = mysql_query("SELECT * FROM `users` ORDER BY `won` DESC LIMIT 10");
  $i = 1;
   ?>
   <h2>Top players</h2>
   <table class="table table-condensed table-hover"> 
   <thead> <th>Rank</th> <th class="text-left">Nickname</th> 
   <th class="hidden-xs">Total games</th> <th class="hidden-xs">Won ($)</th>  </thead> 
   <tbody id="top-players-tbody">
     <?php while($row=mysql_fetch_array($rs)): ?>
   <?php if ($i <= "3"):?>
   <tr class = "top">
   <td class = "number"><?php echo $i;?></td>
   <td class="text-left">
   <a rel="nofollow" target="_blank" href= <?php echo $row['steamprofile']; ?> class="img hidden-xs"> <img src=<?php echo $row['avatar']; ?>> </a>
   <a rel="nofollow" target="_blank" href=<?php echo $row['steamprofile']; ?> class="name"> <?php echo $row['name']; ?> </a>
   </td>
   <td class="hidden-xs" target="_blank"> <?php echo $row['games']; ?> </td>
   <td class="hidden-xs" target="_blank"> <?php echo $row['won']; ?> </td>
<?php else: ?>
  <tr class="">
   <td class = "number"><?php echo $i;?></td>
   <td class="text-left">
   <a rel="nofollow" target="_blank" href= <?php echo $row['steamprofile']; ?> class="img hidden-xs"> <img src=<?php echo $row['avatar']; ?>> </a>
   <a rel="nofollow" target="_blank" href=<?php echo $row['steamprofile']; ?> class="name"> <?php echo $row['name']; ?> </a>
   </td>
   <td class="hidden-xs" target="_blank"> <?php echo $row['games']; ?> </td>
   <td class="hidden-xs" target="_blank"> <?php echo $row['won']; ?> </td>
   </tr>
   </tr>
<?php endif; ?>
<?php $i++;?> 
<?php endwhile; ?>
   </tbody> </table> 
   <a class="close" data-page="play"></a> </div> 
   <div class="site myhistory col-xs-24 col-sm-18 col-md-14 col-lg-12"> 
   <h2>Winners</h2> <table class="table"> <thead> <th>Rank</th> <th>Nickname</th> <th>Total wins</th> <th>Won</th> </thead> 
   <tbody> <tr> <td>1</td> </tr> </tbody> </table> <a class="close" data-page="play"></a> </div> 
   <div class="site history col-xs-24 col-sm-18 col-md-14 col-lg-12"> <h2>History</h2> <div id="history">
   <?php 
   $gameid = fetchinfo("value", "info", "name", "current_game");
$query  = mysql_query("SELECT * FROM `games` WHERE `id` < $gameid ORDER BY `id` DESC LIMIT 10");
while($rowd=mysql_fetch_array($query)):
  //define stuff
  $lastwinner=$rowd["userid"];
  $winnercos =$rowd['cost'];
  $winnerpercent = $rowd['percent'];
  $winneravatar=fetchinfo("avatar", "users", "steamid", $lastwinner);
  $winnername = fetchinfo("name", "users", "steamid", $lastwinner);
  $steamlink = fetchinfo("steamprofile", "users", "steamid", $lastwinner); ?>
  <div class="cont row">
  <div class="col-xs-24 header">
  </div>
  <div class="col-xs-24 body">
  <div class="col-xs-16 col-sm-16">
  <a rel="nofollow" target="_blank" href=<?php echo $steamlink; ?> class="img hidden-xs">
  <img src=<?php echo $winneravatar; ?> > </a>
  <a rel="nofollow" target="_blank" href=<?php echo $steamlink; ?> class="name"> <?php echo $winnername; ?> </a>
  </div>
  <div class="right text-right">
  <span class="win">
  Win: <span>$ <?php echo round($winnercos, 3); ?> </span></span>
  <span class="chance">
  Chance: <span><?php echo round($winnerpercent, 2); ?>% </span> </span> </div> </div>
  <div class="col-xs-24 footer">
  <!-- here I start with csgo items, so... another while -->

  <?php 
  $query2 = mysql_query("SELECT * FROM `game".$rowd["id"]."`");
  while($rowf = mysql_fetch_array($query2)): 
    //define stuff x2
    $imglink = 'http://steamcommunity-a.akamaihd.net/economy/image/'.$rowf["image"].'/70fx58f';
    $wep = $rowf["item"].' - $'.$rowf["value"];
  ?>
  <a href="#">
  <img src=<?php echo $imglink; ?> width="46" height="40">
  <span class="xtooltip"><?php echo $wep; ?></span>
  </a>
  <?php endwhile; ?>
  </div>

  </div>
  <?php endwhile; ?>
   </div> 
   <a class="close" data-page="play"></a> </div> 
   <div class="site settings col-xs-24 col-sm-18 col-md-14 col-lg-12"> <h2>Settings</h2> <div id="settings"></div>
   <div class="block-area trade-url-area">
   <div role="alert" class="AlertX alert-infoX alert-trade-url alert-dimissible fade in">

        <div class="content">
          <div class="history_game">
          <form method="POST" action="./updatelink.php">
            <label for="link" style="color: #678098; font-size: 17pt;font-family: roboto;">Your Steam Trade URL: </label>
            <input type="text" name="link" class="form-control trade-url-input"style="" id="link" value="<?php  echo fetchinfo("tlink","users","steamid",$_SESSION["steamid"]); ?>" placeholder="Link exchange">
            <p style="color: #678098; font-size: 14pt;font-family: roboto;">Fetch your Steam URL: <a href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank" style="color: #678098; font-size: 12pt;font-family: roboto;">http://steamcommunity.com/id/me/tradeoffers/privacy</a></p>
            <p style="color: #FF3F3F; font-size: 12pt;font-family: roboto;">Make sure your Steam URL is Valid!</p>
            <p style="color: #FF3F3F; font-size: 12pt;font-family: roboto;">Entering an invalid URL would prevent you from getting your winnings!</p>
                <input type="submit" class="btn btn-primary btn-lg" href="#" value="Save">
              </form>
          </div>
        </div>
        </div>
        </div>
   <a class="close" data-page="settings"></a></div>

   <div class="site faq col-xs-24 col-sm-18 col-md-14 col-lg-12"> 
   <h2>Website - Rules/FAQ</h2> <h3>Evolve Your Skins!</h3>
   <h4>The LOWEST commission jackpot site!</h4>
  <h4>Mechanics are simple: More you contribute into the pool, Higher the chances you win the entire pool!</h4> - Login through Steam and connect your steam URL through Settings<br/>- Place your deposit!<br/>
- The system calculates value for items that you deposited (valued by csgo.steamanalyst.com), for every dollar you get 100 points.<br/> 
- When the pot reaches 50 items or 90 seconds, the raffle begins. The bigger contribution percentage to the pool, the higher chance to win.<br/> - 
The jackpot winner will receive the jackpot VIA a steam offer. (MAX 15 minutes after chosen).<br/>
<h4>Why use us?</h4> We run the lowest commission (4%) out of all jackpot sites. We consist of active, ready-to-help staff member at all times. We don't run any B.S like "if bot gets glitched, you don't get skins back."<br/><br/>We try to maintain the most legit and efficient way of CSGO Jackpotting!<br/>
<h4>Requirements to join:</h4> -There's a 10 item limit per trade offer. Minimum of $0.5 value. <h4>Note That:</h4>
- Your first deposit gives you a +5% win chance.<br/>- By adding "Website.com" to your steam name and re-logging the site, you get +6% extra on your winnings!<br/><h4>Current Promotions:</h4>
1. All entries have a chance to win a choice of Karambit Fade/Slaughter FN (ends sep 8)</br>2. Retweet/Share us on Facebook for an extra chance!<br/> <h4>Why did I not receive all the skins in the pool?</h4>
- The site takes 10% commission (4% with Website.com) for upkeep, advertising, give-aways and site development.
<h4>How long does it take for my winnings?</h4> - Within a minute. The bot should automatically send the winner their jackpot winnings! <h4>Your Privacy:</h4>
- Logging in with Steam will never provide us with any information. Our Jackpot logs will NEVER be shared or sold.<br/>
<br/>Questions and Inquires can be sent to: support@Website.com<br/><br/> Deposit today and try your luck! Evolve Your Skins!<br/>
-Website Team <a class="close" data-page="play"></a> </div> <div class="site rules col-xs-24 col-sm-18 col-md-14 col-lg-12"> 
<h2>Terms of Service</h2> 
<h4>License of usage:</h4> 
By using our service or being on our website, you acknowledge and accept our terms and conditions in full and without reservation. 
You are bound to our terms as long as you are affiliating yourself with any aspects of Website. 
Any conflicts with our terms and conditions and parts of it is NOT allowed to affiliate themselves any further without discussion. 
Those who are under affiliation with Valve corporation, Steam or external Jackpot Sites are prohibited to affiliate themselves with this website/service and/or their owners.
<br/><br/> You must the age of 18+ (21+ in some places) or older to use our website. By using this website you agree to these terms and conditions, you warrant that you are at least 18/21 years of age. Website.com has the right to request identification of age to prevent under-aged gambling while temporarily disabiling your account. 
<h4>Disclaimer:</h4>
The use of our service is provided "AS IS" or "AS AVAILABLE". No guarantees are provided for ANY activity done on this site.<br/>
We reserve the rights to have anything on Website or affiliated changed, whenever, without consent.<br/>
<h4>License of service usage:</h4> 
Website and/or its owners own the intellectual property rights and originality that is published on Website (in any form). Subject to the license below, all these intellectual property rights are reserved. <h4>
Accounts/Privacy:</h4> The account you authorize with us through Steam (https://steamcommunity.com) must be your own. Your privacy is kept 100% secure and will never be distributed externally. 
   <h4>Fair Play</h4>
   We respect fair play. A MAXIMUM of 4% will be taken from jackpot winners with "Website.com" and up to 10% without for further website development, give-aways and upkeep. All users on this website are expected to be "legit" users of the community as we hold the right to freeze your account without warning if suspicion is raised.
   <h4>Missing Items</h4> 
   If you are missing any items deposited or returned from Website.com, you have 30 days to claim your items through a support ticket. You will be notified after 30 days. Items will not be returned if put into the jackpot and lost. All jackpot betting are FINAL.
   <h4>Valuation:</h4> Website items are valued from SteamAnalyst's database backed up with the Steam Market. Prices are subjected to change any time without notice. <br/> All deposits are final after the user confirms them on the website, there will be no refunds, since the user agrees to enter the jackpot. Agrees he is liable to losing
       his skins to another user and agrees Website is not liable for losses of any kind. 
     <h4>Responsible Gambling:</h4> 
     We do not hold responsibility for any losses. Bet responsibly, know your limits. All bets are final as you have agreed to the ToS by being on this site.
     <h4>Skin Deposits:</h4> Website.com only allows items from game “Counter Strike: Global Offensive” (non-affiliated). These skins MUST be your own.Items from different games will be declined. 
     <h4>Variation:</h4>
        Website.com may revise these terms and conditions at all time. Revised terms and conditions will apply to the use of this website from the date of the publication of the revised terms and conditions on this website. Please check this page regularly to ensure you are familiar with the current version. 
        <h4>Termination of Account:</h4>
    Any violation of service will have your account terminated/frozen with any virtual assets on it.
    <h4>Third-Party Links:</h4>
    The third-party links that are shown outside Website.com is not our responsibility. We are unaffiliated unless mentioned. That includes the content, privacy, or practices of external parties.
    <h4>Indemnification:</h4>
    By BEING on the site, you agree to defend Website and any staff affiliated against all and any claims, losses, obligations, costs and expenses arisen from breaking any section of our terms or any claim that you have broken any section of our terms.
    <h4>Affiliation:</h4>
    We are NOT in any way, shape or form affiliated with Valve corporation, Steam, Any Counter-Strike franchise, other Jackpot sites or any other trademark of the Valve/Steam corporation.
    <h4>Law and jurisdiction:</h4> 
        Our terms of service will be governed by and construed in accordance with the laws of Portugal, and any disputes relating to these terms and conditions will be subject to the exclusive jurisdiction of the courts of Portugal. <a class="close" data-page="rules"></a> </div> </div> 
        <script id="user-room-panel-template" type="text/x-handlebars-template"> <div class="ico"></div>
         <ul> <li>You've deposited - <span>{{count_user_items}}</span> (of <span>{{room.max_user_items}}</span>) item(s).</li> <li>Probably to win <span>{{me.percent}}%</span>. Min bet <span>${{room.min_user_items_value}}</span></li> </ul> </script> <script id="room-template" type="text/x-handlebars-template"> <div id="r{{id}}" class="room active" data-id="{{id}}"></div> </script> <script id="room-user-template" type="text/x-handlebars-template"> <div class="item"> <div class="row u{{openid}}" data-openid="{{openid}}" data-count-additions="{{count_additions}}"> <a href="{{url}}" target="_blank"><img src="{{avatar}}"></a> <div class="desc"> <a class="name" href="{{url}}" target="_blank">{{name}}</a> <span class="skins"><span class="count_items">{{count_items}}</span> skin(s)</span> <span class="right" onclick="system.items.sort('.i{{openid}}', this)"> <span class="si">User Items</span> <span class="price_all">{{price_all}}</span> <span class="winner hide">0</span> </span> <span class="room-price hide"></span> <span class="number hide">{{sort}}</span> </div> <div class="progress progress-striped active"> <div class="progress-bar progress-bar-striped" role="progressbar" data-transitiongoal="0"></div> </div> </div> </div> </script> <script id="item-template" type="text/x-handlebars-template"> <div class="item i{{openid}}"> <div class="row"> <div class="col-lg-11 col-lg-offset-1 img"> <img src="https://steamcommunity-a.akamaihd.net/economy/image/class/730/{{classid}}/{{width}}fx{{height}}f"> </div> <div class="col-lg-11 desc"> <span class="price">${{price}}</span> <span class="name">{{name}}</span> <span class="number hide">{{sort}}</span> </div> </div> </div> </script> <script id="chat-msg-template" type="text/x-handlebars-template"> <div class="item{{#if pull_right}} in{{/if}} item-visible msg{{msg_id}}{{#if user.is_admin}} is_admin{{/if}}"> {{#if user.is_admin}} <div class="image"><span><img alt="{{user.steam_nickname}}" src="{{user.steam_avatar}}"></span></div> {{else}} <div class="image"><a href="{{user.steam_profileurl}}" target="_blank"><img alt="{{user.steam_nickname}}" src="{{user.steam_avatar}}"></a></div> {{/if}} <div class="text"> <div class="heading"> {{#if user.is_admin}} <span class="username"><i class="fa fa-star"></i> {{user.steam_nickname}}</span> {{else}} <a href="{{#if user.is_admin}}#{{else}}{{user.steam_profileurl}}{{/if}}" target="_blank" class="username">{{user.steam_nickname}}</a> {{/if}} {{#if admin_logged}} <span onclick="system.admin.banUser('{{user.openid}}')" class="btn btn-xs btn-danger">B</span> <span onclick="system.admin.unbanUser('{{user.openid}}')" class="btn btn-xs btn-primary">U</span> <span onclick="system.admin.deleteMsg('{{msg_id}}')" class="btn btn-xs btn-warning">D</span> {{/if}} </div> <span class="date hide">{{date}}</span> <span class="msg">{{msg}}</span> </div> </div> </script> <script id="history-template" type="text/x-handlebars-template"> <div class="cont row"> <div class="col-xs-24 header"> <span class="text-left col-xs-12">{{date_humanize}}</span> <span class="text-right col-xs-12">{{winner.count_items}} item(s)</span> </div> <div class="col-xs-24 body"> <div class="col-xs-16 col-sm-16"> <a rel="nofollow" target="_blank" href="{{winner.steam_profileurl}}" class="img hidden-xs"><img src="{{winner.steam_avatarfull}}"></a> <a rel="nofollow" target="_blank" href="{{winner.steam_profileurl}}" class="name">{{winner.steam_nickname}}</a> </div> <div class="right text-right"> <span class="win">Win: <span>${{price_all}}</span></span> <span class="chance">Chance: <span>{{winner.percent}}%</span></span> </div> </div> <div class="col-xs-24 footer"> <h5>Winning with the commission</h5> {{#list items}}{{/list}} </div> </div> </script> <script id="winner-row-template" type="text/x-handlebars-template"> <tr class="{{#if is_top}} top{{/if}}"> <td class="number">{{counter}}</td> <td class="text-left"> <a rel="nofollow" target="_blank" href="{{user.steam_profileurl}}" class="img hidden-xs"><img src="{{user.steam_avatarmedium}}"></a> <a rel="nofollow" target="_blank" href="{{user.steam_profileurl}}" class="name">{{user.steam_nickname}}</a> </td> <td class="hidden-xs">{{total_wins}}</td> <td class="hidden-xs">${{total_cash}}</td> <td class="hidden-xs">${{total_won}}</td> <td class="green">+ ${{total_diff}}</td> </tr> </script> <div class="modal fade" id="lobbyAcceptModal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <form class="form-horizontal"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> <h4 class="modal-title">Deposit received</h4> </div> <div class="modal-body"> <span class="line1">You deposited <span class='items'></span> skins and they were evaluated at <span class='price'></span></span> <span class="line2">You have <span id='modal-timer'></span> seconds to reply.</span> <div class="form-group"> <div class="col-sm-offset-2 col-sm-10"> <div class="checkbox"> <label id="accept-label"> <input type="checkbox" id="accept-checkbox" value="1"> I agree with the ToS, accept the value of the skins that are beeing deposited and confirm that I'm at least 18 years old. </label> </div> </div> </div> </div> <div class="modal-footer"> <button type="button" class="btn btn-primary btn-accept">Accept and Enter the Queue</button> <button type="button" class="btn btn-danger btn-deceline">Cancel Trade Request</button> </div> </form> </div> </div> </div> <script type="text/javascript" src="frontend/js/jquery-1.11.3.min.js"></script> <script type="text/javascript" src="frontend/js/socket.io-1.3.5.js"></script> <script type="text/javascript" src="plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <script type="text/javascript" src="plugins/handlebars/handlebars-v3.0.3.js"></script> <script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script> <script type="text/javascript" src="plugins/moment/moment.min.js"></script> <script type="text/javascript" src="plugins/moment/moment-with-locales.min.js"></script> <script type="text/javascript" src="plugins/countdown/src/countdown.js"></script> <script type="text/javascript" src="plugins/pnotify/pnotify.custom.min.js"></script> <script type="text/javascript" src="plugins/circle/dist/jquery.knob.min.js"></script> <script type="text/javascript" src="plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <script type="text/javascript" src="frontend/js/jquery.easing.compatibility.js"></script> <script type="text/javascript" src="frontend/js/front7f6f.js?112"></script> <script type="text/javascript"> $(function() { moment.locale('en'); system = init({ user: { logged: "", openid: "", hash: "", sid: "", steam_nickname: "", steam_profileurl: "", steam_avatar: "", steam_avatarmedium: "", steam_avatarfull: "", sounds_enabled: true }, admin: { logged: "" }, lang: {"user_items":"User items","success":"Success","error":"Error","your_trade_success":"Your Trade URL has been added correctly","your_items_success":"Your items have been successfully accepted","your_trade_error":"Your Trade URL is not valid","items_not_accepted":"Your items were not accepted","decelineoffer":{"1":"Unfortunately your items were not accepted","2":"Unfortunately your items were not accepted","3":"Unfortunately your items were not accepted","4":"Unfortunately your items were not accepted","5":"We're sorry but you can only send 10 items at once","6":"We're sorry but sending offers have been disabled by admins","7":"You did not accept in the time that was given","8":"Your items were not accepted","9":"Enter your Trade URL before sending trade offers","10":"You can only send CSGO items","11":"The sum of your items is less than the minimum amount","12":"Unfortunately your items were not accepted"}}, title: "Website - The Best CSGO Jackpot Gambling Only", preloader: false, websocket: "https://slave.Website.com" }); system.init(); }); </script> </body> 
</html>