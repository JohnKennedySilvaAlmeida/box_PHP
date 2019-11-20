
  <table border="0">
 <tr><td>
</td>
<td valign="top">
  <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"loginadm.php\">login</a>";
      }
else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>"; ?>
<form action="upload2adminteste.php" method="post" enctype="multipart/form-data">
Envie sua foto para o site! <input type="file" name="foto"><BR>
<input type="submit" value="Enviar Foto!">
</form>

<? }  ?>
</td></tr></table>
