<Script Language="JavaScript">
function getStates(what) {
   if (what.selectedIndex != '') {
      var estado = what.value;
      document.location=('teste2.php?estado=' + estado);
   }
}
</Script>
<?php
$estado=$_GET['estado'];
$conexao=mysql_pconnect("localhost","root","123");
mysql_select_db("bdteste", $conexao);
$query = "select * from opt_estado order by id";
$result = mysql_query($query) or die(mysql_error());
$query = stripslashes($query);
?>

<select name="estado" onChange="getStates(this);">
<option value="">selecione seu estado</option> <?php
while ($row = mysql_fetch_row($result)){
$est = $row[1];
$id = $row[0];
?>
<option value=<?echo $est;?> <? if ($estado==$est){ echo "SELECTED";} ?> > <? echo $est; ?> </option> <?
}
?>
</select>
<?php
$query2 = "select * from opt_cidades where uf='$estado'";
$result2= mysql_query($query2) or die(mysql_error());
$query2 = stripslashes($query2);
if ($estado){ ?>
<select name="cidade">
<option value="">selecione sua cidade</option> <?php
while ($row2 = mysql_fetch_row($result2)){
$city2 = $row2[2];
$id2 = $row2[0];
echo "<option value=$id2> $city2 </option>";
}
?>
</select>
<?php }
?>


