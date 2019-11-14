<?php
// define('HOST', '127.0.0.1');
// define('USUARIO', 'root');
// define('SENHA', 'canaltiyoutube');
// define('DB', 'login');

// $conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

$host = "localhost";
$db   = "login";
$user = "root";
$pass = "";

$conexao = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 


?>


