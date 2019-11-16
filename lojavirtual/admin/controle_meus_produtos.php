 <?session_start() ;
if(session_is_registered("qwert") == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"../login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;". $_SESSION["qwert"];
 echo "&nbsp;<a href=logoutadmin.php>sair</a>"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>PAGINA ADMINISTRAÇÃO DE PRODUTOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="text.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

 <?
$campo1='CODIGO';
$campo2='Categoria';
$campo3='Sub-Categoria';
$campo4='Artista';
$campo5='Album';
$campo6='Preco';
$campo7='Imagem';
$campo8='Detalhes';
$campo9='Disponivel';
$campo10='Alterar';
$campo11='Excluir';
 ?>

<table border=1 cellpadding=1 cellspacing=5>
  <tr>
    <td >
      <div align="center"><?echo $campo1 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo2 ?></div>
    </th>
    <td >
      <div align="center"><?echo $campo3 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo4 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo5 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo6 ?></div>
    </td>
      <td >
      <div align="center"><?echo $campo7 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo8 ?></div>
    </td>

        <td >
      <div align="center"><?echo $campo9 ?></div>
    </td>
    <td >
      <div align="center"><?echo $campo10 ?></div>
    </td>
      <td >
      <div align="center"><?echo $campo11 ?></div>
    </td>

  </tr>
  
<?php
// Página que faz conexão ao banco
include ('conecta.php');

// Conexão ao banco


// Nome da tabela a ter os registros paginados
$tabela="produtos";

// Verifica se a variável de complementação de link esta vazia
if($_REQUEST["pagina"]=="") {
  $pagina="1";
}else{
     $pagina=$_REQUEST["pagina"];
}

// quantidade de registro por paginação
$maximo="10";

// Variáveis de contagem de registro
$inicio=$pagina-1;
$inicio=$maximo*$inicio;

// seleção de registro com limitação da variáveis de contagem
$sql=mysql_query("SELECT * FROM $tabela ORDER BY codigo LIMIT $inicio,$maximo");

// Mostragem dos dados
while($dados=mysql_fetch_array ($sql, MYSQL_NUM)) {
$nome1 = $dados[0];
$nome2 = $dados[1];
$nome3 = $dados[2];
$nome4 = $dados[3];
$nome5 = $dados[4];
$nome6 = $dados[5];//PRECO
$nome6=number_format($nome6, 2, ',', '.'); //preco formatado para padrao brasileiro
$nome7 = $dados[6];
$nome8= $dados[7];
$nome9= $dados[8];
echo "<tr>";
echo "<td>$nome1</td>";
echo "<td>$nome2</td>";
echo "<td>$nome3</td>";
echo "<td>$nome4</td>";
echo "<td >$nome5 </td>";
echo "<td >$nome6</td>";
echo "<td ><img src=../mini.php?imagem=$nome7></td>";
echo "<td >$nome9</td>";
if ($nome8 == 'sim'){
echo "<td ><font color=\"#3da35b\">$nome8</font><br></td>";
}
else {
  echo "<td ><font color=\"#cb0a0f\">$nome8</font><br></td>";
}
echo "<td ><a href=\"alterar_produtos.php?codigo=$nome1\">Alterar</a><br></td>";
echo "<td ><a href=\"excluir_produtos.php?codigo=$nome1&endereco=$nome7\">Excluir</a><br></td>";
echo "</tr>";
echo "<br>";
}

 mysql_free_result($sql);
?>
 </tr>
</table>

   <br>



<?php
// Calculando pagina anterior
$menos=$pagina-1;

// Calculando pagina posterior
$mais=$pagina+1;

// Calculos para a mostragem de paginas
$p_ini=$mais-1;
$p_ini=$maximo*$p_ini;

// Querys para a mostragem de paginas
$p_query=mysql_query("SELECT * FROM $tabela LIMIT $p_ini,$maximo");
$p_total=mysql_num_rows($p_query);
mysql_close($conexao);
// Mostragem de pagina
if($menos>0) {
   echo "<a href=\"?pagina=$menos\">:: anterior</a> ";
} if($p_total>0) {
   echo  "<a href=\"?pagina=$mais\">proxima ::</a>";
}
echo  "<a href=\"foto.php\">ACRESCENTAR ::</a>";
}

?>
