<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
			integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"></script>
	<title>T</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

  <script>
			var prevScrollpos = window.pageYOffset;
			window.onscroll = function () {
					var currentScrollPos = window.pageYOffset;
					if (prevScrollpos > currentScrollPos) {
							document.getElementById("navbar").style.top = "0";
					} else {
							document.getElementById("navbar").style.top = "-80px";
					}
					prevScrollpos = currentScrollPos;
			} 
	</script>
</head>	


<body style="background: black;">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!--<a class="navbar-brand" href="#">Navbar</a>-->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Bem Vindo<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>

  <br><br>
	<form class="container" action="cad.php" method="POST">
    <h5 class="text-center">Cadastrar</h5>
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="tx_nome" name="nome" aria-describedby="nomehellp" required placeholder =" Minimo 4 letras">
      <small id="idnome" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
      <label for="usuario">Usuario</label>
      <input type="text" class="form-control" id="tx_USUARIO" name="usuario" aria-describedby="usuhellp" required placeholder =" Minimo 2 letras">
      <small id="idusuario" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="tx_SENHA" name="senha" required placeholder = " Minimo 4 letras">
    </div>
		<button type="submit" class="btn btn-primary" name="enviar" onc>login</button>
		<!--<input type="submit" name="enviar" value="Enviar">-->
	</form>
	
	<marquee scrollDelay=150><font color=#00FF7F>!!! Por favor, Preencher todos os campos !!!</em></font></marquee>

  <br><br><br><br>
	<div class="card text-center">
		<div class="card-body">
			<h4 class="card-title">Jk_System</h4>
			<!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
		</div>
	</div>

</body>

</html>

<?php

  echo "<br>"; 

  if (isset($_POST["enviar"])) {

    $erros = array(); 

	$nome    = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
	$usuario = filter_input(INPUT_POST, "usuario",FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);
	$senha   = filter_input(INPUT_POST, "senha",FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);

    $vnome = strlen($_POST["nome"]);
    if ($vnome < 4 || $vnome == "") {
      $erros[] = "! Nome inválido !";
		}
		$vusuario = strlen($_POST["usuario"]);
    if ($vusuario < 2 || $vusuario == "") {
      $erros[] = "! Usuario inválido !";
		}
		$vsenha = strlen($_POST["senha"]);
    if ($vsenha < 4 || $vsenha == "") {
      $erros[] = "! Senha inválido !";
		}
		
    if (!empty($erros)) {
      foreach ($erros as $erro) {
				echo ("<script LANGUAGE='JavaScript'>
					window.alert('! Cadastro Inválido! Tente Novamente...');
					window.location.href='cad.php';
				</script>");
      }
			exit();
    }else {
			echo ("<script LANGUAGE='JavaScript'>
					window.alert('! OK ! Você esta logado');
					window.location.href='index.php';
				</script>");
		}

		echo "Dados enviados com sucesso!";
	}	

?>






