<?php include('../functions.php') ?>


<!DOCTYPE html>
<html>
<head>
	<title>Sistema de registro - Criar usuário</title>   <!--  ou criar produto - mesma logica  -->
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			/* background: #003366; */
			background: blueviolet;
		}
		button[name=register_btn] {
			background: blueviolet;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Criar novo usuário</h2>
	</div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Nome de usuário</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">                          <!--  funcoes PHP  -->
			<label>E-mail</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Tipo de usuário</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>  <!--  tipo usuario   -->
			</select>
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
			<!-- <button type="submit" class="btn" name="register_btn"> + Create user</button> -->
		    <button type="submit" class="btn" name="register_btn"> + Criar Usuário</button>
		</div>
	</form>
</body>
</html>