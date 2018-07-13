<?php
session_start();

if(!isset($_SESSION['userid'])) {
    die("Nicht eingeloggt");
}

?>

<div class="container box">
   <h1 class="mt-5">User Control Panel</h1>
    <p class="">
        Hier kannst du User anmelden oder sie befördern.
    </p><br>
   	<form id="form-logon" method="POST">
		<div class="ytool-search-box">
			<input id="playername" class="form-control" required name="playername" type="text" autocomplete="off" placeholder="User suchen..." />
			<div class="ytool-result"></div>
			<div class="mt-1"></div>
		</div>
		<div align="left mt-3">
		    <button class="btn btn-success" type="submit">Anmelden</button>
		</div>
	</form>
	<p id="response-danger" class="text-danger"></p>
	<p id="response-success" class="text-success"></p>
	<p id="response" class="text-success"></p>

   <br>
   
   <div align="right">
    <button type="button" id="modal_button" class="btn d-none btn-info">Beitrag erstellen</button>

   </div>
   <br />
   <div id="result-bf" class="table-responsive"> <!-- Daten Tabelle!-->

   </div>
  </div>
 </body>
</html>

<div id="articleModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Neuen Beitrag erstellen</h4>
   </div>
   <div class="modal-body">
    <input placeholder="Titel" type="text" name="title" id="title" class="form-control" />
    <br />
    <textarea class="form-control" name="text" rows="5" placeholder="Dein Text" id="text"></textarea><br>
    <br />
   </div>
   <div class="modal-footer">
    <input type="hidden" name="id" id="id" />
    <input type="submit" name="action" id="action" class="btn btn-success" />
    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
   </div>
  </div>
 </div>
</div>

<script>
$(document).ready(function(){

function updateBF (){
    $('#result-bf').load('ajax/bflist-b.php');
}
window.setInterval(updateBF, 1000);
 updateBF();

//RESET
 $('#modal_button').click(function(){
  $('#articleModal').modal('show'); 
  $('#title').val(''); 
  $('#text').val(''); 
  $('.modal-title').text("Neuen Beitrag erstellen"); 
  $('#action').val('Erstellen'); 
 });


 $('#action').click(function(){
  var articleTitle = $('#title').val(); 
  var articleText = $('#text').val(); 
  var id = $('#id').val();  
  var action = $('#action').val();  
  if(articleTitle != '' && articleText != '') 
  {
   $.ajax({
    url : "ajax/editcontent-b.php",    
    method:"POST",     
    data:{articleTitle:articleTitle, articleText:articleText, id:id, action:action},
    success:function(){

    }
   });
  }
  else
  {
   $("#response").html("Bitte fülle beide Felder aus"); 
  }
 });
 
//Befördern
 $(document).on('click', '.bf-bf', function(){

  var id = $(this).attr("id"); 
  var action = "bf-bf";  
  $.ajax({
   url:"ajax/bflist-ba.php",  
   method:"POST",    
   data:{id:id, action:action},
   success:function(data){
     
    swal("Erfolgreich befördert!", "Du hast den User erfolgreich befördert!", "success");
   }
  });
 });
 
//Anmelden
 $(document).on('click', '.bf-login', function(){

  var id = $(this).attr("id"); 
  var action = "bf-login";  
  $.ajax({
   url:"ajax/bflist-ba.php",  
   method:"POST",    
   data:{id:id, action:action},
   success:function(data){
     
    swal("Erfolgreich angemeldet!", "Du hast den User erfolgreich angemeldet!", "success");
   }
  });
 });

//Abmelden
 $(document).on('click', '.bf-logout', function(){
  var id = $(this).attr("id"); 
  var action = "bf-logout";  
  $.ajax({
   url:"ajax/bflist-ba.php",  
   method:"POST",    
   data:{id:id, action:action},
   success:function(data){

      
    swal("Erfolgreich abgemeldet!", "Du hast den User erfolgreich abgemeldet!", "success");
   }
  });
 });
 
//Abmelden wenn BF
 $(document).on('click', '.bf-bflogout', function(){
  var id = $(this).attr("id"); 
  var action = "bf-bflogout";  
  $.ajax({
   url:"ajax/bflist-ba.php",  
   method:"POST",    
   data:{id:id, action:action},
   success:function(data){

      
    swal("Erfolgreich abgemeldet!", "Du hast den User erfolgreich abgemeldet!", "success");
   }
  });
 });
 
 
//badmins
 $(document).on('click', '.bf-badmins', function(){
  var id = $(this).attr("id"); 
  var action = "bf-badmins";  
  $.ajax({
   url:"ajax/bflist-ba.php",  
   method:"POST",    
   data:{id:id, action:action},
   success:function(data){
    
    swal("Erfolgreich bestraft!", "Du hast dem User erfolgreich 5 Strafminuten gegeben!", "success");
   }
  });
 });


 //Aus Liste löschen
 $(document).on('click', '.bf-delete', function(){
  var id = $(this).attr("id"); 
  if(confirm("Möchtest du diesen User wirklich aus der Liste löschen?")) 
  {
   var action = "bf-delete"; 
   $.ajax({
    url:"ajax/bflist-ba.php",    
    method:"POST",     
    data:{id:id, action:action}, 
    success:function(data)
    {
      
     swal("Erfolgreich entfernt!", "Du hast dem User aus der Liste gelöscht!", "success");
    }
   });
  }
  else 
  {
   return false;
  }
 });

});
</script>
<script type="text/javascript">
    function play_ding() {
    	var audioElement = new SpeechSynthesisUtterance("Jemand hat Beförderung!");
        audioElement.lang = "de-DE";
        window.speechSynthesis.speak(audioElement);
    }
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
    if($_SESSION['op_level'] > 0) {
    ?>
    <script>
        $(document).ready(function(){
            $("#form-logon").submit(function(e){
                e.preventDefault();
                //console.log("Success");
                if ($("#playername").val() == "") {
                    $("#response-success").html("");
                    $("#response-danger").html("Bitte gib einen Usernamen ein!");
                } else {
                    $.ajax ({
                        type: "POST",
                        url: "ajax/bflist-bl.php",
                        data: $("#form-logon").serialize(),
                        success: function(data){
                        $("#response-danger").html("");
                        $("#response-success").fadeIn();
                        $("#response-success").html(data);
                        swal("Erfolgreich angemeldet!", "Du hast den User erfolgreich angemledet!", "success");
                        setTimeout(function(){
                            $("#response-success").fadeOut();
                        }, 5000)
                        document.getElementById("form-logon").reset();
                        }
                    })
                }
            });
        });
    </script>
    
  <?php
    }
    ?>







