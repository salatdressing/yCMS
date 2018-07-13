<?php
session_start();
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $_SESSION['username']));
 $user = $statement->fetch();
 
 $_SESSION['op_level'] = $user['op_level'];

if($_SESSION['op_level'] < 5) { //falls OP-Level zu niedrig
    die('Dir fehlen leider die Rechte um diese Seite aufzurufen.<br>Code: '. $_SESSION['op_level']);
}

if(!isset($_SESSION['userid'])) {
	die('<a href="../../index.php">Bitte logge dich ein.</a>');
}
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
$statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$result = $statement->execute(array('id' => $_GET['userid']));
$user = $statement->fetch();
$playername = $user['username'];
$rank = $user['rank'];
$userid = $user['id'];
$kuerzel = $user['kuerzel'];
$vw1 = $user['vw1'];
$vw2 = $user['vw2'];
$vw3 = $user['vw3'];
$vw1from = $user['vw1from'];
$vw2from = $user['vw2from'];
$vw3from = $user['vw3from'];

$sqlget01 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
$stmt03 = $pdo->prepare($sqlget01);
$stmt03->execute();
$postuser= $stmt03->fetch();
$pvw1 = $postuser['vw1'];
$pvw2 = $postuser['vw2'];
$pvw3 = $postuser['vw3'];

$vwwarning = "";
$vw = $_POST['vw'];
$vwfrom = $_SESSION['username'];
if($pvw1 !== NULL && $pvw2 == NULL && $pvw3 == NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw1 = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw1from = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Du hast dem User erfolgreich eine Verwarnung entzogen!<br> Er hat keine Verwarnungen mehr.";

}if($pvw1 !== NULL && $pvw2 !== NULL && $pvw3 == NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw2 = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw2from = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Du hast dem User erfolgreich eine Verwarnung entzogen!<br> Er hat nun 1 Verwarnung.";

}if($pvw1 !== NULL && $pvw2 !== NULL && $pvw3 !== NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw3 = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw3from = NULL WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Du hast dem User erfolgreich eine Verwarnung entzogen!<br>Dieser User hat nun 2 Verwarnungen!<br><a href=\"entlassen.php\">Hier entlassen</a>";

}


?>





