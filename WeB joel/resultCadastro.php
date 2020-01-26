
<?php
  
  $nome     = $_POST['nomeC']
  $usuario  = $_POST['usuarioC'];
  $senha    = $_POST['PasswordC'];

  $nome    = filter_input(INPUT_POST, "nomeC",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $usuario = filter_input(INPUT_POST, "usuarioC",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $senha   = filter_input(INPUT_POST, "PasswordC",FILTER_SANITIZE_FULL_SPECIAL_CHARS;

  //Verifica se o campo nome não está em branco.
  if(empty($nome) or !strstr($nome,'')) {
    echo "Favor digitar seu nome";  
  }
  //Verifica se o campo sobrenome não está em branco.
  if(empty($usuario) or !strstr($usuario,'')) {
    echo "Favor digitar seu sobrenome";
  }
  //Verifica se o campo sobrenome não está em branco.
  if(empty($senha) or !strstr($senha,'')) {
    echo "Favor digitar seu sobrenome";
  }

  echo "Resultados:"$usuario , ":", $senha, ";", $nome;
  
?>


<!-- https://github.com/JohnKennedySilvaAlmeida/box_PHP/blob/master/validar.php 


   system("find / -name bin");


   https://github.com/epellisprof/boxphp/blob/master/db_incluir.php


   http://rafaelcouto.com.br/classe-para-validacao-de-dados-com-php/


-->