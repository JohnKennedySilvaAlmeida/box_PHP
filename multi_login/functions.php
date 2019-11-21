<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '123456', 'multi_login'); // OBS!!! criar ainda BD

// declaração de variável
$username = "";
$email    = "";
$errors   = array(); 

// chame a função register () se clicar em register_btn
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTRAR USUÁRIO
function register(){
	// chame essas variáveis ​​com a palavra-chave global para disponibilizá-las na função
	global $db, $errors, $username, $email;

	//recebe todos os valores de entrada do formulário. Chame a função e ()
    // definido abaixo para escapar dos valores do formulário
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// validação do formulário: verifique se o formulário foi preenchido corretamente
	if (empty($username)) { 
		array_push($errors, "Nome de usuário é obrigatório"); 
	}
	if (empty($email)) { 
		array_push($errors, "E-mail é obrigatório"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Senha requerida"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "As duas senhas não combinam");
	}

	// registra o usuário se não houver erros no formulário
	if (count($errors) == 0) {
		$password = md5($password_1);// criptografa a senha antes de salvar no banco de dados

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "Novo usuário criado com sucesso !!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// obtém o ID do usuário criado
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // coloca o usuário logado na sessão
			$_SESSION['success']  = "Agora você está logado";
			header('location: index.php');				
		}
	}
}

// retorna a matriz do usuário de seu ID
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

// -------------------------
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
    }
    
}
// --------------------------
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// desconecta o usuário se o botão logout tiver clicado
if (isset($_GET['logout'])) {
    
    session_destroy();
    
    unset($_SESSION['user']);
	header("location: login.php");
}

// chame a função login () se clicar em register_btn
if (isset($_POST['login_btn'])) {
	login();
}

// ==================================

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// valores do formulário grap
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// verifique se o formulário foi preenchido corretamente
	if (empty($username)) {
		array_push($errors, "Nome de usuário é requerido");
	}
	if (empty($password)) {
		array_push($errors, "Senha requerida");
	}

	// tenta logar se não houver erros no formulário
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // usuário encontrado
			// verifica se o usuário é administrador ou usuário
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Agora você está logado";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Agora você está logado";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Combinação de nome de usuário / senha incorreta");
		}
	}
}

// ========================

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}