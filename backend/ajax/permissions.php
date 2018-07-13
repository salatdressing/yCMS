<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

include 'functions.php';
?>

<div class="container mx-auto">
    <h1 class="mt-5">Rechte verwalten</h1>
    <p class="">
        Hier kannst du die Rechte der einzelnen User verwalten.<br>
    </p>
    <form id="form-permissions" class="mt-5 my-auto" method="POST">
        <div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
		<select class="form-control" name="newrights">
			<option value="default" selected disabled>Bitte wähle ein Level aus</option>
            <option value="1">Protective Agent</option>
            <option value="2">Trainer</option>
            <option value="3">Mate</option>
            <option value="4">Base General</option>
            <option value="5">Rear General</option>
            <option value="6">Cabinet</option>
            <option value="7">Minister</option>
		</select>
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Rechte aktualisieren</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-permissions").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#playername").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Usernamen und einen Grund für die Verwarnung ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/permissions-b.php",
                    data: $("#form-permissions").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-permissions").reset();
                    }
                })
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('.ytool-search-box input[type="text"]').on("keyup input", function(){
    		var inputVal = $(this).val();
    		var resultDropdown = $(this).siblings(".ytool-result");
    		if(inputVal.length){
    			$.get("ajax/usersearch-b.php", {term: inputVal}).done(function(data){
    				resultDropdown.html(data);
    			});
    		} else{
    			resultDropdown.empty();
    		}
    	});
    	$(document).on("click", ".ytool-result p", function(){
    		$(this).parents(".ytool-search-box").find('input[type="text"]').val($(this).text());
    		$(this).parent(".ytool-result").empty();
    	});
    });
</script>
 
<?php
}
?>






