<?php
session_start();
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
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
if($pvw1 == NULL && $pvw2 == NULL && $pvw3 == NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw1 = '".$vw."' WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw1from = '".$vwfrom."' WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Die hast den User erfolgreicht verwarnt! Er hat nun 1 Verwarnung";

}if($pvw1 !== NULL && $pvw2 == NULL && $pvw3 == NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw2 = '".$vw."' WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw2from = '".$vwfrom."' WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Die hast den User erfolgreich verwarnt! Er hat nun 2 Verwarnungen.";

}if($pvw1 !== NULL && $pvw2 !== NULL && $pvw3 == NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    $sqlset01 = "UPDATE users SET vw3 = '".$vw."' WHERE playername ='".$_POST['playername']."' ";
	$stmt04 = $pdo->prepare($sqlset01);
	$stmt04->execute();
	$sqlset02 = "UPDATE users SET vw3from = '".$vwfrom."' WHERE playername ='".$_POST['playername']."' ";
	$stmt05 = $pdo->prepare($sqlset02);
	$stmt05->execute();
	
	echo "Die hast den User erfolgreich verwarnt!<br>Dieser User hat nun 3 Verwarnungen!<br><a href=\"entlassen.php\">Hier entlassen</a>";
    
    
}if($pvw1 !== NULL && $pvw2 !== NULL && $pvw3 == !NULL && $_SERVER['REQUEST_METHOD'] == "POST" ){
    echo "Dieser User hat bereits 3 Verwarnungen!<br><a href=\"entlassen.php\">Hier entlassen</a>";
}

?>