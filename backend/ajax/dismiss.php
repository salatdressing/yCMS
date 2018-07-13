<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}
?>

<div class="container">
    <h1 class="mt-5">User entlassen</h1>
    <p class="">
        Hier kannst du einen User entlassen und ihm alle Rechte entziehen.
    </p>
    <form id="form-dismiss" class="mt-5 my-auto" method="POST">
        <div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
        <div align="right">
            <button class="btn btn-lg btn-success mt-2" type="submit">Entlassen</button>
        </div>
    </form>
    <div id="response-success" class="mt-3 text-success"></div>
    <div id="response-danger" class="mt-3 text-danger"></div>
    <script>
        $(document).ready(function(){
            $("#form-dismiss").submit(function(e){
                e.preventDefault();
                //console.log("Success");
                if ($("#playername").val() == "") {
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte gib einen Usernamen ein!");
                } else {
                    $.ajax ({
                        type: "POST",
                        url: "ajax/dismiss-b.php",
                        data: $("#form-dismiss").serialize(),
                        success: function(data){
                        $("#response-danger").html("")
                        $("#response-success").fadeIn();
                        $("#response-success").html(data);
                        setTimeout(function(){
                            $("#response-success").fadeOut();
                        }, 5000)
                        document.getElementById("form-dismiss").reset();
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
</div>