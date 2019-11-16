<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?
  // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $codigo = $_GET['codigo'];
  //tirar espaço em branco das variaveis recebidass através de formulario

   if (getenv("REQUEST_METHOD") == "POST") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $campo1 = $_POST['campo1'];
   $campo2 = $_POST['campo2'];
   $campo3 = $_POST['campo3'];
   $campo4 = $_POST['campo4'];
   $campo5 = $_POST['campo5'];
   $campo7 = $_POST['campo7'];
   $campo8 = $_POST['campo8'] ;
   $campo9 = $_POST['campo9'];
   $preco_decimal = $_POST['preco_decimal'];
   $preco_centavos= $_POST['preco_centavos'];
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
  $campo9= nl2br($campo9);


  include ("conecta.php");
$sql = "UPDATE produtos SET codigo='$campo1',id='$campo2',id_filho='$campo3',produto='$campo5',fabricante='$campo4',preco='$preco_decimal.$preco_centavos',imagem='$campo7', autorizado='$campo8' , detalhes='$campo9'
 WHERE codigo='$campo1'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a consulta ao banco de dados");
echo "<h1>O PRODUTO foi alterado com sucesso!</h1><br><a href=\"controle_meus_produtos.php\">voltar</a><br>";
   }

?>
</BODY>
</HTML>
