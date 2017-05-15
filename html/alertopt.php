<?php 

/*
require_once('steamauth/steamauth.php');
@include_once('set.php');

$message=mysql_fetch_assoc(mysql_query('SELECT * FROM `messages` WHERE `win`=1'));
if(!empty($message['userid']))
{

	$currentgame=mysql_fetch_assoc(mysql_query('SELECT `id` FROM `games` WHERE `userid`="'.$message['userid'].'" ORDER BY `id` DESC LIMIT 1'));
	$lastgame=$currentgame['id'];

	$infolg=mysql_fetch_assoc(mysql_query('SELECT * FROM `games` WHERE `id`="'.$lastgame.'"'));
	$moreinfolg=mysql_fetch_assoc(mysql_query('SELECT * FROM `game'.$lastgame.'`'));

	$lgwinnerid=$infolg['userid'];
	$lgwinnername=$infolg['winner'];

	$lgpot=floatval($infolg['cost']);
	$lgpercent=$moreinfolg['percent'];

	$winnington=$message['value'];

	$lgplayers=array();
	$aplayerq=mysql_query('SELECT DISTINCT `userid` FROM `game'.$lastgame.'`'); //fuck infinite loops bro

	$images=array();
	while($aplayer=mysql_fetch_assoc($aplayerq))
	{
		
		$moreinfoonthisplayer=mysql_fetch_assoc(mysql_query('SELECT avatar,username,SUM(value) as totalvalue FROM `game'.$lastgame.'` WHERE userid="'.$aplayer['userid'].'"'));

		$procent=round(floatval($moreinfoonthisplayer["totalvalue"])*100/$lgpot,1);

		$test1=(int)ceil((($procent/100)*50)/5);

		$lgplayers[$aplayer['userid']]=array('userid'=>$aplayer['userid'],'username'=>$moreinfoonthisplayer['username'],'avatar'=>$moreinfoonthisplayer['avatar'],'value'=>$moreinfoonthisplayer['totalvalue'],'procent'=>$procent,'imageoccurence'=>$test1);

		for($i=0;$i<$test1;$i++)
			$images[]='<img src="'.$moreinfoonthisplayer['avatar'].'" alt="'.$i.'"/>'."\n";

	}
	shuffle($images);

	$countimages=count($images);

	$images[]='<img src="'.$lgplayers[$lgwinnerid]['avatar'].'"/>'."\n";

	$stringimages=implode($images);

	echo'<script type="text/javascript" src="js/roulette/roulette.js"></script>';
	echo'<div role="alert">';

	//if($_SERVER['REMOTE_ADDR']=='93.115.69.179')
	//{
	
	echo'Debugging...<br/><pre>';
	var_dump($lgplayers);

	var_dump($infolg);
	var_dump($lgwinnername);
	var_dump($lgwinnerid);
	var_dump($lgpot);
	var_dump($moreinfolg);
	var_dump($stringimages);
	echo'</pre>';
	echo'<div class="roulette" style="display:none;padding-left:80px;margin-bottom:4px;">';
	echo $stringimages;
	echo'</div>';
	echo'<div class="alert-success"><span id="winnername">Choosing a winner...</span>';
	echo'<span id="messagedisplay"></span></div>';

	echo"<script type=\"text/javascript\">

		function timedAlert(){
			setTimeout(\"document.getElementById('alert').innerHTML='';\",12000);
		}
		// initialize!
		var option = {
		  speed : 11,
		  duration : 4,
		  stopImageNumber : ".$countimages.",
		  startCallback : function() {
		    console.log('start');
		  },
		  slowDownCallback : function() {
		    console.log('slowDown');
		  },
		  stopCallback : function($stopElm) {
		    console.log('stop');
		    showwinner();
		    timedAlert();
		  }
		}

		$('div.roulette').roulette(option); 


		// START!
		$('.start').click(function(){
		  $('div.roulette').roulette('start');  
		});

		// STOP!
		$('.stop').click(function(){
		  $('div.roulette').roulette('stop'); 
		});

		</script>
		<script type=\"text/javascript\">
		function startroulette(){
			$('div.roulette').roulette('start');  
		}
		startroulette();
		</script>
	";
	echo '<script language="JavaScript" type="text/javascript">
		function showwinner(){

			document.getElementById("winnername").innerHTML = \'<b>'.htmlspecialchars($lgwinnername).'</b>\';
			document.getElementById("messagedisplay").innerHTML = \'<br/>won the pot worth $'.$winnington.' with '.$lgplayers[$lgwinnerid]['procent'].'% chance.<br/>'
			.($_SESSION['steamid'] == $message['userid'] ? '<h1>YOU WON!</h1>Please wait up to 30 minutes to receive trade offer from our bot.' : 'New game will start in 10 seconds...').
			'\';

		}
		</script>';

	
	echo'</div>';
	}
	*/

?>