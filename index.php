<?php
session_start();
// ###### Datenbank PDO-Verbindung ########### //
include 'sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
$statement = $pdo->prepare("SELECT * FROM config WHERE id = 1");
$result = $statement->execute();
$config = $statement->fetch();
?>
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title><?php echo $config['sitename']; ?></title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#"><?php echo $config['sitename']; ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" id="nav-home" href="#!home">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-news" href="#!news">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav-contact" href="#!contact">Kontakt</a>
              </li>
            </ul>
            <form class="form-inline mr-2 my-2 my-lg-0">
              <a href="ajax/login" target="_blank" class="btn btn-outline-success my-2 my-sm-0">Login</a>
            </form>
            <form class="form-inline my-2 my-lg-0">
              <a href="#!register" id="nav-register" class="btn btn-outline-info my-2 my-sm-0">Registrieren</a>
            </form>
          </div>
        </nav>
    <section class="" id="ajax-main">
    <style>
        /* GLOBAL STYLES
        -------------------------------------------------- */
        /* Padding below the footer and lighter body text */
        
        body {
          color: #5a5a5a;
        }
        
        
        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */
        
        /* Carousel base class */
        .carousel {
          margin-bottom: 4rem;
        }
        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
          bottom: 3rem;
          z-index: 10;
        }
        
        /* Declare heights because of positioning of img element */
        .carousel-item {
          height: 32rem;
          background-color: #777;
        }
        .carousel-item > img {
          position: absolute;
          top: 0;
          left: 0;
          min-width: 100%;
          height: 32rem;
        }
        
        
        /* MARKETING CONTENT
        -------------------------------------------------- */
        
        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
          margin-bottom: 1.5rem;
          text-align: center;
        }
        .marketing h2 {
          font-weight: 400;
        }
        .marketing .col-lg-4 p {
          margin-right: .75rem;
          margin-left: .75rem;
        }
        
        
        /* Featurettes
        ------------------------- */
        
        .featurette-divider {
          margin: 5rem 0; /* Space out the Bootstrap <hr> more */
        }
        
        /* Thin out the marketing headings */
        .featurette-heading {
          font-weight: 300;
          line-height: 1;
          letter-spacing: -.05rem;
        }
        
        
        /* RESPONSIVE CSS
        -------------------------------------------------- */
        
        @media (min-width: 40em) {
          /* Bump up size of carousel content */
          .carousel-caption p {
            margin-bottom: 1.25rem;
            font-size: 1.25rem;
            line-height: 1.4;
          }
        
          .featurette-heading {
            font-size: 50px;
          }
        }
        
        @media (min-width: 62em) {
          .featurette-heading {
            margin-top: 7rem;
          }
        }
    </style>
     <main role="main">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item">
            <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Werde Teil einer großen Community.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Mitglied werden</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item active">
            <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>Herzlich Willkommen im <?php echo $config['sitename']; ?> <?php echo $_SESSION['username']."!"; ?></h1>
                <p>Performance. User Experience. Ein kleines CMS mit viel Power!</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Mehr erfahren</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>Dies ist ein Beispiel.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Mehr Infos</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Zurück</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Weiter</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Titel</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">Details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Titel</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">Details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Titel</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">Details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Performance. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">User Experience. <span class="text-muted">Überzeug dich selbst.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Und zu guter letzt. <span class="text-muted">Sicherheit.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->
    </main>
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
                $("#nav-contact").click(function(){ // wenn mann auf Account erstellen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){ //wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/contact.html", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-news").click(function(){ // wenn mann auf Account erstellen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){ //wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/blog.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100); //setzt opacity wieder auf 1
                      });
                  });
                  
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#nav-register").click(function(){ // wenn mann auf Account erstellen klickt
                  $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){ //wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/register.php", function(){ // lädt neue Seite rein
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







