<?php

// ###### Datenbank PDO-Verbindung ########### //
$dbname = "Datenbank-Name";
$dbhost = "dd12345.kasserver.com";
$dbuser = "Datenbank-User"; // (bei All inkl identisch mit $dbname)
$dbpass = "Passwort123";
include 'sql.php';  //<------- Normalerweise lagere ich die Variablen aus
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //


$statement = $pdo->prepare("SELECT * FROM users WHERE playername = :playername");
$result = $statement->execute(array('playername' => 'Sven'));
$user = $statement->fetch();
 
echo $user['playername'] . "<br>";
echo $user['rank'] . "<br>";


$statement = "SELECT * FROM users WHERE id > 1 ORDER BY playername";
foreach($pdo->query($statement) as $user) {
 
echo $user['playername'] . "<br>";
   
}
?>
