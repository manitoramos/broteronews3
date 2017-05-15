<?php
session_start();

include 'chatfunctions.php';
include 'adminlist.php';



        $f_arr = file( "ajax/chat.txt" );
        $f_arr = array_reverse($f_arr);

        if(chaton())
        {
	        foreach($f_arr as $value)
	        {
	         	echo $value;
	        }
  	}
  	elseif(!chaton() && isadmin($_SESSION['steamid']))
        {
        	echo'-- CHAT IS OFF BUT ADMINS CAN STILL SEE THE MESSAGES --';
        	foreach($f_arr as $value)
	        {
	         	echo $value;
	        }
        }
  	else
  	{
  		echo'Chat unavailable.';
  	}
?>    