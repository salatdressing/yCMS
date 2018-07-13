<?php
session_start();
$session_timeout = 36000;

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

    <title><?= htmlspecialchars(trim(stripslashes($config['sitename']))) ?></title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
    <nav class="navbar navbar-light fixed-top bg-info flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?= htmlspecialchars(trim(stripslashes($config['sitename']))) ?></a>
      <div class="ycms-search-box w-100 h-100">
		<input id="s-playername" class="form-control form-control-dark w-100" name="playername" type="text" autocomplete="off" placeholder="Suche" aria-label="Search">
		<div class="ycms-result"></div>
		<div class="mt-1"></div>
	</div>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../logout.php"><span data-feather="log-out"></span> Logout</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" id="nav-home" href="#!home">
                  <span data-feather="home"></span>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Seite bearbeiten</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="chevron-down"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" id="nav-newarticle" href="#!newarticle">
                  <span data-feather="file-plus"></span>
                  Beitrag erstellen
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-editcontent" href="#!editcontent">
                  <span data-feather="edit"></span>
                  Beiträge bearbeiten
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-siteconfig" href="#!siteconfig">
                  <span data-feather="sliders"></span>
                  Konfiguration
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>User</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="chevron-down"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" id="nav-ucp" href="#!ucp">
                  <span data-feather="activity"></span>
                  User Control Panel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-changerank" href="#!changerank">
                  <span data-feather="refresh-ccw"></span>
                  Rang ändern
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-strike" href="#!strike">
                  <span data-feather="alert-octagon"></span>
                  Verwarnung
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-strike-remove" href="#!removestrike">
                  <span data-feather="x-circle"></span>
                  Verwarnung entziehen
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-dismiss" href="#!dismiss">
                  <span data-feather="user-x"></span>
                  User entlassen
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Punkte</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="chevron-down"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" id="nav-points" href="#!givepoints">
                  <span data-feather="dollar-sign"></span>
                  Punkte vergeben
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-points-remove" href="#!removepoints">
                  <span data-feather="x-circle"></span>
                  Punkte entziehen
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-points-reset" href="#!resetpoints">
                  <span data-feather="rotate-ccw"></span>
                  Punkte zurücksetzen
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Admin</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="chevron-down"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" id="nav-ytoken" href="#!ytoken">
                  <span data-feather="bar-chart-2"></span>
                  yToken generieren
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-adduser" href="#!adduser">
                  <span data-feather="user-plus"></span>
                  Account erstellen
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-cuserpass" href="#!cuserpass">
                  <span data-feather="lock"></span>
                  User-Passwort ändern
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-rechte" href="#!rechte">
                  <span data-feather="bar-chart-2"></span>
                  Rechte verwalten
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Einstellungen</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="chevron-down"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" id="nav-kuerzel" href="#!kuerzel">
                  <span data-feather="code"></span>
                  Kürzel ändern
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-changepass" href="#!changepass">
                  <span data-feather="lock"></span>
                  Passwort ändern
                </a>
              </li>
            </ul>
          </div>
        </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="ajax-main">
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
    </main>
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
                      $("#ajax-main").load("ajax/changepass.php", function(){ // lädt neue Seite rein
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
                $("#nav-ucp").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/bflist.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-cuserpass").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/cuserpass.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-dismiss").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/dismiss.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-strike").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/strike.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-strike-remove").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/strike-remove.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-changerank").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/changerank.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-kuerzel").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/kuerzel.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-rechte").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/permissions.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-points").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/points.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-points-reset").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/points-reset.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-points-remove").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/points-remove.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-ytoken").click(function(){ // wenn mann auf Beitrag verfassen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/ytoken.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
            	$('.ycms-search-box input[type="text"]').on("keyup input", function(){
            		var inputVal = $(this).val();
            		var resultDropdown = $(this).siblings(".ycms-result");
            		if(inputVal.length){
            			$.get("ajax/mainsearch-b.php", {term: inputVal}).done(function(data){
            				resultDropdown.html(data);
            			});
            		} else{
            			resultDropdown.empty();
            		}
            	});
            	$(document).on("click", ".ycms-result p", function(){
            		$(this).parents(".ycms-search-box").find('input[type="text"]').val("");
            		$(this).parent(".ycms-result").empty();
            	});
            });
        </script>
        <script>
            feather.replace();
        </script>
    </body>
</html>







