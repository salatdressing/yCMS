<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

function convertRank($rank){
	$handle = fopen("rank01.csv", "r");
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		if($data[0]==$rank){
			return($data[1]);
		}
	}
	if($rank==0){
		return '<font color="red">Entlassen</font>'; 
	}
	fclose($handle);
}

function ding($bfid){
	$alreadydinged=$_SESSION['dings'];
	if(!isset($alreadydinged[$bfid])){
		$alreadydinged[$bfid]=true;
		echo '<script>play_ding();</script>';
	}
	$_SESSION['dings']=$alreadydinged;
}

function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function RandomKeyNumber() {
	return mt_rand(100,999);
}




