<?php
session_start(); //startet Session
if(!isset($_SESSION['userid'])) { //falls nicht eingeloggt
     ie('<div class="placeholdertop"></div>Bitte zuerst <a href="../index.php">einloggen</a>');
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
    
if($_SESSION['op_level'] < 6) { //falls OP-Level zu niedrig
    die('Dir fehlen leider die Rechte um diese Seite aufzurufen.<br>Code: '. $_SESSION['op_level']);
}

include 'functions.php';


if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['op_level'] > 5) {
    
    // ###### Datenbank PDO-Verbindung ########### //
    include '../../sql.php';
    $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
    // ##### Datenbank PDO-Verbindung ############ //


	//PUNKTE RESETTEN
		
	if($_SESSION['op_level'] > 5){
		$addpoints = $rowplayer03['points'] + 1;

		$sqlset01 = "UPDATE users SET points = 0 WHERE playername ='".$_POST['playername']."' ";
		$stmt04 = $pdo->prepare($sqlset01);
		$stmt04->execute();
			
		$sql99 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
    	$stmt99 = $pdo->prepare($sql99);
    	$stmt99->execute();
    	$rowplayer99 = $stmt99->fetch();
    	$newpoints = $rowplayer99['points'];
			
		echo "Du hast " . htmlspecialchars(trim(stripslashes($_POST['playername']))) . " einen Punkt gegeben<br>Neuer Punktestand: " . $newpoints . " Punkte";
	} else {
		echo "Punkte konnten nicht zurückgesetzt werden. Bitte versuche es erneut!";
		exit;
	}
}

?>