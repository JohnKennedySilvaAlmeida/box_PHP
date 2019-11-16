
<? include ("topo.html"); ?><br>
  <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"loginadm.php\">login</a>";
      }
else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>"; ?>
<?php
    include ("../conecta.php");
if (getenv("REQUEST_METHOD") == "GET") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $id = $_GET['id'];

//tirar espaço em branco das variaveis recebidass através de formulario
$id = trim($id);


$sql = "SELECT * FROM faleconosco WHERE id='$id'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a consulta ao banco de dados");
}
while ($linha=mysql_fetch_array($resultado)) {
$id = $linha["id"];
$data = $linha["data"];
$texto = $linha["texto"];


echo "<h1>Visualização do texto de contato...</h1>";
echo "<hr><br>";
echo "Código do Formulário:$id<br>";
echo "Data: $data<br>";
echo "Texto:$texto<br>";

echo "<a href=\"controle_faleconosco.php\">voltar</a>";
}
 mysql_close($conexao);
?>


<? }  ?>

