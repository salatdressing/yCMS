<?php
session_start(); //startet Session
if(!isset($_SESSION['userid'])) { //falls nicht eingeloggt
    die('<div class="placeholdertop"></div>Bitte zuerst <a href="../index.php">einloggen</a>');
}
    
if($_SESSION['op_level'] < 6) { //falls OP-Level zu niedrig
    die('Dir fehlen leider die Rechte um diese Seite aufzurufen.<br>Code: '. $_SESSION['op_level']);
}

include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['op_level'] > 5) {
    
        // ###### Datenbank PDO-Verbindung ########### //
        include '../../sql.php';
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
        // ##### Datenbank PDO-Verbindung ############ //


		//PUNKTE GEBEN
		$sqlget01 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
		$stmt03 = $pdo->prepare($sqlget01);
		$stmt03->execute();
		$rowplayer03 = $stmt03->fetch();
		
		$sqlget02 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
		$stmt04 = $pdo->prepare($sqlget02);
		$stmt04->execute();
		$rowplayer04 = $stmt04->fetch();
		
		
		$timeofbf = new DateTime($rowplayer04['timeofbf']);
		$timeofbf = date_format($timeofbf, 'H:i:s');
		
		$currenttime = new DateTime();
		$currenttime01 = date_format($currenttime, 'H:i:s');
		
		if($_SESSION['op_level'] > 5 &&  $_POST['playername'] !== "xxDilaraa"){
			$addpoints = $rowplayer03['points'] + 1;

			$sqlset01 = "UPDATE users SET points = '".$addpoints."' WHERE playername ='".$_POST['playername']."' ";
			$stmt04 = $pdo->prepare($sqlset01);
			$stmt04->execute();
		
        
		    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $result = $statement->execute(array('username' => $_POST['playername']));
            $user = $statement->fetch();
        
		    
			
			$sql99 = "SELECT * FROM users WHERE playername ='".$_POST['playername']." ' ";
    	    $stmt99 = $pdo->prepare($sql99);
    	    $stmt99->execute();
    	    $rowplayer99 = $stmt99->fetch();
    	    $newpoints = $rowplayer99['points'];
			
			echo "Du hast " . htmlspecialchars(trim(stripslashes($_POST['playername']))) . " einen Punkt gegeben<br>Neuer Punktestand: " . $newpoints . " Punkte";
		}  else {
			echo "Es gab einen Fehler bei der Verteilung der Punkte. Bitte versuche es erneut!";
			exit;
		}
		
}

?>