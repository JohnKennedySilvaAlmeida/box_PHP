<?php

  $dado=10;
  $nome="John";
  $var='john';
  $num=10.50;

  $t="1";
  $t="2";
  $t="3";

  $t1="1";
  $t1.="2";
  $t1.="3";

  define("db_nome", "temer");
  define("porta", 8800);

  echo "Olar meu amigo $nome";
  echo "<br>";
  echo 'Olar meu amigo $nome';
  echo "<br>";
  echo "valor é $dado";
  echo "<br>";
  echo "Olar \" meu amigo\" lula";
  echo "<br>";
  echo "Olar valor".$num;
  echo "<br><br>";

  echo $t;
  echo "<br>";
  echo $t1;

  echo "<br>";
  echo "Olar, ". db_nome;

  echo "<br>";
  echo "Porta: ". porta;

?>

<h1>teste</h1>

<h1> <?= $nome;?> </h1>