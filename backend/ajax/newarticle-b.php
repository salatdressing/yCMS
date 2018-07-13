<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['op_level'] > 0) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $isFrom = $_SESSION['username'];
    if($title !== "" && $text !== ""){
    // ###### Datenbank PDO-Verbindung ########### //
    include '../../sql.php';
    $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass); //stellt Verbindung her
    // ##### Datenbank PDO-Verbindung ############ //
    
    $stmt = $pdo->prepare("INSERT INTO blog (title, text, isFrom) VALUES (:title, :text, :isFrom)"); //prepared das Statement
    $result = $stmt->execute(array('title' => $title, 'text' => $text, 'isFrom' => $isFrom)); //führt das Statement aus
    }
    }


?>