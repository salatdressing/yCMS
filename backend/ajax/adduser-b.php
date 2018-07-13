<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['op_level'] > 0) {
    if($_POST['username'] == "" || $_POST['passwort'] == ""){ //falls Username oder Passwort leer
       $infomsg = '<p class="text-danger">Bitte fülle alle Felder aus!</p>';  // gib Fehlermeldung aus (wird eig. mit AJAX gemacht)
    }
    if ($_POST['username'] !== "" && $_POST['passwort'] !== ""){ //falls Username und Passwort nicht leer
        // ###### Datenbank PDO-Verbindung ########### //
        include '../../sql.php';
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
        // ##### Datenbank PDO-Verbindung ############ //
        $username = $_POST['username'];
        $passwort = $_POST['passwort'];
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $stmtau = $pdo->prepare("INSERT INTO users (username, playername, passwort) VALUES (:username, :playername, :passwort)"); //prepared das Statement (hilft gegen SQL-Injections)
        $result = $stmtau->execute(array('username' => $username, 'playername' => $username, 'passwort' => $passwort_hash)); //führt Statement aus
        
        $infomsg = '<p class="text-success">Account erfolgreich erstellt!</p>'; //gibt Meldung aus (wird in AJAX gemacht)
    }
}


?>