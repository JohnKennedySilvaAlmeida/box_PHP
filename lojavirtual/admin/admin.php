
 <?
 session_start() ;
if($_SESSION['qwert'] == false) {

      echo "Você precisa ser administrador para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      if ($_SESSION['qwert'] == 'admin') {
echo "Olá&nbsp;". $_SESSION["qwert"]."&nbsp&nbsp";
echo "<font face='Arial' size='2'>Confira abaixo, as areas configuraveis: <a href=\"logoutadmin.php\">sair</a></font>" ?>
<html>
<head>
<title>MODELO DE CARRINHO DE COMPRAS</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
<table width="773"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/topo.gif" width="773" height="100"></td>
  </tr>
  <tr>
    <td> <br>
      <tr>
        <td align='center'><font face="Arial" size="4"><b>Administração do
          carrinho</b></font></td>
          </tr>
<tr>
  <td><a href="controle_meus_produtos.php">admin produtos</a></td>
</tr>
<tr>
  <td><a href="controle_usuario.php">admin usuario</a></td>
</tr>
<tr>
  <td>admin categorias</td>
</tr>
<tr>
  <td>admin sub-categorias</td>
</tr>
  <tr>
    <td><img src="../../rodape.gif" width="773" height="20"></td>
  </tr>
</table>
</body>
</html>
<? }
else {
     echo "Você precisa ser administrador para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
 }  ?>
