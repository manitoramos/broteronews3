<?php
session_start();
$do=$_GET['do'];
$id=$_GET['id'];

include 'adminlist.php'; //include AFTER session is started (session_start();)
include 'chatfunctions.php';

//GIVE PERMISSIONS 777 TO chat.txt, chattoggle.txt and chatbanned.txt IF SOMETHING DOESNT WORK!!!

if(!isadmin($_SESSION['steamid']))
{
	die('Unauthorized');
}

if($do=='clear') //clear chat
{
	$confirm=$_GET['confirm'];
	$name=htmlspecialchars(base64_decode($_GET['name']));
	if($confirm=='yes')
	{
		if(file_put_contents('ajax/chat.txt','')===FALSE)
		{
			echo'Error clearing chat! Maybe chat.txt doesn\'t exist or doesnt have propper permissions (777)?';
		}
		else
		{
			echo'Chat successfully cleared!';
		}
	}
	else
	{
		echo'Are you sure you want to delete all the chat messages?<br/>';
		echo'<a href="chatadm.php?do=clear&amp;confirm=yes">Yes, clear all the messages!</a>';
	}
}
elseif($do=='toggle')
{
	if(chaton())
	{
		if(file_put_contents('chattoggle.txt','OFF'))
		{
			echo'Chat turned OFF!<br/>';
			echo'Do you want to also <a href="chatadm.php?do=clear">clear the chat</a>?';
		}
		else
		{
			echo'Error turning chat off! Maybe chattoggle.txt doesn\'t exist or doesnt have propper permissions (777)?';
		}

	}
	else
	{
		if(file_put_contents('chattoggle.txt','ON'))
		{
			echo'Chat turned ON!<br/>';
			echo'Do you want to also <a href="chatadm.php?do=clear">clear the chat</a>?';
		}
		else
		{
			echo'Error turning chat off! Maybe chattogle.txt doesn\'t exist or doesnt have propper permissions (777)?';
		}	
	}
}
elseif($do=='ban')
{
	$confirm=$_GET['confirm'];
	$name=htmlspecialchars(base64_decode($_GET['name']));
	if($confirm=='yes')
	{
		$baninfo=$name.' (ID: '.$id.') was banned '.date('l jS \of F Y h:i:s A').' by Admin ID: '.$_SESSION['steamid']."\r\n";
		if(file_put_contents('chatbanned.txt', $baninfo, FILE_APPEND | LOCK_EX))
		{
			echo'User with id '.$id.' is now BANNED from using the chat. To unban him manually edit the chatbanned.txt file and remove his steam id from the list.';
		}
		else
		{
			echo'Error banning user! Maybe chatbanned.txt doesn\'t exist or doesnt have propper permissions (777)?';
		}
	}
	else
	{
		echo'Are you sure you want to ban the user with the name '.$name.' and steam id '.$id.'?<br/>';
		echo'<a href="chatadm.php?do=ban&amp;confirm=yes&amp;id='.$id.'&amp;name='.base64_encode($name).'">Yes, ban '.$name.'!</a>';
	}
}
elseif($do=='mute')
{
	$confirm=$_GET['confirm'];
	$name=htmlspecialchars(base64_decode($_GET['name']));
	if($confirm=='yes')
	{
		$baninfo=$name.' (ID: '.$id.') was muted '.date('l jS \of F Y h:i:s A').' by Admin ID: '.$_SESSION['steamid']."\r\n";
		if(file_put_contents('chatmuted.txt', $baninfo, FILE_APPEND | LOCK_EX))
		{
			echo'User with id '.$id.' is now BANNED from using the chat. To unban him manually edit the chatbanned.txt file and remove his steam id from the list.';
		}
		else
		{
			echo'Error banning user! Maybe chatmuted.txt doesn\'t exist or doesnt have propper permissions (777)?';
		}
	}
	else
	{
		echo'Are you sure you want to mute the user with the name '.$name.' and steam id '.$id.'?<br/>';
		echo'<a href="chatadm.php?do=mute&amp;confirm=yes&amp;id='.$id.'&amp;name='.base64_encode($name).'">Yes, mute '.$name.'!</a>';
	}
}
else
{
	echo'What are you doing here?';
}