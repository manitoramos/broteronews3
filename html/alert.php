<?php 
require('steamauth/steamauth.php');
@include_once('set.php');

 $rs96=mysql_query("SELECT * FROM messages");
 $row96=mysql_fetch_array($rs96);
 if(!empty($row96)){


 //var_dump($row96);
	 $ruser=mysql_query("SELECT * FROM users where steamid=$row96[userid]");
	 $rowuser=mysql_fetch_array($ruser);
}
 		$u2 = $rowuser['name'];
 		$username = fetchinfo("name", "users", "steamid", $row96['userid']);
		$mng =$row96["msg"];
		$winnington=$row96['value'];
		$chance=$row96['percent'];
 /*
// WHILE, if someone win, you'll see this, winner, if you're logged in, any guest(s)
	while($row96=mysql_fetch_array($rs96)){
		if($row96['win'] !="NULL") {
		$username = fetchinfo("name", "users", "steamid", $row96['userid']);
		$mng =$row96["msg"];
		if($_SESSION['steamid'] == $row96['userid']) {
			echo '<div class="alert alert-success" id="myMsg" role="alert">';
			echo $row96["msg"];
			echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
			echo '</div>';
		}

		else  {
		$rs96=mysql_query("SELECT * FROM messages");
		$row96=mysql_fetch_array($rs96);
		$username = fetchinfo("name", "users", "steamid", $row96['userid']);
		$winnington=$row96['value'];
		$chance=$row96['percent'];
		echo '<div class="alert alert-success" id="myMsg" role="alert">';
		echo $username.' won this jackpot, total wins: $'.$winnington.' with %'.$chance.' chanceEEEEEEee';
		echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
		echo '</div>';
}
}
}



while($row96){
		if($_SESSION['steamid'] == $row96['userid'] && $row96["system"]!="NULL") {
			echo '<div class="alert alert-success" id="myMsg" role="alert">';
			echo $row96["msg"];
			echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
			echo '</div>';
		}
}
var_dump($row96['system']);
*/
/* //mg
switch($row96){
	case ($_SESSION['steamid'] == $row96['userid'] && $row96['win']==1 ):
	echo '<div class="alert alert-success" id="myMsg" role="alert">';
	echo 'Congratulations, '.$username.'. You won jackpot worth $'.$row96['value'];
	break;
	case ($_SESSION['steamid'] != $row96['userid'] && $row96['win']==1 ):
	echo '<div class="alert alert-success" id="myMsg" role="alert">';
	echo $username;
	break;
	default:

}
*/
if(!empty($row96)){
/*
switch($row96){
	case ($row96['win']==1):
	if($_SESSION['steamid']==$row96['userid']){
	echo '<div class="alert alert-success" role="alert">';
	echo 'Congratulations, '.$username.'. You won jackpot worth $'.$row96['value'];
				echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
			echo '</div>';
}
else {
	echo '<div class="alert alert-success" role="alert">';
	echo $u2.' won jackpot worth $'.$winnington;
				echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
			echo '</div>';
}

	case ($row96['system']==1 ):
	if($_SESSION['steamid'] == $row96['userid']){
		echo '<div class="alert alert-success" role="alert">';
		echo $row96['msg'];
					echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
			echo '</div>';
	}
	break;
	case($row96['system'] && $row96['win'] ==1):
	echo $row96['msg'];
	break;
	default:
}
*/
  // folosesc system in bot, gen system = mesaje de la bot care trebuie sa le vada doar persoana respectiva ($row96['userid'])
 //system poate avea null sau 1, win idem.
	switch($row96){
		case ($row96['win'] ==1 && $row96['system'] == 1): // daca x castiga dar are si un mesaj de la system, sa-i apara doar lui mesajul de la system si sa-i apara ca a castigat la restu
		if($_SESSION['steamid'] == $row96['userid']){ //verifica daca sesiunea (steamid) coincide cu userid-ul de la win din baza de date, ss aici: http://i.imgur.com/GUwuXYV.png
			echo '<div class="alert alert-success" role="alert">';
			echo $row96['msg'];
			echo '</div>';

		}
		break;
		case ($row96['win'] ==0 && $row96['system'] == 0): //gen, daca win si system == 0, sa nu returneze nimic, cred ca asta arata si la default:

		break;
		case ($row96['system']==1 ): //daca e notificare de la system, adica bot
		if($_SESSION['steamid'] == $row96['userid']){ //am scris la primul case
			echo '<div class="alert alert-success" role="alert">';
			echo $row96['msg'];
				echo '</div>';
		}
		break;
		case($row96['win'] == 1): //aici e daca x castiga

		if($_SESSION['steamid']==$row96['userid']) { //aici daca X castiga si X esti tu, gen "FELICITARI, TU AI CASTIGAT XX$"
		echo '<div class="alert alert-success" role="alert">';
		echo 'Congratulations, '.$username.'. You won jackpot worth $'.$row96['value'];
					echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
				echo '</div>';
		}
		else { //Aici e daca X castiga si tu esti Y, gen "X A CASTIGAT XX$"
			echo '<div class="alert alert-success" role="alert">';
			echo $u2.' won jackpot worth $'.$winnington;
						echo '<script language="JavaScript" type="text/javascript">timedMsg()</script>';
					echo '</div>';
		}

		break;
		default: //aici tre' sa fie gol, daca nu e nici-un mesaj, sa nu afiseze nimic
	}

}
// in messages o sa fie maxim 1 singur query cu "win = 1" si posibil mai multe de la system. Le dau delete o data la 30 secunde cu ajutorul la bot (pun ceva timer sa goleasca baza de date)


?>