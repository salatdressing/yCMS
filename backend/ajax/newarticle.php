<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}


?>

<div class="container mx-auto">
    <h1 class="mt-5">Beitrag verfassen</h1>
    <p class="">
        Hier kannst du der News-Seite einen neuen Artikel hinzufügen.<br>
    </p>
    <form id="form-newarticle" class="mt-5 my-auto" method="POST">
        <input id="title" class="form-control" type="text" name="title" autocomplete="off" placeholder="Titel"><br>
        <textarea name="text" id="editor">Erstelle hier deinen Beitrag</textarea>
		<script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.then( editor => {
					console.log( editor );
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Beitrag veröffentlichen</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-newarticle").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#title").val() == "" || $("#editor").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Titel und/oder einen Text ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/newarticle-b.php",
                    data: $("#form-newarticle").serialize(),
                    success: function(){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html("Der Beitrag wurde erfolgreich veröffentlicht!");
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-newarticle").reset();
                    }
                })
            }
        });
    });
</script>
 
<?php
}
?>


