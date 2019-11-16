 <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"loginadm.php\">login</a>";
      }
else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>"; ?>
<?php
    include ("../conecta.php");


$sql = "SELECT * FROM categoria ";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a consulta ao banco de dados");
}
while ($linha=mysql_fetch_array($resultado)) {
$codigo = $linha["codigo"];
$descricao = $linha["descricao"];
$subcategoria = $linha["subcategoria"];
$endereco = $linha["endereco"];
$tipo = $linha["tipo"];
$tamanho = $linha["tamanho"];
$autorizado = $linha["autorizado"];

echo "<h1>Alterar DOWNLOADS...</h1>";
echo "<hr><br>";
echo "<form action=\"alterar_downloads_db.php?id=$id\" method=\"post\">";
echo "Código do Download: <input name='codigo_novo' type='text' value='$id' size=20><br>";
echo "Descricao:<input name=\"descricao_novo\" type=\"text\" value=\"$descricao\" size=\"30\"> *<br>";
$query = "SELECT * FROM programas ORDER BY tipo";
$query = mysql_query($query,$conexao);
 echo "<TD>Categoria : <select name=\"categoria_novo\">";
while ($linha=mysql_fetch_array($query)) {
$tipo = $linha["tipo"];

 echo "<option value=\"$tipo\" >".$tipo;
 }
 echo "</select><br>";

 $query = "SELECT * FROM categoria ORDER BY categoria";
$query = mysql_query($query,$conexao);
 echo "<TD>CATEGORIA : <select name=\"categoria_novo\">";
while ($linha=mysql_fetch_array($query)) {
$categoria = $linha["categoria"];

 echo "<option value=\"$categoria\" >".$categoria;
 }
 echo "</select><br>";
echo " Subcategoria : <input name=\"subcategoria_novo\" value='$subcategoria' >
 *<br>";
echo "endereco: </i><input name='endereco_novo' type='text'
value='$endereco'><br><br>";
echo "Tipo:<input name=\"tipo_novo\" type=\"text\"value=\"$tipo\" MAXLENGTH='30'  size=30 maxlenght=\10\"> *<br>";
echo "Tamanho:<input name=\"tamanho_novo\" value =\"$tamanho\">*<br>";
echo "Disponibilizar? (sim ou não): ";
echo "<SELECT NAME=\"autorizado_novo\">";
echo "<OPTION>sim";
echo "<OPTION >nao";
echo "</SELECT>";


echo "<input type=\"submit\" value=\"Alterar\">";
echo "</form>";
echo "<br><hr>";
}
 mysql_close($conexao);
?>



