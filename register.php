<?php
session_start();

// ###### Datenbank PDO-Verbindung ########### //
include 'seiten/sql.php';
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
    <div class="whitebox mobilebox mt-4">
    <div class="whiteboxwrap pt-5 pb-2 materialshadow animated zoomIn">
    
    <h1 class="text-center titleregister animated fadeInUp">Registriere dich!</h1>
    <p class="mt-3 text-muted text-center animated fadeInUp">Falls du noch keinen Account im yTool hast, kannst du hier einen erstellen.<br>
    Gib bitte deinen yToken hier ein und wähle dir ein Passwort aus.<br>
    Ein sicheres Passwort besteht aus mindestens 8 Zeichen!</p>
	<p class="text-center mt-4 animated fadeInUp">Noch keinen yToken bekommen? Dann wende dich an einen Admin!</p>
		<form class="text-center registerform mt-2 animated fadeIn" method="POST">
			<input size="40" maxlength="250" type="text" name="registerkey" placeholder="yToken"><br>
			<input size="40" maxlength="250" type="password" name="wishpw" placeholder="Passwort"><br>
			<input class="mb-2" size="40" maxlength="250" type="password" name="wishpw2" placeholder="Passwort wiederholen"><br>
			<iframe  class="my-2 datenschutz" src="datenschutz.html" width="80%" height="20%"></iframe>
			<input class="mt-3 css-checkbox" type="checkbox" required name="terms" id="regcheckbox">
			<label class="mt-3 css-label lite-blue-check" for="regcheckbox">Ich bin mindestens 16 Jahre alt und stimme der Verarbeitung und Speicherung von personenbezogenen Daten im Rahmen dieser Datenschutzerklärung ausdrücklich zu.<br></label>
			<button class="mt-4 btn btn-lg btn-outline-success" onclick="this.disabled=true;this.form.submit();" type="submit">Registrieren</button>
		</form>
	<p class="mt-1 text-info animated fadeIn"><a href="index.php"><i class="fas fa-angle-double-left"></i> Zurück zum Login</a></p>
    </div>
    </div>






