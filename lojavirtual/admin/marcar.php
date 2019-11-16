<?php
   include ("../conecta.php");
if (getenv("REQUEST_METHOD") == "GET") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $codigo = $_GET['codigo'];

//tirar espaço em branco das variaveis recebidass através de formulario
$codigo = trim($codigo);


$sql = "DELETE FROM usuarios WHERE codigo='$codigo'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a exclusão dos dados.");
echo "<h1>O usuario foi excluído com êxito!</h1>";
echo "<br><a href=\"controle_usuario.php\">voltar</a>";
 }

?>

