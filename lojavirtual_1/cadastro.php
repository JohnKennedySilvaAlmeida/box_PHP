<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CADASTRO DE CLIENTES DO SITE</title>
<style type="text/css">

<!--
.style1 {
color: #FF0000;
font-size: x-small;
}
.style3 {color: #0000FF; font-size: x-small; }
</style>
<script type="text/javascript">
function validaCampo()
{
if(document.cadastro.nome.value=="")
{
alert("O Campo nome é obrigatório!");
return false;
}
else
if(document.cadastro.icpf.value=="")
{
alert("O Campo CPF é obrigatório!");
return false;
}
else
if(document.cadastro.email.value=="")
{
alert("O Campo email é obrigatório!");
return false;
}
else
if(document.cadastro.endereco.value=="")
{
alert("O Campo endereço é obrigatório!");
return false;
}
else
if(document.cadastro.cidade.value=="")
{
alert("O Campo Cidade é obrigatório!");
return false;
}
else
if(document.cadastro.estado.value=="")
{
alert("O Campo Estado é obrigatório!");
return false;
}
else
if(document.cadastro.bairro.value=="")
{
alert("O Campo Bairro é obrigatório!");
return false;
}

else
if(document.cadastro.pais.value=="")
{
alert("O Campo país é obrigatório!");
return false;
}
else
if(document.cadastro.login.value=="")
{
alert("O Campo Login é obrigatório!");
return false;
}
else
if(document.cadastro.senha.value=="")
{
alert("Digite uma senha!");
return false;
}
else
return true;
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

<!-- Fim do JavaScript que validará os campos obrigatórios! -->

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function soNumeros(v){
    return v.replace(/\D/g,"")
}

function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}

function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function cep(v){
     v=v.replace(/\D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
    return v
}

function cnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
    return v
}

function romanos(v){
    v=v.toUpperCase()             //Maiúsculas
    v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que não for I, V, X, L, C, D ou M
    //Essa é complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

function site(v){
    //Esse sem comentarios para que você entenda sozinho ;-)
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
        caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}

</script>


</head>

<body>
<form id="cadastro" name="cadastro" method="post" action="cadastro_user.php" onsubmit="return validaCampo(); return false;">
  <table width="625" border="0">
    <tr>
      <td width="69">Nome:</td>
      <td width="546"><input name="nome" type="text" id="nome" size="70" maxlength="60">
        <span class="style1">*</span></td>
    </tr>
     <tr>
      <td width="69">CPF:</td>
      <td width="546"> <input name="icpf" id="icpf" onkeypress="mascara(this,cpf)" maxlength="14">
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input name="email" type="text" id="email" size="70" maxlength="60">
      <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Sexo:</td>
      <td><input name="sexo" type="radio" value="M" checked="checked">
        Masculino
        <input name="sexo" type="radio" value="F">
        Feminino <span class="style1">*</span> </td>
    </tr>
    <tr>
      <td>TELEFONE:</td>
      <td>
         <input name="itelefone" id="itelefone" onkeypress="mascara(this,telefone)"  maxlength="16">
        <span class="style3">(ddd)numero</span> </td>
    </tr>
    <tr>
      <td>Endereço:</td>
      <td><input name="endereco" type="text" id="endereco" size="70" maxlength="70">
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td>
      <Script Language="JavaScript">
function getStates(what) {
   if (what.selectedIndex != '') {
      var estado = what.value;
      document.location=('cadastro.php?estado=' + estado);
   }
}
</Script>
<?php
$estado=$_GET['estado'];
 include ("conecta.php");
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

        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td><?php
$query2 = "select * from opt_cidades where uf='$estado'";
$result2= mysql_query($query2) or die(mysql_error());
$query2 = stripslashes($query2);
if ($estado){ ?>
<select name="cidade">
<option value="">selecione sua cidade</option> <?php
while ($row2 = mysql_fetch_row($result2)){
$city2 = $row2[2];
echo "<option value=$city2> $city2 </option>";
}
?>
</select>
<?php }
?>
</td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><input name="bairro" type="text" id="bairro" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
     <tr>
      <td>CEP:</td>
      <td><input name="icep" id="icep" onkeypress="mascara(this,cep)" maxlength="9" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>País:</td>
      <td><input name="pais" type="text" id="pais" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Login:</td>
      <td><input name="login" type="text" id="login" maxlength="15" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Senha:</td>
      <td><input name="senha1" type="password" id="senha1" maxlength="10">
          <span class="style1">*</span></td>
    </tr>
        <tr>
      <td>Confirmar Senha:</td>
      <td><input name="senha2" type="password" id="senha2" maxlength="10">
          <span class="style1">*</span></td>
    </tr>
    <tr>
      <td colspan="2"><input name="receber" type="checkbox" id="news" value="S" checked="checked">
          <?
$ip = $_SERVER['REMOTE_ADDR'];
mysql_close($conexao);
?>
      <input type="hidden" name="ip" value="<?echo "$ip";?>">
Desejo receber novidades e informações sobre o conteúdo deste site. </td>
    </tr>
    <tr>
      <td colspan="2"><p>
        <input name="cadastrar" type="submit" id="cadastrar" value="Concluir meu Cadastro!" />

          <input name="limpar" type="reset" id="limpar" value="Limpar Campos preenchidos!" />
           <span class="style1">* Campos com * são obrigatórios! </span></p>
      <p>
      <?
echo "Por motivo de seguran&ccedil;a estamos gravando seu IP :$ip";
?>  </p></td>
    </tr>
  </table>
</form>

</body>
</html>



