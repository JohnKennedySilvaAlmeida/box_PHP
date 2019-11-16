
  <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"login.php\">login</a>";
      }
else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>"; ?>
<h1>Controle de formularios</h1>
 <?
// Verifica se existe a variável $comeco, que vai indicar a número
// da mensagem que vai aparecer no começo. Se não existir, assume-se
// que vai ser o começo, ou seja, o valor 0.

  // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)

global $begin;
if (!$begin) { $begin = 0; }
else {$begin = $_GET['begin'];}



// Conecta ao servidor e seleciona o banco de dados
 include ("../conecta.php");

// Coloca na variável $total o número total de mensagens no Guestbook
$query = "SELECT count(*) FROM faleconosco";
$query = mysql_query($query,$conexao);
$query = mysql_fetch_array($query);
$total = $query[0];

?>
<p>
Total de registros: <b><? echo $total; ?></b>
<br>
Exibindo <b>15</b> registros por pagina, mostrando registros de
<b><? echo $begin+1; ?></b> a <b><? echo $begin+15; ?></b>.
<?
// Calcula os links para as próximas mensagens e as anteriores, de
// acordo com o número total de mensagens
if (($begin > 0) and ($begin <= 15)) {
   $anteriores = '<a href="controle_faleconosco.php?begin=0"><<<</a>';
} elseif (($begin > 0) and ($begin > 15)) {
   $anteriores = '<a href="controle_faleconosco.php?begin=' . ($begin-15) . '"><<<</a>';
} else {
   $anteriores = '<<<';
}

if (($begin < $total) and (($begin+15) >= $total)) {
   $proximas = '>>>';
} else {
   $proximas = '<a href="controle_faleconosco.php?begin=' . ($begin+15) . '">>>></a>';
}

echo $anteriores . " | " . $proximas."  |<A HREF=\"admin.php\">Pagina principal</a>";
echo "| <a href=\"logoutadmin.php\">Sair</a>";

// Faz uma consulta SQL trazendo as linhas das 10 ultimas mensagens
// que foram colocadas no livro de visitas.
$query = "SELECT * FROM faleconosco ORDER BY id DESC LIMIT $begin,15";
$query = mysql_query($query,$conexao);
// Gera uma tabela para cada assinatura no livro de visitas (loop)
echo "<table border=1 cellpadding=1 cellspacing=1>";
echo "<tr>";
echo "<td>ID:</td>";
echo "<td>Nome:</td>";
echo "<td>data</td>";
echo "<td>Email</td>";
echo "<td>DDD</td>";
echo "<td>Fone</td>";
echo "<td>IP</td>";
echo "<td>HOSTNAME</td>";
echo "<td>Ver texto</td>";
echo "<td>Excluir</td>";
echo "</tr>";

while ($linha=mysql_fetch_array($query)) {
$id = $linha["id"];
$nome = $linha["nome"];
$data = $linha["data"];
$email = $linha["email"];
$ddd = $linha["ddd"];
$fone = $linha["fone"];
$texto = $linha["texto"];
$ip = $linha["ip"];
$hostname = $linha["hostname"];

echo "<tr>";
echo "<td>$id</td>";
echo "<td>$nome</td>";
echo "<td>$data</td>";
echo "<td>$email</td>";
echo "<td>$ddd</td>";
echo "<td>$fone</td>";
echo "<td>$ip</td>";
echo "<td>$hostname</td>";
echo "<td><a href=\"ver_faleconosco.php?id=$id\">Ver texto</a></td>";
echo "<td><a href=\"excluir_faleconosco.php?id=$id\">Excluir</a></td>";
echo "</tr>";
}
echo "</TABLE>";
   mysql_close($conexao);
?>


<? }  ?>

