<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="../index.php">anmelden</a>');
}

include 'functions.php';
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //

?>
        <p class="text-danger">Wenn man einen User aus der Liste löscht, wird die Zeit zurückgesetzt!</p>
        
		<table class="table table-bordered">
			<tr>
				<th width="30%"><i class="fas fa-user-circle"></i>  Username</th>
				<th width="20%"><i class="fas fa-trophy"></i>  Rang</th>
				<th width="30%"><i class="fas fa-clipboard-check"></i>  Nächste Beförderung</th>
				<th width="20%" style="min-width:250px;"><i class="fas fa-location-arrow"></i>  Aktionen</th>
			</tr>
<?php

$sql = "SELECT * FROM bf ORDER BY savetime, timeofbf";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch()){
						$sql = "SELECT * FROM users WHERE id ='".$row['playerid']."' ";
						$stmt02 = $pdo->prepare($sql);
						$stmt02->execute();
						$rowplayer02 = $stmt02->fetch();
						$currenttime = new DateTime();
						$currenttime01 = date_format($currenttime, 'H:i:s');
						if($row['savetime']!=null){
							if(date('Y-m-d') === date('Y-m-d', strtotime($row['timeofbf']))){
								$bftime='<span class="text-danger">Abgemeldet</span><br>Rest: '.$row['savetime'];
								$extra = '<a class="bffont bflogin bf-login" id="'. $row['playerid'] .'" title="Anmelden"><i class="fas fa-check-circle"></i></a><a class="bffont bfbadmin bf-badmins" id="'. $row['playerid'] .'" title="5 Strafminuten"><i class="fas fa-stopwatch"></i></a><a class="bffont bfdeluser bf-delete" id="'. $row['playerid'] .'" title="Aus Liste entfernen"><i class="fas fa-trash-alt"></i></a>';
							}else{
								$sqldelet02 = "DELETE FROM bf WHERE playerid ='".$row['playerid']."' ";
								$stmt06 = $pdo->prepare($sqldelet02);
								$stmt06->execute();
							}
						}else{
						    $sql = "SELECT * FROM users WHERE username ='".$_SESSION['username']." ' ";
                            $stmtkrz = $pdo->prepare($sql);
                            $stmtkrz->execute();
                            $rowplayerkrz = $stmtkrz->fetch();
                            $kuerzel = $rowplayerkrz['kuerzel'];
                            
							$timeofbf = new DateTime($row['timeofbf']);
							$timeofbf = date_format($timeofbf, 'H:i:s');
							if($timeofbf <= $currenttime01){
								$bftime="Beförderung: [CSA] " . convertRank($rowplayer02['rank']+1) . " [" . $kuerzel . "]";
								ding($row['bfid']);
								$extra = '<a class="bffont bfbf bf-bf" title="Befördern" id="'. $row['playerid'] .'"><i class="fas fa-angle-double-up"></i></a>';
							}
							
							elseif($row['train'] == "#T") {
								$bftime = new DateTime($row['timeofbf']);

								#$bftime->modify("-40 minutes");

								$bftime = date_format($bftime, 'H:i');
								$extra = '<a class="bffont bf-tmodeoff text-success" id="'. $row['playerid'] .'" title="T-Modus deaktivieren"><i class="fab fa-tumblr-square"></i></a>';
							}else{
								$bftime = new DateTime($row['timeofbf']);

								#$bftime->modify("-40 minutes");

								$bftime = date_format($bftime, 'H:i');
								$extra = '<a class="bffont bf-tmodeon text-secondary" title="T-Modus aktivieren" id="'. $row['playerid'] .'"><i class="fab fa-tumblr-square"></i></a>';

							}
						}
						
						
						if($timeofbf >= $currenttime01) {
						$extra01;
						$playerid = htmlspecialchars(trim(stripslashes($row['playerid'])));
						$playername = htmlspecialchars(trim(stripslashes($rowplayer02['playername'])));
						$rank = htmlspecialchars(trim(stripslashes(convertRank($rowplayer02['rank']))));
						echo '<tr><td>'.$playername.'</td><td>'.$rank.'</td><td>'.$bftime.' '.$row['train'].'</td><td><a class="bffont bf-logout bflogout" id="'. $row['playerid'] .'" title="Abmelden"><i class="fas fa-times-circle"></i></a>'.$extra.'</td></tr>';
						}
						if($timeofbf <= $currenttime01) {
						$extra01;
						$playerid = $row['playerid'];
						$playername = htmlspecialchars(trim(stripslashes($rowplayer02['playername'])));
						$rank = htmlspecialchars(trim(stripslashes(convertRank($rowplayer02['rank']))));
						echo '<tr><td>'.$playername.'</td><td>'.$rank.'</td><td>'.$bftime.' '.$row['train'].'</td><td><a class="bffont bf-bflogout bflogout" id="'. $row['playerid'] .'" title="Abmelden"><i class="fas fa-times-circle"></i></a>'.$extra.'</td></tr>';
						}
						$extra = null;
					}
            }
?>
		</table>




















