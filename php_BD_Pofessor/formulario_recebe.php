<?php 
  //print_r($_POST);

if ((isset($_POST["nome"]))&&(isset($_POST["end"]))) {
    $nome = $_POST["nome"]; 
    $end = $_POST["end"];
    echo "Nome: $nome <br>";
    echo "End: $end";
}  

?>
<br>
<a href="formulario.php">Voltar</a>