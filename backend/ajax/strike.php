<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}


?>

<div class="container mx-auto">
    <h1 class="mt-5">Verwarnung vergeben</h1>
    <p class="">
        Hier kannst du einen User mit einer Verwarnung sanktionieren.<br>
    </p>
    <form id="form-strike" class="mt-5 my-auto" method="POST">
        <div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
        <textarea class="form-control" name="vw" rows="5" id="vw" placeholder="Grund der Verwarnung"></textarea>
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Verwarnung geben</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-strike").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#playername").val() == "" || $("#vw").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Usernamen und einen Grund für die Verwarnung ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/strike-b.php",
                    data: $("#form-strike").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-strike").reset();
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




