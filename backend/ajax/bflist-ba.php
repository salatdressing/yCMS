<?php
session_start();


include 'functions.php';
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if($_POST["action"] == "bf-bf"){
		//BEFÖRDERN
		$sqlget01 = "SELECT * FROM users WHERE id ='".$_POST['id']." ' ";
		$stmt03 = $pdo->prepare($sqlget01);
		$stmt03->execute();
		$rowplayer03 = $stmt03->fetch();
		if($rowplayer03['rank']>301){
			echo 'Du kannst einen User mit so einem hohen Rang nicht anmelden!';
			die('Dies solltest du nicht sehen');
		}
		
		$sqlget02 = "SELECT * FROM bf WHERE playerid ='".$_POST['id']." ' ";
		$stmt04 = $pdo->prepare($sqlget02);
		$stmt04->execute();
		$rowplayer04 = $stmt04->fetch();
		
		$timeofbf = new DateTime($rowplayer04['timeofbf']);
		$timeofbf = date_format($timeofbf, 'H:i:s');
		
		$currenttime = new DateTime();
		$currenttime01 = date_format($currenttime, 'H:i:s');
		
		if($rowplayer04 and $rowplayer04['savetime']==null and $timeofbf < $currenttime01){
			$newrank = $rowplayer03['rank'] + 1;

			$sqlset01 = "UPDATE users SET rank = '".$newrank."' WHERE id ='".$_POST['id']."' ";
			$stmt04 = $pdo->prepare($sqlset01);
			$stmt04->execute();
			
			
		
			$sqldelet01 = "DELETE FROM bf WHERE playerid ='".$_POST['id']."' ";
			$stmt05 = $pdo->prepare($sqldelet01);
			$stmt05->execute();
			
			
		
		
		} else {
			echo 'Dieser User hat keine Beförderung!';
			exit;
		}
		echo 'User erfolgreich befördert!';
	} elseif ($_POST["action"] == "bf-logout"){
		//ABMELDEN
		$sql789as = "SELECT * FROM bf WHERE playerid = '".$_POST['id']."'";
		$stmtasas = $pdo->prepare($sql789as);
		$stmtasas->execute();
		$rowplayer03 = $stmtasas->fetch();
		
		if($rowplayer03['savetime']==null){
			$cdate = new DateTime();
			$odate = date_create_from_format('Y-m-d H:i:s', $rowplayer03['timeofbf']);
		
			$difftime = $odate->diff($cdate);

			$newsavetime = $difftime->format('%H hours %i min %s sec');
			
			$sql789asds = "UPDATE bf SET savetime = '".$newsavetime."' WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
			$stmtasasds = $pdo->prepare($sql789asds);
			$stmtasasds->execute();
			echo 'User erfolgreich abgemeldet!';
		}
		
		
	}elseif($_POST['action'] == "bf-bflogout"){
	    $sql789as = "SELECT * FROM bf WHERE playerid = '".$_POST['id']."'";
		$stmtasas = $pdo->prepare($sql789as);
		$stmtasas->execute();
		$rowplayer03 = $stmtasas->fetch();
		$timeofbf = new DateTime($rowplayer03['timeofbf']);
		$timeofbf = date_format($timeofbf, 'H:i:s');
		
		$currenttime = new DateTime();
		$currenttime01 = date_format($currenttime, 'H:i:s');
		
		if($rowplayer03['savetime']==null){
			$cdate = new DateTime();
			$odate = date_create_from_format('Y-m-d H:i:s', $rowplayer03['timeofbf']);
		
			$difftime = $odate->diff($cdate);

			$newsavetime = "0 hours 00 min 00 sec";
			
			$sql789asds = "UPDATE bf SET savetime = '".$newsavetime."' WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
			$stmtasasds = $pdo->prepare($sql789asds);
			$stmtasasds->execute();
			echo 'User erfolgreich abgemeldet!';
		}
	}elseif ($_POST["action"] == "bf-login"){
		//LOGIN	
		
		$sql = "SELECT * FROM users WHERE id ='".$_POST['id']." ' ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$rowplayer01 = $stmt->fetch();
	
		if($rowplayer01['rank']>301){	
			echo 'Du kannst einen User mit diesem Rang nicht befördern!';
			die('Dies solltest du nicht sehen');
		}
		
		$date = new DateTime();
	
		$sql789 = "SELECT * FROM bf WHERE playerid = '".$_POST['id']."'";
		$stmtas = $pdo->prepare($sql789);
		$stmtas->execute();
		$rowplayer02 = $stmtas->fetch();
	
		if($rowplayer02['savetime']!=null){
			$date->modify("+".$rowplayer02['savetime']);
			$result = date_format($date, 'Y-m-d H:i:s');
			$sql = "UPDATE bf SET timeofbf = '".$result."', savetime = null WHERE playerid = '".$rowplayer01['id']."'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		}else{
			$date->modify("+60 minutes");
			$result = date_format($date, 'Y-m-d H:i:s');
			echo $result;
			$sql = "INSERT INTO bf (playerid,timeofbf) VALUES ('".$rowplayer01['id']."','".$result."')";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		}

		echo 'User erfolgreich angemeldet';
	} elseif ($_POST["action"] == "bf-badmins" && $_SESSION['op_level'] > 2){
		//badminutes
		//only working when user has logout
		//5 minutes
		
		$odate = new DateTime();
	
		$sql789 = "SELECT * FROM bf WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
		$stmtas = $pdo->prepare($sql789);
		$stmtas->execute();
		$rowplayer02 = $stmtas->fetch();

		$odate->modify("+".$rowplayer02['savetime']);
		$odate->modify("+ 5 minutes");
		
		$cdate = new DateTime();
		
		$difftime = $odate->diff($cdate);

		$newsavetime = $difftime->format('%H hours %i min %s sec');
			
		$sql789asds = "UPDATE bf SET savetime = '".$newsavetime."' WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
		$stmtasasds = $pdo->prepare($sql789asds);
		$stmtasasds->execute();
		
		echo '5 Strafminuten verteilt!';
		} elseif ($_POST["action"] == "bf-delete" && $_SESSION['op_level'] > 3){
			//delete from bflist
		
			$sqldelet01 = "DELETE FROM bf WHERE playerid ='".stripslashes(trim(htmlspecialchars($_POST['id'])))."' ";
			$stmt05 = $pdo->prepare($sqldelet01);
			$stmt05->execute();
		
			echo 'User aus Liste entfernt';
		} elseif ($_POST["action"] == "bf-tmodeon"){
		$sqltmodeon = "UPDATE bf SET train = '#T' WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
		$stmttmodeon = $pdo->prepare($sqltmodeon);
		$stmttmodeon->execute();
		echo 'T-Modus aktiviert!';
		} elseif ($_POST["action"] == "bf-tmodeoff"){
		$sqltmodeoff = "UPDATE bf SET train = '' WHERE playerid = '".stripslashes(trim(htmlspecialchars($_POST['id'])))."'";
		$stmttmodeoff = $pdo->prepare($sqltmodeoff);
		$stmttmodeoff->execute();
		echo 'T-Modus deaktiviert';
		
		}else {
			echo 'Du musst einen User auswählen!';
		}
}else{
	echo 'Kein Operator angegeben!';
}


?>


