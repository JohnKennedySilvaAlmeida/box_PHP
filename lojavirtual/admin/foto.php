<?
 session_start() ;
if(session_is_registered("qwert") == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;". $_SESSION["nome"];
echo $HTTP_COOKIE_VARS["admin"]."<br>";
echo "<a href=\"../logout.php\">sair do sistema</a>";?>


 <form action="upload2.php" method="post" enctype="multipart/form-data">
Envie a imagem no formato .jpg maximo 100000 bytes de tamanho<input type="file" name="foto"><BR>
Categoria<?php
include "conecta.php";
$sqlGen2 = "  SELECT id_pai,nome_categoria
         FROM categorias
         ORDER BY nome_categoria ASC";
$qryGen2 = mysql_query($sqlGen2) or die ("Ocorreu um erro - ".mysql_error()."<br><br>".$sqlPreco);
$regGen2 = mysql_fetch_array($qryGen2);
?>

<select name="campo2">
<?php do { ?>
<option value="<?=$regGen2[id_pai]?>" <?php ($reg2[id_pai] == $regGen2[id_pai]) ? print " selected" : print ""; ?>><?=$regGen2[nome_categoria]?></option>
<?php } while($regGen2 = mysql_fetch_array($qryGen2))?>
</select>

Sub-categoria
<?php
$sqlGen = "  SELECT id_filho,nome_subcategoria
         FROM subcategorias
         ORDER BY nome_subcategoria ASC";
$qryGen = mysql_query($sqlGen) or die ("Ocorreu um erro - ".mysql_error()."<br><br>".$sqlPreco);
$regGen = mysql_fetch_array($qryGen);
?>

<select name="campo3" id="id">
<?php do { ?>
<option value="<?=$regGen[id_filho]?>" <?php ($reg[id_filho] == $regGen[id_filho]) ? print " selected" : print ""; ?>><?=$regGen[nome_subcategoria]?></option>
<?php } while($regGen = mysql_fetch_array($qryGen))?>
</select>
<BR>
Fabricante<input type="text" size="15" name="campo4"><BR>
Produto<input type="text" size="15" name="campo5"><BR>
preco<input type="text" size="4" name="campo6"><BR>
detalhes<textarea rows=2 cols=20 name='campo7'>
</textarea><BR>
<input type="submit" value="Confirmar!">
</form>



  <?

}?>
