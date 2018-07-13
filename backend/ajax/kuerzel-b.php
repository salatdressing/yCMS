<?php
session_start(); //startet Session
if(!isset($_SESSION['userid'])) { //falls nicht eingeloggt
    die('<div class="placeholdertop"></div>Bitte zuerst <a href="../index.php">einloggen</a>');
}
    
if($_SESSION['op_level'] < 1) { //falls OP-Level zu niedrig
    die('Dir fehlen leider die Rechte um diese Seite aufzurufen.<br>Code: '. $_SESSION['op_level']);
}

include 'functions.php';

// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
    
$sql999 = "SELECT * FROM users WHERE username ='".$_SESSION['username']." ' ";
$stmt999 = $pdo->prepare($sql999);
$stmt999->execute();
$rowplayer999 = $stmt999->fetch();
$kuerzel = $rowplayer999['kuerzel'];
    
$crankwarning = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['op_level'] > 0 && $_POST['nkuerzel'] == "") {
    echo "Bitte gib ein Kürzel ein!";
}
    
elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['op_level'] > 0 && $_POST['nkuerzel'] !== "") {
    

    // Kürzel ändern
    if($_SESSION['op_level'] > 0 && $_POST['nkuerzel'] !== ""){
    			
    
    $sqlset01 = "UPDATE users SET kuerzel = '".htmlspecialchars(trim(stripslashes($_POST['nkuerzel'])))."' WHERE username ='".$_SESSION['username']."' ";
    $stmt04 = $pdo->prepare($sqlset01);
    $stmt04->execute();
    		
            
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $_SESSION['username']));
    $user = $statement->fetch();
    $kuerzel = $user['kuerzel'];
                
    echo "Dein neues Kürzel: [". $kuerzel . "]";
        
    } else {
    	echo "Es gab einen Fehler beim Ändern des Kürzels Bitte versuche es erneut!";
    	exit;
    }
}
    
?>




