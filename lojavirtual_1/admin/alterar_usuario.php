<?
 session_start() ;
if($_SESSION['qwert'] == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;".  $_SESSION["qwert"]."&nbsp&nbsp";
echo "<font face='Arial' size='2'>Confira abaixo, as areas configuraveis: <a href=\"logoutadmin.php\">sair</a></font>" ?>

<?php
    include ("../conecta.php");
if (getenv("REQUEST_METHOD") == "GET") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $codigo= $_GET['codigo'];

//tirar espaço em branco das variaveis recebidass através de formulario
$codigo = trim($codigo);


$sql = "SELECT * FROM usuarios WHERE codigo='$codigo'";
$resultado = mysql_query($sql)
or die ("Não foi possível realizar a consulta ao banco de dados");
}
while ($linha=mysql_fetch_array($resultado)) {
   $nome = $linha['nome'];
   $cpf = $linha['cpf'];
   $email = $linha['email'];
   $sexo = $linha['sexo'];
   $telefone = $linha['telefone'];
   $endereco = $linha['endereco'];
   $cidade = $linha['cidade'];
   $estado = $linha['estado'];
   $bairro = $linha['bairro'];
   $cep = $linha['cep'];
   $pais = $linha['pais'];
   $login = $linha['login'];
   $senha = $linha['senha'];
   $hostname = $linha['hostname'];
   $ip = $linha['ip'];
   $data = $linha['data'];
   $autorizado = $linha['autorizado'];
   $receber = $linha['receber'];
   
 echo "<table border='1' width='50%'>
<tr>
  <td colspan='2'>alterar usuarios<form method='POST' action='alterar_usuario_db.php' >
</td>
</tr>
<tr>
  <td>nome</td>
  <td><input type='text' name=campo1 size='20' value='$nome'></td>
</tr>
<tr>
  <td>CPF</td>
  <td><input name =campo2 type='text' size='20' value='$cpf'></td>
</tr>
<tr>
  <td>Email</td>
  <td><input name =campo3 type='text' size='20' value='$email'></td>
</tr>
<tr>
  <td>sexo</td>
  <td><input name =campo4 type='text' size='20' value='$sexo'></td>
</tr>
<tr>
  <td>Telefone</td>
  <td><input name =campo5 type='text' size='20' value='$telefone'></td>
</tr>
<tr>
  <td>Endere&ccedil;o</td>
  <td><input name =campo6 type='text' size='20' value='$endereco'></td>
</tr>
<tr>
  <td>cidade</td>
  <td><input name =campo7 type='text' size='20' value='$cidade'></td>
</tr>
<tr>
  <td>estado</td>
  <td><input name =campo8 type='text' size='20' value='$estado'></td>
</tr>
<tr>
  <td>Bairro</td>
  <td><input name =campo9 type='text' size='20' value='$bairro'></td>
</tr>
<tr>
  <td>CEP</td>
  <td><input name =campo10 type='text' size='20' value='$cep'></td>
</tr>
<tr>
  <td>Pais</td>
  <td>$pais<INPUT TYPE='hidden' NAME='campo11' VALUE='$pais'>
</td>
</tr>
<tr>
  <td>Login</td>
  <td>$login<INPUT TYPE='hidden' NAME='campo12' VALUE='$login'></td>
</tr>
<tr>
  <td>Senha</td>
  <td>$senha<INPUT TYPE='hidden' NAME='campo13' VALUE='$senha'></td>
</tr>
<tr>
  <td>IP</td>
  <td>$ip<INPUT TYPE='hidden' NAME='campo14' VALUE='$ip'></td>
</tr>
<tr>
  <td>Data</td>
  <td>$data<INPUT TYPE='hidden' NAME='campo15' VALUE='$data'>
  <INPUT TYPE='hidden' NAME='campo16' VALUE='$autorizado'>
  <INPUT TYPE='hidden' NAME='campo17' VALUE='$receber'>
  <INPUT TYPE='hidden' NAME='campo18' VALUE='$codigo'></td>
</tr><tr>
<td colspan='2' align='center'><input type='submit' value='Alterar Dados'></form></td>
</tr>
</table>";

}
 mysql_close($conexao);
?>


<? }  ?>

