<div class="container py-5">
    <h1>Registriere dich!</h1>
    <p>
        Falls du noch keinen Account im Tool hast, kannst du hier einen erstellen.<br>
        Gib bitte deinen yToken hier ein und wähle dir ein Passwort aus.<br>
        Ein sicheres Passwort besteht aus mindestens 8 Zeichen!
    </p>
    <p class="text-muted">Noch keinen yToken bekommen? Dann wende dich an einen Admin!</p>
    <form id="form-register">
        <input class="form-control my-1" type="text" name="registerkey" id="registerkey" placeholder="yToken" required>
        <input class="form-control my-1" type="password" name="wishpw" id="wishpw" placeholder="Wähle ein Passwort" required>
        <input class="form-control my-1" type="password" name="wishpw2" id="wishpw2" placeholder="Wiederhole dein Passwort" required><br>
        <iframe class="my-2 datenschutz" src="datenschutz.html" width="100%" height="20%"></iframe><br>
		<input type="checkbox" required name="terms" id="regcheckbox">
		<label for="regcheckbox">Ich bin mindestens 16 Jahre alt und stimme der Verarbeitung und Speicherung von personenbezogenen Daten im Rahmen dieser Datenschutzerklärung ausdrücklich zu.</label>
		<div align="right">
		    <button type="submit" class="btn btn-lg btn-success">Registrieren</button>
        </div>
    </form>
    <div id="response-success" class="text-success"></div>
    <div id="response-danger" class="text-danger"></div>
</div>
<script>
    $(document).ready(function(){
        $("#form-register").submit(function(e){
            e.preventDefault();
            //console.log("Success");
            if ($("#registerkey").val() == "") {
                $("#response-success").html("");
                $("#response-danger").html("Bitte fülle alle Felder aus!")
            } else {
                $.ajax ({
                    type: "POST",
                    url: "ajax/register-b.php",
                    data: $("#form-register").serialize(),
                    success: function(data){
                    $("#response-danger").html("")
                    $("#response-success").fadeIn();
                    $("#response-success").html(data);
                    setTimeout(function(){
                        $("#response-success").fadeOut();
                    }, 10000)
                    document.getElementById("form-register").reset();
                    }
                })
            }
        });
    });
</script>