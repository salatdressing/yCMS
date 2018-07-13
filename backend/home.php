<?php
session_start();
$session_timeout = 3600;

if(!isset($_SESSION['last_visit'])) {
    $_SESSION['last_visit'] = time();
}

if((time() - $_SESSION['last_visit']) > $session_timeout) {
    session_destroy();
}

if(!isset($_SESSION['userid'])) { ?>

<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" crossorigin="anonymous">

    <title>Bitte zuerst einloggen</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">WizCMS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" id="nav-login" href="../ajax/login.php">Bitte zuerst einloggen</a>
              </li>
            </ul>
          </div>
        </nav>
    <section class="" id="ajax-main">
        <h1 class="mx-auto container text-center mt-5">
            Du bist leider nicht eingeloggt
        </h1>
        <p class="my-auto text-center">
            Bitte <a href="../ajax/login.php">logge dich zuerst ein</a>!
        
        </p>
        <p class="ml-5 text-center text-muted">Bitte achte darauf, dass JavaScript aktiviert ist um eine reibungslose Funktion zu gewährleisten!</p>
    </section>
    <footer>
        <div class="text-center text-muted my-5">Copyright by Dan S. 2018<br>- powered by WizCMS -</div>
    </footer>
    </body>
</html>

<?php
die();
}

// ###### Datenbank PDO-Verbindung ########### //
include '../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
$statement = $pdo->prepare("SELECT * FROM config WHERE id = 1");
$result = $statement->execute();
$config = $statement->fetch();

?>
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!-- ########################################################################### -->
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" crossorigin="anonymous">

    <title><?php echo $config['sitename'] ?></title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#"><?php echo $config['sitename'] ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" id="nav-home" href="#!home">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Seite bearbeiten
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" id="nav-newarticle" href="#!newarticle">Beitrag verfassen</a>
                  <a class="dropdown-item" id="nav-editcontent" href="#!editcontent">Beitrag bearbeiten</a>
                  <a class="dropdown-item" id="nav-siteconfig" href="#!siteconfig">Seite konfigurieren</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" id="nav-adduser" href="#!adduser">Account erstellen</a>
                  <a class="dropdown-item" id="nav-dashboard" href="#!dashboard">Anmelden</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Einstellungen
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" id="nav-changepass" href="#!changepass">Passwort ändern</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <a href="../logout.php" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
            </form>
          </div>
        </nav>
    <section class="" id="ajax-main">
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
    </section>
    <!-- AJAX Seiten laden -->
        <script>
            $(document).ready(function(){
                $("#nav-home").click(function(){ // wenn mann auf Home klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){ //wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/home.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-adduser").click(function(){ // wenn mann auf Account erstellen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){ //wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/adduser.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-newarticle").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/newarticle.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-changepass").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/changepass.html", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-editcontent").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/editcontent.html", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-siteconfig").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/siteconfig.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-dashboard").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/bflist.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
    <footer>
        <div class="text-center text-muted my-5">Copyright by <?php echo $config['firstname']; ?> <?php echo $config['lastname']; ?> 2018<br>- powered by <?php echo $config['sitename']; ?> -</div>
    </footer>
    </body>
</html>




