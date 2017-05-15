<?php 
require_once('steamauth/steamauth.php');
@include_once('set.php');

echo'<script type="text/javascript">
  function reloadalerts(){
    $.ajax({
    type: "GET",
    dataType: "html",
    url: "alert2.php",
    success: function(msg){
      $("#alert").html(msg);
    }
  });
  }
</script>';

 $rs96=mysql_query("SELECT * FROM messages");
 $row96=mysql_fetch_array($rs96);
//$row96=array('userid'=>'76561198180430527','win'=>'1','msg'=>'cineva a castigat ceva...','value'=>'9.3');

 if(!empty($row96)){
	$ruser=mysql_query("SELECT * FROM users where steamid=$row96[userid]");
	$rowuser=mysql_fetch_array($ruser);
	$u2 = $rowuser['name'];
 	$username = fetchinfo("name", "users", "steamid", $row96['userid']);
	$mng =$row96["msg"];
	$winnington=$row96['value'];
	$chance=$row96['percent'];

  // folosesc system in bot, gen system = mesaje de la bot care trebuie sa le vada doar persoana respectiva ($row96['userid'])
 //system poate avea null sau 1, win idem.
	switch($row96){
		case ($row96['win'] ==1 && $row96['system'] == 1): // daca x castiga dar are si un mesaj de la system, sa-i apara doar lui mesajul de la system si sa-i apara ca a castigat la restu
		if($_SESSION['steamid'] == $row96['userid']){ //verifica daca sesiunea (steamid) coincide cu userid-ul de la win din baza de date, ss aici: http://i.imgur.com/GUwuXYV.png
			echo '<div class="alert" role="alert">';
			echo $row96['msg'];
			echo '</div>';

					echo'<script type="text/javascript">setTimeout(reloadalerts,10000);</script>';
		}
		else
		{
					echo'<script type="text/javascript">setTimeout(reloadalerts,1000);</script>';
			
		}
		break;
		case ($row96['win'] ==0 && $row96['system'] == 0): //gen, daca win si system == 0, sa nu returneze nimic, cred ca asta arata si la default:

					echo'<script type="text/javascript">setTimeout(reloadalerts,1000);</script>';
		break;
		case ($row96['system']==1 ): //daca e notificare de la system, adica bot
		if($_SESSION['steamid'] == $row96['userid']){ //am scris la primul case
			echo '<div class="alert alert-success" role="alert">';
			echo $row96['msg'];
				echo '</div>';
					echo'<script type="text/javascript">setTimeout(reloadalerts,10000);</script>';
		}
		else
		{
					echo'<script type="text/javascript">setTimeout(reloadalerts,1000);</script>';

		}
		break;
		case($row96['win'] == 1): //aici e daca x castiga

		//$currentgame = fetchinfo("value","info","name","current_game"); //get last win
		//$lastgame=$currentgame-1;

		$currentgame=mysql_fetch_assoc(mysql_query('SELECT `id` FROM `games` WHERE `userid`="'.$row96['userid'].'" ORDER BY `id` DESC LIMIT 1'));
		$lastgame=$currentgame['id'];

		$infolg=mysql_fetch_assoc(mysql_query('SELECT * FROM `games` WHERE `id`="'.$lastgame.'"'));
		$moreinfolg=mysql_fetch_assoc(mysql_query('SELECT * FROM `game'.$lastgame.'`'));

		$lgwinnerid=$infolg['userid'];
		$lgwinnername=$infolg['winner'];

		$lgpot=floatval($infolg['cost']);
		$lgpercent=$moreinfolg['percent'];


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
		echo '<div role="alert">';
		

		 //Aici e daca X castiga si tu esti Y, gen "X A CASTIGAT XX$"
			//if($_SERVER['REMOTE_ADDR']=='93.115.69.179')
			//{
				/*
				echo'Debugging...<br/><pre>';
				var_dump($lgplayers);

				var_dump($infolg);
				var_dump($lgwinnername);
				var_dump($lgwinnerid);
				var_dump($lgpot);
				var_dump($moreinfolg);
				var_dump($stringimages);
				echo'</pre>';*/
				echo'<div class="roulette" style="display:none;padding-left:80px;margin-bottom:4px;">';
				echo $stringimages;
				echo'</div>';
				echo'<div class="alert-success"><span id="winnername">Choosing a winner...</span>';
				echo'<span id="messagedisplay"></span></div>';

				echo"<script type=\"text/javascript\">
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
					    setTimeout(reloadalerts,12000);
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

					</script>    <script type=\"text/javascript\">function startroulette(){
  $('div.roulette').roulette('start');  
  
}
startroulette();
</script>";
				echo '<script language="JavaScript" type="text/javascript">function showwinner(){ document.getElementById("winnername").innerHTML = \'<b>'.htmlspecialchars($lgwinnername).'</b>\'; document.getElementById("messagedisplay").innerHTML = \'<br/>won the pot worth $'.$winnington.' with '.$lgplayers[$lgwinnerid]['procent'].'% chance.<br/>'.($_SESSION['steamid'] == $row96['userid'] ? '<h1>YOU WON!</h1>Please wait up to 10 minutes to receive trade offer from our bot.' : 'New game will start in 10 seconds...').'\';}</script>';
			//	echo '<script language="JavaScript" type="text/javascript">startroulette();</script>';
		

		echo '</div>';
		break;
		default: //aici tre' sa fie gol, daca nu e nici-un mesaj, sa nu afiseze nimic
					echo'<script type="text/javascript">setTimeout(reloadalerts,1000);</script>';
			break;
	}

}
	else
	{
					echo'<script type="text/javascript">setTimeout(reloadalerts,1000);</script>';

	}
// in messages o sa fie maxim 1 singur query cu "win = 1" si posibil mai multe de la system. Le dau delete o data la 30 secunde cu ajutorul la bot (pun ceva timer sa goleasca baza de date)


?>