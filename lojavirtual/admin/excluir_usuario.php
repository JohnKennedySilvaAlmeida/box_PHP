<?php
  session_start() ;
if($_SESSION['qwert'] == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;". $_SESSION["qwert"]."&nbsp&nbsp";
echo "<font face='Arial' size='2'>Confira abaixo, as areas configuraveis: <a href=\"logoutadmin.php\">sair</a></font>" ;
   include ("../conecta.php");
if (getenv("REQUEST_METHOD") == "GET") {
    $codigo = $_GET['codigo'];

//tirar espaço em branco das variaveis recebidass através de formulario
$codigo = trim($codigo);




$sql = "DELETE FROM usuarios WHERE codigo='$codigo'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a exclusão dos dados.");

echo "<h1>O usuario foi excluído com êxito!</h1>";
echo "<br><a href=\"controle_usuario.php\">voltar</a>";
 }
 
 }

?>

