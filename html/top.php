<?php 
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","en",2147485547);
	$lang = "en";
} else $lang = $_COOKIE["lang"];
$sitename = "CSGOEVO";
$title = "$sitename Top users";
@include_once('set.php');
@include_once('steamauth/steamauth.php');
@include_once('steamauth/userInfo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="simple-line-icons.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<strong class="logo"><i class="dice"></i><a href="/">CSGO<span style="color: #38C4A9;">EVO</span></a></strong>	
				<div class="heder-nav1">		
			
			<div style="float: right;height: 70px;">
				<?php
				if(!isset($_SESSION["steamid"])) {
					steamlogin();
					echo "<div class=\"div-login-set1\"><a class=\"login-set1\" href=\"#\"><i class=\"icon-social-facebook\" style=\"line-height:35px;\"></i></a><a class=\"login-set2\" href=\"#\"><i class=\"icon-social-twitter\" style=\"line-height:35px;\"></i></a>
					<a class=\"login-set2\" href=\"#\"><i class=\"icon-social-tumblr\" style=\"line-height:35px;\"></i></a><a class=\"btn1\" href=\"?login\" ><i class=\"icon-login\" style=\"line-height:35px;\"></i></a></div>";
					}
					else {
					echo '<div class="barboss22"><div class="barbossov"><img src="'.$steamprofile['avatar'].'" class="ava_top"></div><div class="barboss">'.$steamprofile['personaname'].'</div></div>';
					echo "<div class=\"div-login-set\"><a class=\"login-set\" href=\"./settings.php\"><i class=\"icon-settings\" style=\"line-height:35px;\"></i></a><a class=\"btn\" href=\"steamauth/logout.php\" ><i class=\"icon-logout\" style=\"line-height:35px;\"></i></a></div>";
					mysql_query("UPDATE users SET name='".$steamprofile['personaname']."', avatar='".$steamprofile['avatarfull']."' WHERE steamid='".$_SESSION["steamid"]."'");
					}
				?>
    		</div>
				
			</div>
	    </header>
			<div id="main">
				<div class="sidebar">
					<nav id="nav">
					<div class="barbbbb"><i class="icon-grid ic_padd" style="line-height: 44px;"></i>Navigation</div>
						<ul>
							<li><a href="/"><i class="icon-game-controller ic_padd"></i>Play</a></li>
							<li><a href="/history.php"><i class="icon-clock ic_padd"></i><?php echo $msg[$lang]["history"]; ?></a></li>
							<li><a href="/top.php"><i class="icon-trophy ic_padd"></i><?php echo $msg[$lang]["top"]; ?></a></li>
							<li><a href="/about.php"><i class="icon-question ic_padd"></i><?php echo $msg[$lang]["about"]; ?></a></li>
							<li><a href="/rls.php"><i class="icon-note ic_padd"></i><?php echo $msg[$lang]["rules"]; ?></a></li>
						</ul>
					</nav>
	
					
					<div class="bonus-block">
						<div class="box">
							<p style="padding-top: 10px;"><i class="icon-check ic_padd3"></i>  First player receive <span style="color: #38C4A9;">+10%</span> chance to win.</p>
							<div class="text-box">
								<p><i class="icon-check ic_padd2"></i> Add <span style="color: #38C4A9;">CSGOEVO</span> to your nick and get -5% to rake.</p>
							</div>
						</div>
					</div>
					<div class="last-winner">
						<div class="barbbbb" style="text-align: center;"><i class="icon-badge ic_padd" style="line-height: 44px;padding: 0 10px 0 0;"></i>Latest winners</div>
						<?php 
							$lastgame = fetchinfo("value","info","name","current_game");
							$lastwinner = fetchinfo("userid","games","id",$lastgame-1);
							$winnercost = fetchinfo("cost","games","id",$lastgame-1);
							$winnerpercent = round(fetchinfo("percent","games","id",$lastgame-1),1);
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
						?>
						<div class="visual">
							<img src="<?php echo $winneravatar ?>" alt="image description" width="109" height="109">
						</div>
						<h3 align="center"><?php echo $winnername ?></h3>
						<ul>
							<li>
								<span class="val"><?php echo $msg[$lang]["win"]; ?>:</span>
								<span class="price">$<?php echo round($winnercost,2); ?></span>
							</li>
							<li>
								<span class="val"><?php echo $msg[$lang]["chanceee"]; ?>:</span>
								<span class="price"><?php echo $winnerpercent ?>%</span>
							</li>
						</ul>
					</div>
					

				</div>
				<div class="content">
					<div class="history_game">
						<h2><?php echo $msg[$lang]["top10"]; ?></h2>
						<ul>
							<?php
							$rs = mysql_query("SELECT * FROM `users` ORDER BY `won` DESC LIMIT 10");
							$i = 1;
							while($row = mysql_fetch_array($rs)) {
							echo '<li>
								<div class="visual">
									<img src="'.$row["avatar"].'" width="105" height="105">
								</div>
								<div class="list">
									<ul>
										<li>'.$row["name"].'</li>
										<li>
											<span>'.$msg[$lang]["winnum"].': </span>
											<span class="price">'.$row["games"].'</span>
										</li>
										<li>
											<span>'.$msg[$lang]["winamount"].':</span>
											<span class="price">$'.round($row["won"],2).'</span>
										</li>
									</ul>
								</div>
								<div class="stuff">
									<div class="rate">
										<p class="win">'.$i.'</p>
									</div>
								</div>
								</li>';
								$i++;
							}
								?>
							</ul>
					</div>
						</div>
</body>
</html>