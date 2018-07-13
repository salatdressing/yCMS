<?php
session_start(); //startet Session
if(!isset($_SESSION['userid'])) { //falls nicht eingeloggt
    die('<div class="placeholdertop"></div>Bitte zuerst <a href="../index.php">einloggen</a>');
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


	//RECHTE ÄNDERN
	$sqlget01 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
	$stmt03 = $pdo->prepare($sqlget01);
	$stmt03->execute();
	$rowplayer03 = $stmt03->fetch();
		
	$sqlget02 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
	$stmt04 = $pdo->prepare($sqlget02);
	$stmt04->execute();
	$rowplayer04 = $stmt04->fetch();
		
	$timeofbf = new DateTime($rowplayer04['timeofbf']);
	$timeofbf = date_format($timeofbf, 'H:i:s');
		
	$currenttime = new DateTime();
	$currenttime01 = date_format($currenttime, 'H:i:s');
		
	if($_SESSION['op_level'] > 5){
		$addpoints = $rowplayer03['points'] + 1;

		$sqlset01 = "UPDATE users SET op_level = '".htmlspecialchars(trim(stripslashes($_POST['newrights'])))."' WHERE playername ='".$_POST['playername']."' ";
		$stmt04 = $pdo->prepare($sqlset01);
		$stmt04->execute();
		
        
		$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $_POST['playername']));
        $user = $statement->fetch();
			
		$sql99 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
    	$stmt99 = $pdo->prepare($sql99);
    	$stmt99->execute();
    	$rowplayer99 = $stmt99->fetch();
    	$newpoints = $rowplayer99['points'];
    	    
        $sql999 = "SELECT * FROM users WHERE username ='".$_SESSION['username']." ' ";
    	$stmt999 = $pdo->prepare($sql999);
    	$stmt999->execute();
    	$rowplayer999 = $stmt999->fetch();
    	$kuerzel = $rowplayer999['kuerzel'];
    			
	    echo "Du hast die Rechte von " . htmlspecialchars(trim(stripslashes($_POST['playername']))) . " erfolgreich geändert.<br>Neues Rechte-Level:<br>". htmlspecialchars(trim(stripslashes($_POST['newrights']))) . "";
	} else {
		echo "Es gab einen Fehler beim Ändern der Rechte. Bitte versuche es erneut!";
		exit;
	}
		
}
    
?>
    
    
    
    
    
    
    
    
    