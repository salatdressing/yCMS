<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['op_level'] > 0) {
    if($_POST['passwort'] == ""){ //falls Passwort leer
       echo 'Bitte gib ein Passwort ein!';// gib Fehlermeldung aus (wird eig. mit AJAX gemacht)
    }
    if ($_POST['passwort'] !== "" && $_SESSION['op_level'] > 8 && $_POST['playername'] !== "superuser"){ //falls Passwort nicht leer
        // ###### Datenbank PDO-Verbindung ########### //
        include '../../sql.php';
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
        // ##### Datenbank PDO-Verbindung ############ //
        $username = $_POST['playername'];
        $passwort = $_POST['passwort'];
        
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("UPDATE users SET passwort = :passwort WHERE username = :username");
        $result = $statement->execute(array("passwort" => $passwort_hash, "username" => $username));
    
        echo 'Passwort erfolgreich geändert!';
    }
}

?>