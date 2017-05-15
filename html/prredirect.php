<?php
session_start();
$id=$_GET['id'];
$name=htmlspecialchars(base64_decode($_GET['name']));

include 'adminlist.php'; //include AFTER session is started (session_start();)
include 'chatfunctions.php';

//GIVE PERMISSIONS 777 TO chat.txt, chattoggle.txt and chatbanned.txt IF SOMETHING DOESNT WORK!!!

if(!isadmin($_SESSION['steamid']))
{
	header('location:http://steamcommunity.com/profiles/'.$id);
}

echo'<b>What do you want to do with '.$name.' (id: '.$id.')?</b><br/><br/>';

echo'- <a href="http://steamcommunity.com/profiles/'.$id.'" target="_blank">Visit his steam profile</a><br/><br/>';

echo'- <a href="chatadm.php?do=ban&amp;id='.$id.'&amp;name='.base64_encode($name).'">Ban him from chat</a> (permanently or until manual removal from chatbanned.txt)<br/>';
echo'- <a href="chatadm.php?do=mute&amp;id='.$id.'&amp;name='.base64_encode($name).'">Mute him from chat</a> (temporary ban, all bans clear every 24hrs at midnight)<br/>';
