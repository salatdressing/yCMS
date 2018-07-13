<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

?>

<div class="container mx-auto">
    <h1 class="mt-5">yToken</h1>
    <p class="">
        Hier kannst du einen yToken generieren lassen.<br>
    </p>
    <form id="form-ytoken" class="mt-5 my-auto" method="POST">
		<input id="playername" class="form-control" required name="username_register" type="text" autocomplete="off" placeholder="Username" />
		<div align="right">
            <br>
            <button class="btn btn-lg btn-success" type="submit">yToken generieren</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-ytoken").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#playername").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Usernamen ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/ytoken-b.php",
                    data: $("#form-ytoken").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 10000)
                    document.getElementById("form-ytoken").reset();
                    }
                })
            }
        });
    });
</script>

 
<?php
}
?>




