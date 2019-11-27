<?php 
  $dado=10;
  $nome="Paulo";
  $var='Paulo';
  $num=10.50;
  echo "Ola meu amigo $nome";
  echo "<br>";
  echo 'Ola meu amigo $nome';
  echo "<br>";
  echo "O valor é $dado <br>";
  echo 'Oi "meu amigo" mario <br>';
  echo "Oi \"meu amigo\" mario <br>";
  echo "Ola meu amigo " . $nome . "<br>";

  define("banco", "site");
  echo "Ola " . banco;

  define("db_porta", 8800);
  echo "<br>Porta do banco: " . db_porta;

?>

<h1>testes</h1>
<h1> <?= $nome; ?> </h1>



