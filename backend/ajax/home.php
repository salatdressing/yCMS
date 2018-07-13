<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
$statement = $pdo->prepare("SELECT * FROM config WHERE id = 1");
$result = $statement->execute();
$config = $statement->fetch();
?>

<div class="text-center">
<h1 class="ml-5 mt-5">
    Willkommen im <?php echo $config['sitename'] ?> <?php echo $_SESSION['username'] ?>!
</h1>
<p class="ml-5">
    Das hier ist deine Startseite.<br>
    Du kannst diese im Admin-Bereich bearbeiten.<br>
    Das CMS befindet sich noch in der Entwicklung.
</p>
<p class="ml-5 text-muted">Bitte achte darauf, dass JavaScript aktiviert ist um eine reibungslose Funktion zu gewährleisten!</p>
</div>