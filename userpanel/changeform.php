<?php
session_start();
require_once "../logic/connect.php";$polaczenie = mysqli_connect("localhost", "root", "", "gruszka") or die("Connection Error: " . mysqli_error($polaczenie));
if (count($_POST) > 0) {
    $result = mysqli_query($polaczenie, "SELECT *from users WHERE mail='" . $_SESSION["mail"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["Password"]) {
        mysqli_query($polaczenie, "UPDATE users set Password='" . $_POST["newPassword"] . "' WHERE mail='" . $_SESSION["mail"] . "'");
        $_SESSION['contactInfoChanged'] = true;
    } else
        $message = "Dotychczasowe hasło jest nieprawidłowe.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gruszka</title>

  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/shop-item.css" rel="stylesheet">
  
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "  Uzupełnij";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "  Uzupełnij";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "  Uzupełnij";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "<br /> Nowe hasła nie są identyczne";
	output = false;
} 	
return output;
}
</script>
</head>

<body>
    
    <?php include "../static/header.php" ?>
    <?php include "../static/ChangedFormAlert.php" ?>
    <script src="../js/userPanelHeaderScript.js"></script>

    <div class="container col-4" style="margin-top: 5%; margin-bottom: 5%;">
    <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
        <div style="center;">
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
           
                <center><b>ZMIEŃ SWOJE HASŁO</b></center><br>
                
                <div class="form-group">
                    <label>Dotychczasowe hasło:</label>
                    <input type="password" class="form-control" name="currentPassword" placeholder="Wprowadź dotychczasowe hasło">
                </div>
                <br>
                <div class="form-group">
                    <label>Nowe hasło:</label>
                    <input type="password" class="form-control" name="newPassword" placeholder="Wprowadź nowe hasło">
                </div>
                <div class="form-group">
                    <label>Potwierdź nowe hasło:</label>
                    <input type="password" class="form-control" name="confirmPassword" placeholder="Potwierdź nowe hasło">
                </div>
                
                    
                
             
                
				<button type="submit" class="btn btn-primary" name="submit">Zmień</button>
                
                   
                
			
            
        </div>
    </form>
</div>
</body>
</html>

  <!-- Footer -->
  <footer class="py-4">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Gruszka.net 2019</p>
    </div>
  </footer>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/c419d26f2c.js" crossorigin="anonymous"></script>


</body>

</html>
