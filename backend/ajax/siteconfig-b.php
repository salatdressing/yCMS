<?php
session_start();

if($_SERVER['REQUEST_METHOD'] && $_SESSION['op_level'] > 0) {
    // ###### Datenbank PDO-Verbindung ########### //
    include '../../sql.php';
    $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass); //stellt Verbindung her
    // ##### Datenbank PDO-Verbindung ############ //
    $sitename = $_POST['sitename'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    
    $stmt = $pdo->prepare("UPDATE config SET sitename = :sitename, firstname = :firstname, lastname = :lastname, email = :email WHERE id = 1");
    $result = $stmt->execute(array('sitename' => $sitename, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email));
    
    
}

?>