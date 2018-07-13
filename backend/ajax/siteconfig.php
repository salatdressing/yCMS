<?php
session_start();

if($_SESSION['op_level'] < 1){
    die("Keine Rechte");
}

// ###### Datenbank PDO-Verbindung ########### //
include '../../sql.php';
$pdo = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass); //stellt Verbindung her
// ##### Datenbank PDO-Verbindung ############ //
$statement = $pdo->prepare("SELECT * FROM config WHERE id = 1");
$result = $statement->execute();
$config = $statement->fetch();
?>
<div class="container mx-auto my-5">
    <h1>Konfiguration der Webseite</h1>
    <p>Lege hier globale Einstellungen für deine Seite fest.</p><br>
    <form id="form-siteconfig" method="post" class="">
        <label for="sitename">Name der Seite</label>
        <input value="<?php echo $config['sitename']; ?>" type="text" id="sitename" name="sitename" class="form-control my-1" placeholder="Titel der Webseite" required>
        <small id="sitenameHelp" class="form-text text-muted">Der Name deiner Webseite. Wird zb. in der Navigationsleiste angezeigt.</small><br>
        <label for="firstname">Dein Vorname</label>
        <input value="<?php echo $config['firstname']; ?>" type="text" id="firstname" name="firstname" class="form-control my-1" placeholder="Vorname" required>
        <label for="lastname">Dein Nachname</label>
        <input value="<?php echo $config['lastname']; ?>" type="text" id="lastname" name="lastname" class="form-control my-1" placeholder="Nachname" required>
        <small id="nameHelp" class="form-text text-muted">Dein vollständiger Name wird u.a. im Impressum und im Copyright-Hinweis angezeigt.</small><br>
        <label for="email">Deine E-Mail Adresse</label>
        <input value="<?php echo $config['email']; ?>" type="email" id="email" name="email" class="form-control my-1" placeholder="E-Mail" required>
        <small id="emailHelp" class="form-text text-muted">Wird in Kontaktformularen und im Impressum beispielsweise verwendet.</small>
        <br>
        <div align="right">
            <button class="btn btn-success btn-lg" type="submit">Speichern</button>
        </div>
    </form>
    <div id="response-danger" class="text-danger"></div>
    <div id="response-success" class="text-success"></div>
</div>
<script>
    $(document).ready(function(){
        $("#form-siteconfig").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if (1 == 2) {
                
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/siteconfig-b.php",
                    data: $("#form-siteconfig").serialize(),
                    success: function(){
                    $("#ajax-main").animate({opacity:"0.4", filter:"alpha(opacity=40)"}, 100, function(){//wird Content auf 0.4 opacity gesetzt
                      $("#ajax-main").load("ajax/siteconfig.php", function(){ // lädt neue Seite rein
                          $("#ajax-main").animate({opacity:"1", filter:"alpha(opacity=100)"}, 100, function(){//setzt opacity wieder auf 1
                              $("#response-danger").html("")
                              $("#response-success").fadeIn();
                              $("#response-success").html("Daten erfolgreich aktualisiert!");
                          }); 
                        });
                    });
                    
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-siteconfig").reset();
                    }
                })
            }
        });
    });
</script>




