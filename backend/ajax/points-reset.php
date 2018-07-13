<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

?>

<div class="container mx-auto">
    <h1 class="mt-5">Punkte zurücksetzen</h1>
    <p class="">Hier kannst du die Punkte eines Users zurücksetzen.<br>
    </p>
    <form id="form-points-reset" class="mt-5 my-auto" method="POST">
        <div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Punkte zurücksetzen</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-points-reset").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#playername").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Usernamen ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/points-reset-b.php",
                    data: $("#form-points-reset").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 5000)
                    document.getElementById("form-points-reset").reset();
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





