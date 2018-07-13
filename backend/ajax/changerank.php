<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

include 'functions.php';
?>

<div class="container mx-auto">
    <h1 class="mt-5">Rang manuell ändern</h1>
    <p class="">
        Hier kannst du den Rang eines Users manuell ändern.<br>
    </p>
    <form id="form-changerank" class="mt-5 my-auto" method="POST">
        <div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
		<select class="form-control" name="newrank">
		    <option value="default" selected disabled>Bitte wähle einen Rang aus</option>
			<option class="text-danger" value="0">Entlassen</option>
			<?php
			$i = 1;
			while($i < 312){
				echo '<option value="'.$i.'">'.convertRank($i).'</option>';
				$i++;
			}
			$i = 600;
			while($i == 600 || $i == 601){
				echo '<option value="'.$i.'">'.convertRank($i).'</option>';
				$i++;
			}
			?>
        <br>
		</select>
		<div align="right">
        <br>
        <button class="btn btn-lg btn-success" type="submit">Rang ändern</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
</div>
<?php 
if($_SESSION['op_level'] > 0) { ?>
 
<script>
    $(document).ready(function(){
        $("#form-changerank").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#playername").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte gib einen Usernamen und einen Grund für die Verwarnung ein!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/changerank-b.php",
                    data: $("#form-changerank").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 10000)
                    document.getElementById("form-changerank").reset();
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






