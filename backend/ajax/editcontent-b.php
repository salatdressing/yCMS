  <?php

// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data
 if($_POST["action"] == "Load") 
 {
  $statement = $pdo->prepare("SELECT * FROM blog ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $output .= '
   <table class="table table-bordered">
    <tr>
     <th width="30%">Titel</th>
     <th width="40%">Text</th>
     <th width="10%">Autor</th>
     <th width="10%">Bearbeiten</th>
     <th width="10%">Löschen</th>
    </tr>
  ';
  if($statement->rowCount() > 0)
  {
   foreach($result as $row)
   {
    $output .= '
    <tr>
     <td>'.htmlspecialchars(trim(stripslashes($row["title"]))).'</td>
     <td>'.htmlspecialchars(trim(stripslashes($row["text"]))).'</td>
     <td>'.htmlspecialchars(trim(stripslashes($row["isFrom"]))).'</td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-info btn-xs update">Bearbeiten</button></td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Löschen</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td align="center">Keine Daten gefunden</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 //This code for Create new Records
 if($_POST["action"] == "Erstellen")
 {
  $statement = $pdo->prepare("
   INSERT INTO blog (title, text) 
   VALUES (:title, :text)
  ");
  $result = $statement->execute(
   array(
    ':title' => $_POST["articleTitle"],
    ':text' => $_POST["articleText"]
   )
  );
  if(!empty($result))
  {
   echo 'Beitrag erstellt';
  }
 }

 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {
  $output = array();
  $statement = $pdo->prepare(
   "SELECT * FROM blog 
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
  );
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output["title"] = $row["title"];
   $output["text"] = $row["text"];
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "Aktualisieren")
 {
  $statement = $pdo->prepare(
   "UPDATE blog 
   SET title = :title, text = :text 
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':title' => $_POST["articleTitle"],
    ':text' => $_POST["articleText"],
    ':id'   => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Beitrag aktualisiert';
  }
 }

 if($_POST["action"] == "Delete")
 {
  $statement = $pdo->prepare(
   "DELETE FROM blog WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Beitrag gelöscht';
  }
 }

}

?>