<?php

session_start();
if(isset($_SESSION['userid'])) {
    header('Location: ../backend/index');
}


// ###### Datenbank PDO-Verbindung ########### //
include 'sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //


if(isset($_GET['login'])) {
 $username = stripslashes(trim(htmlspecialchars($_POST['username'])));
 $passwort = stripslashes(trim(htmlspecialchars($_POST['passwort'])));

 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
 $result = $statement->execute(array('username' => $username));
 $user = $statement->fetch();



 if ($user !== false && password_verify($passwort, $user['passwort'])) {
	$_SESSION['userid'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['rank'] = $user['rank'];
	$_SESSION['op_level'] = $user['op_level'];
	
    header('Location: ../backend/index');
 } 
 else {
	$infomsg = '<p class="text-danger">Username oder Passwort falsch!</p>';
 }

}


?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="yCMS by Dan Schmit">
    <meta name="author" content="Dan Schmit">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
      <style>
            html,
            body {
              height: 100%;
            }
            
            body {
              display: -ms-flexbox;
              display: flex;
              -ms-flex-align: center;
              align-items: center;
              padding-top: 40px;
              padding-bottom: 40px;
              background-color: #f5f5f5;
            }
            
            .form-signin {
              width: 100%;
              max-width: 330px;
              padding: 15px;
              margin: auto;
            }
            .form-signin .checkbox {
              font-weight: 400;
            }
            .form-signin .form-control {
              position: relative;
              box-sizing: border-box;
              height: auto;
              padding: 10px;
              font-size: 16px;
            }
            .form-signin .form-control:focus {
              z-index: 2;
            }
            .form-signin input[type="email"] {
              margin-bottom: -1px;
              border-bottom-right-radius: 0;
              border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
              margin-bottom: 10px;
              border-top-left-radius: 0;
              border-top-right-radius: 0;
            }
      </style>
    <form class="form-signin" method="POST" action="?login=1">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Passwort</label>
      <input name="passwort" type="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
      <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; Copyright by Dan Schmit 2018</p>
    </form><br>
    <?php echo $infomsg; ?>
  </body>
</html>





