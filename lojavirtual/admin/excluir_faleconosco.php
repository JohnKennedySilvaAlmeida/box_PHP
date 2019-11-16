<?php
   include ("../conecta.php");
if (getenv("REQUEST_METHOD") == "GET") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $id = $_GET['id'];

//tirar espaço em branco das variaveis recebidass através de formulario
$id = trim($id);


$sql = "DELETE FROM faleconosco WHERE id='$id'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a exclusão dos dados.");
echo "<h1>O relatório foi excluido com êxito!</h1>";
echo "<br><a href=\"controle_faleconosco.php\">voltar</a>";
 }

?>

