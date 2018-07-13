<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="../index.php">anmelden</a>');
}if (isset($_SESSION['userid'])){
 
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $_SESSION['username']));
 $user = $statement->fetch();
 
 $_SESSION['op_level'] = $user['op_level'];
}




include 'functions.php';
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //


$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$op_level = $_SESSION['op_level'];


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['playername'] !== ""){
	//ANMELDEN
	
	if($_POST['playername'] === ''){
		exit("Bitte gib einen Usernamen ein!");
	}
	
	$sql = "SELECT * FROM users WHERE playername ='".stripslashes(trim(htmlspecialchars($_POST['playername'])))." ' ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rowplayer01 = $stmt->fetch();
	
	
	if(!$rowplayer01){
		exit("Dieser User existiert nicht!");
	}
	else{
	if($rowplayer01['rank']>301){	
		exit("Mitarbeiter mit diesem Rang können hier nicht angemeldet werden!");
	}
	if($rowplayer01['rank']==0){
		exit("Dieser User ist entlassen!");
	}
	
	$date = new DateTime();
	
	$sql789 = "SELECT * FROM bf WHERE playerid = '".stripslashes(trim(htmlspecialchars($rowplayer01['id'])))."'";
	$stmtas = $pdo->prepare($sql789);
	$stmtas->execute();
	$rowplayer02 = $stmtas->fetch();

	if($rowplayer02['savetime']!=null){
		$date->modify("+".$rowplayer02['savetime']);
		$result = date_format($date, 'Y-m-d H:i:s');
		$sql = "UPDATE bf SET timeofbf = '".$result."', savetime = null WHERE playerid = '".$rowplayer01['id']."'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}else{
		if(!$rowplayer02){
			$date->modify("+30 minutes");
			$result = date_format($date, 'Y-m-d H:i:s');
			$sql = "INSERT INTO bf (playerid,timeofbf) VALUES ('".$rowplayer01['id']."', '".$result."')";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		}else{
			exit("Dieser User ist bereits angemeldet!");
		}
	}
	}


    echo 'Du hast den User erfolgreich angemeldet!';

}

?>


