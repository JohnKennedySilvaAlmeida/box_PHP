<?
 session_start() ;
if($_SESSION['qwert'] == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;". $_SESSION["qwert"]."&nbsp&nbsp";
echo "<font face='Arial' size='2'>Confira abaixo, as areas configuraveis: <a href=\"logoutadmin.php\">sair</a></font>" ?>
<?php
   if (getenv("REQUEST_METHOD") == "POST") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $campo1 = $_POST['campo1'];
   $campo2 = $_POST['campo2'];
   $campo3 = $_POST['campo3'];
   $campo4 = $_POST['campo4'];
   $campo5 = $_POST['campo5'];
   $campo6 = $_POST['campo6'];
   $campo7 = $_POST['campo7'];
   $campo8 = $_POST['campo8'];
   $campo9 = $_POST['campo9'];
   $campo10 = $_POST['campo10'];
   $campo11 = $_POST['campo11'];
   $campo12 = $_POST['campo12'];
   $campo13 = $_POST['campo13'];
   $campo14 = $_POST['campo14'];
   $campo15 = $_POST['campo15'];
   $campo16 = $_POST['campo16'];
   $campo17 = $_POST['campo17'];
   $campo18 = $_POST['campo18'];
//tirar espaço em branco das variaveis recebidass através de formulario
  $campo1 = trim( $campo1);
  $campo2 = trim( $campo2);
  $campo3 = trim( $campo3);
  $campo4 = trim( $campo4);
  $campo5 = trim( $campo5);
  $campo6 = trim( $campo6);//preco
  $campo7 = trim( $campo7);
  $campo8 = trim( $campo8);
  $campo9 = trim( $campo9);
  $campo10 = trim( $campo10);
  $campo11 = trim( $campo11);
  $campo12 = trim( $campo12);
  $campo13 = trim( $campo13);
  $campo14 = trim( $campo14);
  $campo15 = trim( $campo15);
  $campo16 = trim( $campo16);
  $campo17 = trim( $campo17);
  $campo18 = trim( $campo18);
  
  include ("../conecta.php");
$sql = "UPDATE usuarios SET codigo='$campo18',nome='$campo1'
,cpf='$campo2'
,email='$campo3',
sexo='$campo4',
telefone='$campo5',
ip='$campo14',
endereco='$campo6',
estado='$campo8',
cidade='$campo7',
bairro='$campo9',
cep='$campo10',
pais='$campo11',
login='$campo12',
senha='$campo13',
data='$campo15',
autorizado='$campo16',
receber='$campo17'
WHERE codigo='$campo18'";

 $resultado = mysql_query($sql)
or die ("Não foi possível realizar a consulta ao banco de dados");
echo "<h1>O status do usuario foi alterado com sucesso!</h1><br><a href=\"controle_usuario.php\">voltar</a>";
   }
    mysql_close($conexao);
?>



<? }  ?>

