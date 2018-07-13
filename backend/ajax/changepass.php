<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}
?>

<div class="container">
    <h1 class="mt-5">Passwort ändern</h1>
    <p class="">
        Hier kannst du dein eigenes Passwort ändern.
    </p>
    <form id="form-changepass" class="mt-5 my-auto" method="POST">
        <input id="passwort" class="form-control my-1" type="password" name="passwort" placeholder="Neues Passwort" autocomplete="off">
        <input id="passwort2" class="form-control my-1" type="password" name="passwort2" placeholder="Neues Passwort bestätigen" autocomplete="off">
        <div align="right">
            <button class="btn btn-lg btn-success mt-2" type="submit">Passwort ändern</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
    <script>
        $(document).ready(function(){
            $("#form-changepass").submit(function(e){
                e.preventDefault();
                //console.log("Success");
                if ($("#passwort").val() == "" && $("#passwort2").val() == "") {
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte fülle alle Felder aus!")
                } if($("#passwort").val() !== "" && $("#passwort2").val() == ""){
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte bestätige dein Passwort!")
                } if($("#passwort").val() == "" && $("#passwort2").val() !== ""){
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte fülle beide Felder aus!")
                } if($("#passwort").val() !== $("#passwort2").val() && $("#passwort").val() !== "" && $("#passwort2").val() !== ""){
                    $("#response-success").html("");
                    $("#response-danger").html("Die Passwörter stimmen nicht überein!")
                } if($("#passwort").val() == $("#passwort2").val() && $("#passwort").val() !== "" && $("#passwort2").val() !== "") {
                    $.ajax ({
                        type: "POST",
                        url: "ajax/changepass-b.php",
                        data: $("#form-changepass").serialize(),
                        success: function(){
                        $("#response-danger").html("")
                        $("#response-success").fadeIn();
                        $("#response-success").html("Passwort erfolgreich geändert!");
                        setTimeout(function(){
                            $("#response-success").fadeOut();
                        }, 5000)
                        document.getElementById("form-changepass").reset();
                        }
                    })
                }
            });
        });
    </script>
</div>


