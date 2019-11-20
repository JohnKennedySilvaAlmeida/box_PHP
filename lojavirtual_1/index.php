

<html>
<head>
<title>Carrinho PHP</title>
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
<?
/************************************************************************
ARQUIVO .........: Carrinho de compras simples: usando arrays e session
BY ..............: Júlio César Martini - baphp@imasters.com.br
SITE ............: iMasters - http://www.imasters.com.br
DATA ............: 23/05/2004
ADAPTADO GENERICAMENTE PARA AREA ADMINISTRACAO COM ACESSO BD MYSQL POR JOSE IVAN GERALDO DA SILVA
 DUVIDAS :ivan.geraldo@gmail.com
************************************************************************/

//INICIALIZA A SESSÃO
session_start();

include ('conecta.php');

// Conexão ao banco


// Nome da tabela a ter os registros paginados
$tabela="produtos";

// seleção de registro com limitação da variáveis de contagem
$sql=mysql_query("SELECT * FROM $tabela ORDER BY codigo");

// Mostragem dos dados
while($dados=mysql_fetch_array ($sql, MYSQL_NUM)) {
$codigo = $dados[0];
$artista = $dados[3];
$album = $dados[4];
$preco = $dados[5];
$imagem = $dados[6];

          //MONTA O ARRAY DE PRODUTOS
$produto[$codigo][CODIGO]     =   $codigo;
$produto[$codigo][ARTISTA]     =   $artista;
$produto[$codigo][ALBUM]       =  $album;
$produto[$codigo][PRECO]       =   $preco;
$produto[$codigo][IMAGEM]      =   $imagem;

   }
 mysql_free_result($sql);



//TOTAL DE PRODUTOS POR LINHA
$total = 2;
?>
<table width="773"  border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/topo.gif" width="773" height="100"></td>
  </tr>
  <tr>
    <td><table border="1" width="100%"> <form name="form1" method="post" action="loga.php?acao=logar">
<tr>
  <td>Login</td>
  <td><input type="text" name="nome"></td>
  <td> <?
  if($_SESSION['qwert'] == false) {

      echo "Ola convidado";
      }
      else {
echo "Olá&nbsp;<b>". $_SESSION['qwert']."</b>&nbsp&nbsp";
echo "<font face='Arial' size='2'><a href=\"logout.php\">sair</a></font>";
} ?>
</td>
  <td><a href="cadastro.php">Cadastro</a></td>
  <td><a href="carrinho.php">Carrinho</a></td>
</tr>
<tr>
  <td>Senha</td>
  <td> <input type="password" name="pwd"></td>
  <td> &nbsp;</td>
  <td> &nbsp;</td>
  <td> &nbsp;</td>
</tr>
<tr>
  <td COLSPAN=5 align=center><input type="submit"></td>
</tr>
</table>
</form>
  </td>
  </tr>
  <tr>

    <td>
    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align='center'><font face="Arial" size="4"><b>MODELO DE CARRINHO DE
          COMPRAS</b></font></td>
      </tr>
    </table>
    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><font face='Arial' size='2'>Confira abaixo, os produtos dispon&iacute;veis no site:</font> </td>
      </tr>
       <?
      $sqlC = "SELECT * FROM categorias ";
	    $queryC = mysql_query($sqlC);
	   WHILE ($sqlC = mysql_fetch_assoc($queryC));{
      echo $categoria['nome'];
      }?>
    </table>
    <br>  
    
	<form action="carrinho.php" method="post" name="frmcarrinho">
       <input type="hidden" name="opc_efetivar" value="1">

	   <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
       <tr>
      <?
	   //PEGA A CHAVE DO ARRAY
	            if ($chave==''){
           echo "voce nao tem nenhum produto cadastrado.entre na area de administracao,com o login :admin/senha:1234<br>
           cadastre alguns produtos e veja.<BR>
           O usuario que ja esta configurado no bd è login:user/senha:1234";}
           else{
	   $chave = array_keys($produto);

	   //EXIBE OS PRODUTOS
		for($i=0; $i<sizeof($chave); $i++) {
		   $indice    =   $chave[$i];
		   $codigo    =   $produto[$indice][CODIGO];
		   $artista   =   $produto[$indice][ARTISTA];
		   $album     =   $produto[$indice][ALBUM];
		   $preco     =   $produto[$indice][PRECO];
		   $preco =      number_format($preco, 2, ',', '.') ;//preco formatado para padrao brasileiro
		   $imagem    =   $produto[$indice][IMAGEM];

           //VERIFICA
	       if($total == $atual) {
		      echo "</tr><tr>";
			  $atual = 0;
		   }?>

          <td width="14%" height="100"><a href="verproduto.php?codigo=<? echo $codigo; ?>"<img src="mini.php?imagem=<? echo $imagem; ?>"  border="0"></td>
          <td width="36%">
		  
		  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
             <td><font face='Arial' size='2'><? echo $artista; ?></font></td>
          </tr>
          
		  <tr>
             <td><font face='Arial' size='2'><? echo $album; ?></font></td>
          </tr>
          
		  <tr>
             <td><font face='Arial' size='2'>R$ <? echo $preco; ?></font></td>
          </tr>
          
		  <tr>
             <td>
			 <input type="hidden" name="txtprod[<? echo $indice;?>][CODIGO]"  value="<? echo $codigo; ?>">
			 <input type="hidden" name="txtprod[<? echo $indice;?>][ARTISTA]"  value="<? echo $artista; ?>">
			 <input type="hidden" name="txtprod[<? echo $indice;?>][ALBUM]"  value="<? echo $album; ?>">
			 <input type="hidden" name="txtprod[<? echo $indice;?>][PRECO]"  value="<? echo $preco; ?>">
              <input type="text" name="txtprod[<? echo $indice;?>][QTDE]"  size="3" maxlength="3">
             <input type="image" src="carrinho.gif" onClick="javascript: document.forms[0].submit();"></td>
          </tr>
          </table></td>
   	   <?
	      //SOMA 1 A VARIÁVEL CONTROLADORA
	      $atual++;
	   }
	   }
       mysql_close($conexao);//FEHA FOR ?>
       </tr>
       </table>   
    </form></td>
  </tr>
  <tr>
    <td><img src="rodape.gif" width="773" height="20"></td>
  </tr>
   <tr>
    <td align= center><a href="admin/admin.php">ADMINISTRAR</a></td>
  </tr>

</table>
</body>
</html>
