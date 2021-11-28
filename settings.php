<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="main_column column">

	<h4>Configurações da conta</h4>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	<br>
	<a href="upload.php">Carregar nova foto do perfil</a> <br><br><br>

	Modifique os valores e clique em 'Atualizar Informações'.

	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	?>

	<form action="settings.php" method="POST">
		Nome: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
		Sobrenome: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
		Email: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><br>

		<?php echo $message; ?>

		<input type="submit" name="update_details" id="save_details" value="Atualizar Informações" class="info settings_submit"><br>
	</form>

	<h4>Alterar senha</h4>
	<form action="settings.php" method="POST">
		Senha Atual: <input type="password" name="old_password" id="settings_input"><br>
		Senha Nova: <input type="password" name="new_password_1" id="settings_input"><br>
		Confirmar Senha Nova: <input type="password" name="new_password_2" id="settings_input"><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Atualizar Senha" class="info settings_submit"><br>
	</form>

	<h4>Fechar Conta</h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Fechar Conta" class="danger settings_submit">
	</form>


</div>