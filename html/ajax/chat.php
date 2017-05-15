<?php 
session_start();

include '../adminlist.php'; //include AFTER session is started (session_start();)
include '../chatfunctions.php'; //include AFTER including adminlist.php

include ('../steamauth/userInfo.php');
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    $today = date("H:i:s | d.m.Y");
    if ($_POST['massage'] == '') {
        die('<script>alert("Error! The message can\'t be empty!")</script>');
    }
    if (strlen($_POST['massage']) < 3) {
        die('<script>alert("Error! Very short message min. 3 characters")</script>');
    }
    if (strlen($_POST['massage']) > 300) {
        die('<script>alert("Error! Very long message, max. 300 characters!")</script>');
    }
    //die('<script>alert("'.isbanned($steamprofile['steamid']).'")</script>');
    if (isbanned($steamprofile['steamid']))
    {
        die('<script>alert("Error! You are banned from using the chat.")</script>');
    }
    if (ismuted($steamprofile['steamid']))
    {
        die('<script>alert("Error! You are muted from chat by an admin. The punishment lasts 24hrs.")</script>');
    }
    if(!isset($_SESSION['steamid'])) {
    echo '<script>alert("Error! Only logged in users can write in chat!")</script>';
    }
    else {
        $massage=htmlspecialchars($_POST['massage']); //no xss sir

        //filtre noi, ca alea vechi erau de praf.
        $cuvintedecacat=array(
            'nigger',
            'fuck',
            'shit',
            'faggot',
            'jew',
            'hitler',
            'bestpot',
            'csgobestpot',
            'csgobestpot.com',
            'csgoskinwin.com',
            'csjackpot.pl',
            );

        foreach($cuvintedecacat as $cuvant)
        {
            if(preg_match('#'.$cuvant.'#i', $massage)) {
                echo '<script>alert("Our system thinks that you may have used an innapropriate word or phrase in the chat and it was censored. If you are using innapropriate language or you are spamming you will get banned.")</script>';
            }

        }

        $massage=str_ireplace($cuvintedecacat, '****', $massage); //ireplace=case insensitive
        //

    $file = 'chat.txt';
    $adminss = array(
        'steam64id', // ADD YOUR STEAM64ID HERE * STEAMID.IO *
        'steam64id',
        );
    foreach($adminss as $culoarez){ 
        if($culoarez == $steamprofile['steamid']) { 
            $steamprofile['personaname']= '<font color=#33D633><b>'.htmlspecialchars($steamprofile['personaname']).'</b></font>';
            $massage = '<font color="#EA7526"> <i>'.$massage.'</i></font>';}
    }
    //if ($steamprofile['steamid'] == '76561198126259709') {
    //    $massage = '<font color="#EA7526"><i>'.$massage.'</i></font>';
    //}

    // The new man, which must be added to the file
    $personoriginal = '<div class="chat-msg">
                <div class="caht-ava"><img src="'.$steamprofile['avatarmedium'].'" width="30px"></div>
                <div class="caht-name"><a href="'.$steamprofile['profileurl'].'" target="_blank">'.$steamprofile['personaname'].'</a></div>
                <div class="caht-dateid">'.$today.'</div>
                <div class="msg-text">'.$massage.'</div>
            </div>';

    $person = '<div class="chat-msg"><div class="caht-name"><img class="caht-ava" src="'.$steamprofile['avatarmedium'].'" width="20px"><a href="prredirect.php?id='.$steamprofile['steamid'].'&amp;name='.base64_encode($steamprofile['personaname']).'" target="_blank" title="'.$today.'">'.$steamprofile['personaname'].'</a>: '.$massage.'</div></div>';
    // Write the contents of a file,
    // Using the flag FILE_APPEND flag to append content to the file
    // Flag LOCK_EX to prevent the recording of the file someone else at this time
    file_put_contents($file, $person.file_get_contents($file), LOCK_EX);
        }
    exit;
}