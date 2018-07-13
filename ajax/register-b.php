<?php
session_start();

// ###### Datenbank PDO-Verbindung ########### //
include '../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //

if(isset($_POST['registerkey'])) {
 $error = false;
 $sqlset01 = "SELECT * FROM wunschpw WHERE registerkey ='".$_POST['registerkey']."' ";
 $stmt04 = $pdo->prepare($sqlset01);
 $stmt04->execute();
 $wunschpwsquery = $stmt04->fetch();
 if($wunschpwsquery == false){
	echo 'Dieser yToken exsistiert nicht!';
	exit;
 } else {
	 $username = $wunschpwsquery['user'];
 }

 $passwort = $_POST['wishpw'];
 $passwort2 = $_POST['wishpw2'];

 if(strlen($passwort) == 0) {
 echo 'Bitte ein Passwort angeben!';
 $error = true;
 }
 if($passwort != $passwort2) {
 echo 'Die beiden Passwörter stimmen nicht überein!';
 $error = true;
 }

 if(!$error) {
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $username));
 $user = $statement->fetch();

if($user !== false) {
echo 'Dieser User existiert bereits!<br>Bitte wende dich an einen Admin.';
$error = true;
}
}

if(!$error) {
$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

$statement = $pdo->prepare("INSERT INTO users (username, playername, passwort) VALUES (:username, :playername, :passwort)");
$result = $statement->execute(array('username' => $username, 'playername' => $username, 'passwort' => $passwort_hash,));

if($result) {
     
$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$result = $statement->execute(array('username' => $username));
$user = $statement->fetch();
        
$statementas = $pdo->prepare("DELETE FROM wunschpw WHERE registerkey ='".$_POST['registerkey']."'");
$statementas->execute();
$empfaenger = "bfs-datenschutz@gurkensal.at";
$betreff = "Akzeptieren der Datenschutzbedingungen von $username";
$from = "From: yTool <bfs-datenschutz@gurkensal.at>";
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$dateTime = date('Y/m/d G:i:s');
$datadata = "/User IP: $ip /User Agent: $browser /Datum & Uhrzeit: $dateTime###---------------------------------------------------------###";
$text = "$datadata Der User $username hat die Datenschutzerklärung unter bfs.gurkensal.at/php/tool/datenschutz.html bei der Registrierung anerkannt und somit der Verarbeitung und Speicherung personenbezogener Daten aktiv zugestimmt.";

mail($empfaenger, $betreff, $text, $from);

echo 'Der Account wurde erfolgreich erstellt. Du kannst dich nun einloggen!';
$showFormular = false;
} else {
echo 'Bei der Registrierung ist leider ein Fehler aufgetreten!';
}
}
}
?>











