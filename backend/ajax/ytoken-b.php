<?php
session_start(); //startet Session
if(!isset($_SESSION['userid'])) { //falls nicht eingeloggt
    die('<div class="placeholdertop"></div>Bitte zuerst <a href="../index.php">einloggen</a>');
} 

if (isset($_SESSION['userid'])){
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
    die('<div class="placeholdertop"></div>Dir fehlen leider die Rechte um diese Seite aufzurufen.<br>Code: '. $_SESSION['op_level']);
    }

// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
include 'functions.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
        
if(isset($_POST['username_register']) && $_SESSION['op_level'] > 5){
	if($_POST['username_register']==""){
		echo "Du musst einen Usernamen eingeben!";
		exit;
	}
	
$registerkey = RandomKeyNumber();
$sqlgivetoken = "INSERT INTO wunschpw (registerkey, user) VALUES ('".$registerkey."','".$_POST['username_register']."')";
$stmtgt = $pdo->prepare($sqlgivetoken);
$stmtgt->execute();

echo "Der yToken für den User ".htmlspecialchars(trim(stripslashes($_POST['username_register'])))." lautet: ".$registerkey;
exit;
}


?>












