<?
session_start();
if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}
 
// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //

if($_SESSION['op_level'] < 5) {
    die("Keine Rechte");
}
    
include 'functions.php';

    $entlassenwarnung = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['op_level'] > 4){
        
        if (empty($_POST['playername'])){ //falls Username leer
            echo 'Bitte gib einen Usernamen ein!';
        } elseif ($_POST['playername'] == "'") {
            echo "Bitte keine SQL-Injection ausführen ich kenn mich damit besser aus als du :D<br>Aber netter Versuch ;-)";
        
        } elseif ($_POST['playername'] == "°°°°°" && $_SESSION['username'] !== "superuser") {
    
            
            $stmteufail = $pdo->prepare("UPDATE users SET rank = 0, op_level = null, passwort = null WHERE playername='".$_SESSION['username']."'"); //prepared das Statement (hilft gegen SQL-Injections)
            $result = $stmteufail->execute();
            session_start();
            session_destroy();
            echo "Du kannst den Admin nicht entlassen. <br>Aber netter Versuch ;-)<br>Du hast nun leider keinen Zugang mehr zum yTool!";
        }
        else { //ansonsten verbinde mit DB und führe SQL Statement aus
        
        
        $stmteu = $pdo->prepare("UPDATE users SET rank = 0, op_level = null, passwort = null WHERE playername='".stripslashes(trim(htmlspecialchars($_POST['playername'])))."'"); //prepared das Statement (hilft gegen SQL-Injections)
        $result = $stmteu->execute();
        
        echo "Der User wurde erfolgreich entlassen!";        
        // ^ Setzt die Fehlermeldung auf "erfolgreich" ^
        }
    }
    if ($_SESSION['op_level'] < 5) {
        echo "Deine Rechte sind dafür zu niedrig!";
    }

?>