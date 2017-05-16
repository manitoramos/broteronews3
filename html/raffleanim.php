<?php 
@include_once('set.php');
$gamenum = fetchinfo("value","info","name","current_game");

$bank = fetchinfo("cost","games","id",$gamenum);
$timeleft = fetchinfo("starttime","games","id",$gamenum);
if($timeleft == 2147483647) $timeleft = 120;
$timeleft += 120-time();
if($timeleft === 1) {
echo '<script>
if(roulet == 0) { roulet = 1;
$(".stop-game").removeClass("hidden");
setTimeout(function(){	
$.ajax({
	type: "GET",
	url: "loadr.php",
	success: function(msg){
		$(\'.kjmhgd\').before(msg);
	}
});},2000)
}</script>';

}



?>