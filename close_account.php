<?php
include("includes/header.php");

if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
	session_destroy();
	header("Location: register.php");
}


?>

<div class="main_column column">

	<h4>Fechar Conta</h4>

	Você tem certeza de que quer fechar a sua conta?<br><br>
	Fechar a sua conta irá esconder o seu perfil e toda a sua atividade de outros usuários.<br><br>
	Você poderá reabrir a sua conta a qualquer momento fazendo o login.<br><br>

	<form action="close_account.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Sim! Pode fechar!" class="danger settings_submit">
		<input type="submit" name="cancel" id="update_details" value="Nem pensar!" class="info settings_submit">
	</form>

</div>