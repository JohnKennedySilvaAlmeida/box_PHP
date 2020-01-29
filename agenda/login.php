<?php
session_start();
include_once "Usuario.class.php";
$usuario = new Usuario();
try {
  if($usuario->confere($_POST['usuario'],$_POST['senha'])) {
    $_SESSION['autenticado'] = true;
    $_SESSION['usuario'] = $_POST['usuario'];
    header('location: principal.php');
  } else {
    $_SESSION['autenticado'] = false;
    include_once "index.php";
    exit("<div class='alert alert-danger col-sm-12'>Usuário ou senha incorretos. Verifique</div>");
  }
} catch(PDOException $p){
  echo "Ocorreu um erro inesperado: ". $p->getMessage();
}

?>