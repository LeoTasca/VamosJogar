<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Bem-vindo ao VamosJogar!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php  

	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>VamosJogar</h1>
				Faça o login ou cadastre-se abaixo!
			</div>
			<br>
			<div id="first">

				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Senha">
					<br>
					<?php if(in_array("Email ou senha incorreto<br>", $error_array)) echo  "Email ou senha incorreto<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">Não é cadastrado? Crie sua conta aqui!</a>

				</form>

			</div>

			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="Nome" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Seu nome precisa ter entre 2 e 25 caracteres<br>", $error_array)) echo "Seu nome precisa ter entre 2 e 25 caracteres<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Sobrenome" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Seu sobrenome precisa ter entre 2 e 25 caracteres<br>", $error_array)) echo "Seu sobrenome precisa ter entre 2 e 25 caracteres<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" placeholder="Confirmar Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Email já em uso<br>", $error_array)) echo "Email já em uso<br>"; 
					else if(in_array("Formato de email inválido<br>", $error_array)) echo "Formato de email inválido<br>";
					else if(in_array("Os emails não correspondem<br>", $error_array)) echo "Os emails não correspondem<br>"; ?>


					<input type="password" name="reg_password" placeholder="Senha" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirmar senha" required>
					<br>
					<?php if(in_array("Suas senhas não correspondem<br>", $error_array)) echo "Suas senhas não correspondem<br>"; 
					else if(in_array("Sua senha só pode ter letras do alfabeto de A - Z e/ou números<br>", $error_array)) echo "Sua senha só pode ter letras do alfabeto de A - Z e/ou números<br>";
					else if(in_array("Sua senha precisa ter entre 5 e 30 caracteres<br>", $error_array)) echo "Sua senha precisa ter entre 5 e 30 caracteres<br>"; ?>


					<input type="submit" name="register_button" value="Cadastrar">
					<br>

					<?php if(in_array("<span style='color: #14C800;'>Cadastro realizado com sucesso!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Cadastro realizado com sucesso!</span><br>"; ?>
					<a href="#" id="signin" class="signin">Já tem uma conta? Faça o login aqui!</a>
				</form>
			</div>

		</div>

	</div>


</body>
</html>