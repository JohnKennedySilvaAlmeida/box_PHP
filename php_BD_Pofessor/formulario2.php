<?php 
  function formulario(){
?>
<form action="formulario2.php" method="post">
    <input type="text" name="nome" placeholder="Nome"><br>
    <input type="text" name="end" placeholder="End"><br>
    <input type="submit" name="enviar" value="Enviar">
</form>
<?php
  }
  function enviar(){
    if ((isset($_POST["nome"]))&&(isset($_POST["end"]))) {
        $nome = $_POST["nome"]; 
        $end = $_POST["end"];
        echo "Nome: $nome <br>";
        echo "End: $end";
    }else{
        echo "Favor digitar o nome e o end";
    }   
  }
  if (!array_key_exists("enviar",$_POST)) {
      formulario();
  }else{
      enviar();
      echo '<br>
      <a href="formulario2.php">Voltar</a>';
  }
?>
