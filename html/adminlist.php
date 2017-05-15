<?php
$adminslist=array(
		'steam64ID', // ENTER ADMINS - STEAM64ID CAN BE GET THROUGH : * STEAMID.IO *
		'steam64ID' // ENTER ADMINS - STEAM64ID CAN BE GET THROUGH : * STEAMID.IO *
	);

function isadmin($steamid)
{
	global $adminslist;
	if(in_array($steamid, $adminslist))
	{
		return true;
	}
	else
	{
		return false;
	}
}