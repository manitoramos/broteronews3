<?php
function isbanned($steamid)
{
	global $_SERVER;
	$addshit='';
	if(dirname($_SERVER['SCRIPT_NAME'])=='/ajax')
	{
		$addshit='../';
	}

	$bannedlist=file_get_contents($addshit.'chatbanned.txt');


	if(preg_match('#'.$steamid.'#', $bannedlist) && !isadmin($steamid))
	{
		return true;
	}
	else
	{
		return false;

	}
}

function ismuted($steamid)
{
	global $_SERVER;
	$addshit='';
	if(dirname($_SERVER['SCRIPT_NAME'])=='/ajax')
	{
		$addshit='../';
	}

	$mutedlist=file_get_contents($addshit.'chatmuted.txt');
	if(preg_match('#'.$steamid.'#', $mutedlist) && !isadmin($steamid))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function chaton()
{
	global $_SERVER;
	$addshit='';
	if(dirname($_SERVER['SCRIPT_NAME'])=='/ajax')
	{
		$addshit='../';
	}

	if(file_get_contents($addshit.'chattoggle.txt')=='OFF')
	{
		return false;
	}
	else
	{
		return true;
	}
}