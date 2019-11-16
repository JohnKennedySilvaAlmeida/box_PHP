<?
 session_start();
 if($_SESSION['qwert'] == false) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"login.php\">login</a>";
      }
      else {
echo "Olá&nbsp;". $_SESSION['qwert']."&nbsp&nbsp";
echo "<font face='Arial' size='2'>Confira abaixo,os produtos do seu carrinho: <a href=\"logout.php\">sair</a></font>" ?>
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
.style2 {
	color: #000000;
	font-weight: bold;
}
.style5 {
    color: #FFFFFF; 
	font-weight: bold; 
}
-->
</style>

<script language="JavaScript">
<!--
   function finaliza() {
      if(confirm('Deseja mesmo efetivar esse pedido ?'))
	     return true;
	  else return false;
   }//FECHA FUNCTION
//-->
</script>

</head>

<body>
   <?
/************************************************************************
ARQUIVO .........: Carrinho de compras simples: usando arrays e session
BY ..............: Júlio César Martini - baphp@imasters.com.br
SITE ............: iMasters - http://www.imasters.com.br
DATA ............: 23/05/2004
************************************************************************/

//INICIALIZA A SESSÃO
session_start();

//VERIFICA SE FOI ESCOLHIDA A OPÇÃO PARA FECHA O PEDIDO
if($_POST[opc_enviar]) {
    
	//RECEBE OS DADOS DO FORMULÁRIO
	$v_nome      =   $_POST[txtNome];
	$v_end       =   $_POST[txtEndereco];
	$v_email     =   $_POST[txtEmail];
	$v_produtos  =   $_POST[v_produtos];
	$v_total     =   number_format($_POST[v_total],2,',','.');
	
	//EMAIL DO ADMINISTRADOR QUE VAI RECEBER O PEDIDO
	$email_dest   =   "ivan.geraldo@gmail.com";
	
	//PREPARA O PEDIDO
	$mens   =  "---------------------------------------------------------------------\n";
	$mens  .=  "             MEU SITE.COM                                       \n";
	$mens  .=  "              Pedido de Compras                                      \n";
	$mens  .=  "---------------------------------------------------------------------\n\n";
	$mens  .=  "Qtde         Descrição                                   Valor Unit. \n";
	$mens  .=  "---------------------------------------------------------------------";
	$mens  .=  "\n".$v_produtos."                                                    \n";
	$mens  .=  "Total a pagar: R$".$v_total."                                        \n\n";
	$mens  .=  "DADOS PARA ENTREGA:                                                  \n";
	$mens  .=  "Nome: ".$v_nome."                                                    \n";
	$mens  .=  "Endereço: ".$v_end."                                                 \n";
	$mens  .=  "Email: ".$v_email."                                                  \n\n";
	$mens  .=  "Obrigado!!                                                           \n";
	$mens  .=  "iMasters - B2C                                                       ";
	
	
	//DISPARA O EMAIL
	$envia  =  mail($email_dest, "Pedido pelo site NOVOSABER.COM", $mens,"From:".$v_email."\r\nBcc:".$v_email);
	
	//VERIFICA SE O EMAIL FOI ENVIADO COM SUCESSO
	if($envia) { 
	   //ELIMINA TODAS AS VARIÁVEIS DA SESSÃO
       $_SESSION = array();
       
	   //DESTRÓI A SESSÃO PARA GARANTIR
       @session_destroy(); ?>
	   
       <script language="JavaScript">
	   <!--
	      alert("PARABÉNS!!\n\nO seu pedido foi enviado com sucesso.");
		  window.location.href = "index.php";
	   //-->
	   </script>
    <?
	}//FECHA IF(envia)
	else {?>
       <script language="JavaScript">
	   <!--
	      alert("ERRO!!\n\nAconteceu algum problema.\n\nPor favor, tente novamente...");
		  window.location.href = "index.php";
	   //-->
	   </script>
<?
   }//FECHA ELSE (envia)
}//FECHA IF
?>
   <table width="773"  border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td><img src="images/topo.gif" width="773" height="100"></td>
   </tr>
   
   <tr>
      <td><br><br>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td align='center'><font face="Arial" size="4"><b>MODELO DE CARRINHO DE
          COMPRAS</b></font></td>
      </tr>
      </table>
      
	  <br><br>
      
	  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td><font size="2" face="Arial">Fechamento do pedido de compras: </font></td>
      </tr>
      </table>

      <br>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#0099CC">
         <td width="10%"><span class="style2">Qtde</span></td>
         <td width="53%"><span class="style2">Produto</span></td>
         <td width="19%"><span class="style2">Valor</span></td>
         <td width="18%"><span class="style2">Subtotal</span></td>
      </tr>
      
	  <?
	  //PEGA A CHAVE
      $chave_cesta  =  array_keys($_SESSION[cesta]);

	  //EXIBE OS PRODUTOS DA CESTA
	  for($i=0; $i<sizeof($chave_cesta); $i++) { 
	     $indice   =   $chave_cesta[$i]; 
		 
		 //ATRIBUI CONTEUDO A VAR QUE VAI SER USADO NO EMAIL
		 $v_produtos .= $_SESSION[cesta][$indice][QTDE]."&nbsp;-&nbsp;".$_SESSION[cesta][$indice][ARTISTA]."&nbsp;&nbsp;&nbsp;".$_SESSION[cesta][$indice][ALBUM]."&nbsp;-&nbsp;".$_SESSION[cesta][$indice][PRECO]."\n";
		 
		 //SUBTOTAIS DE CADA PRODUTO
//SUBTOTAIS DE CADA PRODUTO
		 $subtotal =   $_SESSION[cesta][$indice][QTDE] * ereg_replace(",",".",$_SESSION[cesta][$indice][PRECO]);

		 //TOTAL GERAL
		 $total   +=   $subtotal;
	     ?>
         <tr>
            <td height="25"><font face='Arial' size='2'><? echo $_SESSION[cesta][$indice][QTDE]; ?></font></td>
		    <td height="25"><font face='Arial' size='2'><? echo $_SESSION[cesta][$indice][ARTISTA]; ?> - <? echo $_SESSION[cesta][$indice][ALBUM]; ?></font></td>
            <td height="25"><font face='Arial' size='2'>R$ <? echo $_SESSION[cesta][$indice][PRECO]; ?></font></td>
            <td width="18%" height="25"><font face='Arial' size='2'> R$ <? echo number_format($subtotal,2,',','.'); ?></font></td>
         </tr>
         <?
	     }//FECHA FOR ?>
         <tr>
            <td height="25" colspan="2">&nbsp;&nbsp;</td>
            <td height="25" bgcolor="#FF0000"><span class="style5">&nbsp;&nbsp;Total &agrave; pagar: </span></td>
            <td height="25" bgcolor="#FFF0F0" class="style2"> &nbsp;&nbsp;R$&nbsp;<b><? echo number_format($total,2,',','.'); ?></b></td>
         </tr>
         </table>
            <form id="form-pesquisa-repasse" action="calcula_frete.php" method="post" class="formMain formSearch wsizep100" onsubmit="submitForm(this); return false;">

<fieldset>

<legend>Filtrar Referência</legend>

<label for="servico" class="wsize015">

<span class="nameField">Envio</span>

<select id="servico" name="servico" title="Serviços dos Correios" class="select" tabindex="1">

<option value="41106">PAC</option>

<option value="40010">SEDEX</option>

</select>

</label>

<label class="wsize010" for="cep-destino">

<span class="nameField">CEP Destino</span>

<input id="cep-destino" class="text" type="text" value="" maxlength="9" title="CEP destino" name="cep-destino" tabindex="2"/>

</label>

<label for="pesquisar" class="wsize010">

<input type="submit" id="pesquisar" name="pesquisar" tabindex="3" class="button inline"  value="Pesquisar" />

</label>

</fieldset>

</form>

<span>* Digitar somente número no CEP</span>

<br />

<span id="value"></span>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js" type="text/javascript"></script>

<script type="text/javascript">

function submitForm(form) {

form.request({

onComplete: function(transport){



if(transport.responseText !=-1)  {

$('value').innerHTML = transport.responseText;

} else {

form.reset();

$('value').innerHTML = 'Erro ao consultar';

}

}

});

return false;

}



</script>

		 <form name="frmFinalizar" method="post" onSubmit="return finaliza();">
		    <input type="hidden" name="opc_enviar" value="1">
			<input type="hidden" name="v_produtos" value="<? echo $v_produtos; ?>">
			<input type="hidden" name="v_total" value="<? echo $total; ?>">
            <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
               <td bgcolor="#FFCC99" class="style2"><div align="center">Dados Pessoais</div></td>
            </tr>
            </table>
             <?
include ('admin/conecta.php');
             $nome1 =$_SESSION['qwert'] ;
             $query = "SELECT * FROM usuarios WHERE login='user'";
$query = mysql_query($query,$conexao);
while ($linha=mysql_fetch_array($query)) {
$nome = $linha["nome"];
$email= $linha["email"];
$endereco= $linha["endereco"];
  ?>
			<br>
            <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
               <td width="11%" height="25"><font face="Arial" size="2">Nome:</font></td>
               <td height="25" colspan="3"><font face="Arial" size="2">
               <input name="txtNome" type="text" size="50" maxlength="50" value=<?echo $nome;?>></font></td>
            </tr>
            
			<tr>
               <td height="25"><font face="Arial" size="2">Endere&ccedil;o:</font></td>
               <td width="45%" height="25"><font face="Arial" size="2">
               <input name="txtEndereco" type="text" size="40" maxlength="80" value=<? echo $endereco;  ?>></font></td>
               <td width="8%" height="25"><font face="Arial" size="2">Email:</font></td>
               <td width="36%" height="25"><input name="txtEmail" type="text" size="40" maxlength="45" value=<? echo $email;?>></td>
            </tr>
            
			<tr valign="bottom">
               <td height="50" colspan="4"><div align="center">
               <input name="btnEnviar" type="submit" value="Confirmar o pedido de compras &gt;&gt;"></div></td>
            </tr>
            </table>
            <? }  ?>
         </form>
         
		 <table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td width="47%" align='center'><font face='Arial' size='2'><a href="index.php">&lt;&lt; P&aacute;gina inicial </a></font></td>
            <td width="53%" align='center'><font face='Arial' size='2'><a href="carrinho.php">&lt;&lt; Carrinho de compras</a></font> </td>
         </tr>
         </table><br></td>
      </tr>
      
	  <tr>
         <td><img src="rodape.gif" width="773" height="20"></td>
      </tr>
      </table>
</body>
</html>  <? }  ?>
