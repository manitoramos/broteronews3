<?php
require('../steamauth/steamauth.php');//antigo

//agora
//require('CSGOJackpot_Simple_v1.4_CSGO.network/html/steamauth/steamauth.php')

if(isset($_SESSION["steamid"])) {
  include_once('../steamauth/userInfo.php');
  //include_once('CSGOJackpot_Simple_v1.4_CSGO.network/html/steamauth/userInfo.php')
}

header('Content-Type: application/javascript');
?>var circle,bets=100500,timeleft=120,ms=1000,lastData='';

var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'audio.mp3');
var audioElement2 = document.createElement('audio');
audioElement2.setAttribute('src', 'msg.mp3');


window.onload = function onLoad() {
	circle = new ProgressBar.Circle('#prograsd', {
		color: '#3E83BF',
		strokeWidth: 9,
		easing: 'easeInOut',
		trailColor: "#000000"
	});
	circle.animate(1);
	setInterval("updatetimer()",1000);
	setInterval("updatemstimer()",1);
};

function updatetimer() {
	console.log('updatetimer()');
	if(timeleft>-3 && timeleft<120){
		
		timeleft=timeleft-1;
		console.log('updatetimer(): updated timeleft: '+timeleft);
		
		if(timeleft==-1 || timeleft==0){
			console.log('updatetimer(): timeleft==0, showing winner (roulette).');
			showwinnerroulette();
		}
	}
}

function updatemstimer() {
	console.log('updatemstimer()');
	var d = new Date();
	var n = 99-Math.round(d.getMilliseconds()/10);
	if(timeleft<0)
	{
		$('#timeleft').text('0.00');
	}
	else
	{
		if(timeleft == 120) n = 0;
		if(n < 0 || timeleft==0) n = 0;
		if(n < 10) $('#timeleft').text(timeleft+'.0'+n);
		else $('#timeleft').text(timeleft+'.'+n);
	}
}
 

function reloadinfo() {
	/*
	$.ajax({
		type: "GET",
		url: "currentgame.php",
		success: function(msg){
			$("#gameid").text("#"+msg);
		}
	});
	*/


	/*
	$.ajax({
		type: "GET",
		url: "timeleft.php",
		success: function(msg) {
			timeleft = msg;
		}
	});
	*/
}

function updatecircle(){
	$.ajax({
		type: "GET",
		url: "currentitems.php",
		success: function(msg){
			if(msg > 50) msg = 50;
			circle.animate(msg/50);
			$('.progressbar__label').text(msg+'/50');
		}
	});
}

function updatechance(){
	$.ajax({
		type: "GET",
		url: "currentchance.php",
		success: function(msg){
			$("#mychance").text(msg);
		}
	});
}

function updateplayersanditems()
{
	$.ajax({
		type: "GET",
		url: "itemsnew.php",
		success: function(msg){
			$('#dropboxy').html(msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "players.php",
		success: function(msg){
			$('#playersdropboxy').html(msg);
		}
	});
}

function showwinnerroulette(){
	console.log('showwinnerroulette() called.');

    $.ajax({
    type: "GET",
    dataType: "html",
    url: "alertopt.php",
    success: function(msg){
      $("#alert").html(msg);
	console.log('showwinnerroulette() SUCCESS! updating #alert...');
    }
  });
}

var statesource = new EventSource('ssecurrentstateopt.php');
    statesource.onmessage = function(e) {
         console.log('!!! SSE !!!');
        console.log('Output: '+e.data);
   	var data=JSON.parse(e.data);
        console.log('Parsed output: '+data);
        console.log('Last parsed output: '+lastData);
        if(data.bank!=lastData.bank){
        	console.log('New bank different from old bank ('+data.bank+'!='+lastData.bank+'). Updating...');
		
		console.log('Updating bank: '+data.bank);
        	$('#bank').text(data.bank);

		if(data.bank>0 && document.title!='$'+data.bank+' csgojackpotting.com.com - Jackpot yourself to Glory!'){
        		console.log('Updating title: $'+data.bank+' csgojackpotting.com.com - Jackpot yourself to Glory!');
			document.title='$'+data.bank+' csgojackpotting.com.com - Jackpot yourself to Glory!';
		} else {
			console.log('Bank is 0, setting default title.');
			document.title='csgojackpotting.com.com - Jackpot yourself to Glory!';
		}

		console.log('Updating player and items list...');
		updateplayersanditems();

		<?php if(isset($_SESSION["steamid"])): ?>
			console.log('User is logged in - updating individual chance.');
			updatechance();
		<?php else: ?>

		console.log('User is NOT logged in - individual chance not updated.');

		<?php endif; ?>
		console.log('Updating the circle and the items in the pot...');
		updatecircle();

	
        }else{
        	console.log('New bank same as old bank ('+data.bank+'=='+lastData.bank+'). No need to update anything...');
        }

	console.log('Timer// starttime: '+data.starttime+'( = 2147483647?)');
	if(data.starttime==2147483647){ //if starttime=2147483647 then game hasnt started
		console.log('Game hasn\'t started yet. No need to update the timer.');
	}else{
		console.log('Game is running.');
		timeleft=data.starttime+(120-data.time);
		console.log('Calculated timeleft as being '+timeleft+' seconds. Updated timer...'); // updatetimer() function is ran every milisecond and it reads timeleft variable

	}

        lastData = data;
    };

