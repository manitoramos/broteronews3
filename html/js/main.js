var circle,bets=100500,timeleft=120,ms=1000;
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'audio.mp3');
var audioElement2 = document.createElement('audio');
audioElement2.setAttribute('src', 'msg.mp3');

window.onload = function onLoad() {
	circle = new ProgressBar.Circle('#prograsd', {
		color: '#0099FF',
		strokeWidth: 12,
		easing: 'easeInOut',
		trailColor: "#000000"
	});
	circle.animate(1);
	setInterval("reloadinfo()",2500);
	setInterval("updatetimer()",1);
};

function alert2(txt,typet) {
	var n = noty({
		layout: 'bottomLeft',
		text: txt,
		type: typet,
		theme: 'relax',
		timeout: 10000,
		animation   : {
                    open  : 'animated bounceInLeft',
                    close : 'animated bounceOutLeft',
                    easing: 'swing',
                    speed : 500
                }
	});
	audioElement.play();
}

function updatetimer() {
	var d = new Date();
    var n = 99-Math.round(d.getMilliseconds()/10);
	if(timeleft == 120) n = 0;
	if(n < 0) n = 0
	if(n < 10) $('#timeleft').text(timeleft+'.0'+n);
	else $('#timeleft').text(timeleft+'.'+n);
}
 

function reloadinfo() {
	$.ajax({
		type: "GET",
		url: "currentgame.php",
		success: function(msg){
			$("#gameid").text("#"+msg);
		}
	});

	$.ajax({
		type: "GET",
		dataType: "html",
		url: "alert.php",
		success: function(msg){
			$("#alert").html(msg);
		}
	}, 3000);
	$.ajax({
		type: "GET",
		url: "currentchance.php",
		success: function(msg){
			$("#mychance").text(msg);
		}
	});

		$.ajax({
		type: "GET",
		url: "mycurrentitems.php",
		success: function(msg){
			$("#myitems").text(msg);
		}
	});


	$.ajax({
		type: "GET",
		url: "mycurrentitems.php",
		success: function(msg){
			$("#myitems").text(msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "currentitems.php",
		success: function(msg){
			if(msg > 50) msg = 50;
			circle.animate(msg/50);
			$('.progressbar__label').text(msg+'/50');
		}
	});
	$.ajax({
		type: "GET",
		url: "currentbank.php",
		success: function(msg){
			$('#bank').text(msg+'');
		}
	});
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
	$.ajax({
		type: "GET",
		url: "timeleft.php",
		success: function(msg) {
			timeleft = msg;
		}
	});
}