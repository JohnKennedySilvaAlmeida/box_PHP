<? include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de registro</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="header">
	<h2>Registro</h2>
</div>
<form method="post" action="register.php">

    <?php echo display_error(); ?>

	<div class="input-group">
		<label>Nome de usuário</label>
		<input type="text" name="username" value=" <?php echo $username;?> ">
	</div>
	<div class="input-group">
		<label>E-mail</label>
		<input type="email" name="email" value=" <?php echo $email;?> ">
	</div>
	<div class="input-group">
		<label>Senha</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirmar Senha</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Registo</button>
	</div>
	<!-- <p>
		já é um membro? <a href="login.php">Assinar em</a>
	</p>                        OBS!!!!   Pgina register -> erro  ??? -->
</form>
</body>
</html>



