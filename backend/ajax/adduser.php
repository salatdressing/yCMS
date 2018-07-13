<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}
?>


<div class="container mx-auto my-5">
    <h1 class="">Account erstellen</h1>
    <p class="">
        Hier kannst du einen Account erstellen.<br>
    </p>
    <form id="form-adduser" method="POST">
        <input id="username" class="form-control my-1" type="text" name="username" autocomplete="off" placeholder="Username">
        <input id="passwort" class="form-control my-1" type="text" name="passwort" placeholder="Passwort" autocomplete="off">
        <div align="right">
            <button class="btn btn-lg btn-success mt-2" type="submit">Account erstellen</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
    <?php 
    if($_SESSION['op_level'] > 9) {
    ?>
    <script>
        $(document).ready(function(){
            $("#form-adduser").submit(function(e){
                e.preventDefault();
                //console.log("Success");
                if ($("#username").val() == "" || $("#passwort").val() == "") {
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte gib einen Usernamen und ein Passwort ein!")
                } else {
                    $.ajax ({
                        type: "POST",
                        url: "ajax/adduser-b.php",
                        data: $("#form-adduser").serialize(),
                        success: function(){
                        $("#response-danger").html("")
                        $("#response-success").fadeIn();
                        $("#response-success").html("Account wurde erfolgreich erstellt!");
                        setTimeout(function(){
                            $("#response-success").fadeOut();
                        }, 5000)
                        document.getElementById("form-adduser").reset();
                        }
                    })
                }
            });
        });
    </script>
    
  <?php
    }
    ?>
    
    
    
    
    
    
    