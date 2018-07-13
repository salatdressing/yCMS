<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

?>

<div class="container mx-auto">
    <h1 class="mt-5">Kürzel ändern</h1>
    <p class="">
        Hier kannst du dein Kürzel ändern.<br>
    </p>
    <form id="form-kuerzel" class="mt-5 my-auto" method="POST">
		<input id="kuerzel" class="form-control" required name="nkuerzel" type="text" autocomplete="off" placeholder="Neues Kürzel" />
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Kürzel ändern</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-kuerzel").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#kuerzel").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib ein Kürzel ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/kuerzel-b.php",
                    data: $("#form-kuerzel").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-kuerzel").reset();
                    }
                })
            }
        });
    });
</script>
 
<?php
}
?>





