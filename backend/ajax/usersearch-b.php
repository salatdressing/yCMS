<?php
    try{
        // ###### Datenbank PDO-Verbindung ########### //
        include '../../sql.php';
        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
        // ##### Datenbank PDO-Verbindung ############ //
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
    try{
        if(isset($_REQUEST['term'])){
            $sql = "SELECT * FROM users WHERE playername COLLATE utf8_general_ci LIKE '%".$_REQUEST['term']."%' LIMIT 5";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch()){
                    echo "<p>" . htmlspecialchars(trim(stripslashes($row['playername']))) . "</p>";
                }
            } else{
                echo "<p>Kein User gefunden!</p>";
            }
        }  
    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    unset($stmt);
    unset($pdo);
?>

