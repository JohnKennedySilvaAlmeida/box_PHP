
  <table border="0">
 <tr><td>
</td>
<td valign="top">
  <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"login.php\">login</a>";
      }
else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>"; ?>
<?
$erro = $config = array();

// Prepara a variável do arquivo
$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

// Tamanho máximo do arquivo (em bytes)
$config["tamanho"] = 106883;
// Largura máxima (pixels)
$config["largura"] = 350;
// Altura máxima (pixels)
$config["altura"] = 480;

// Formulário postado... executa as ações
if($arquivo)
{
// Verifica se o mime-type do arquivo é de imagem
if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
{
$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg,
      bmp, gif ou png. Envie outro arquivo";
}
else
{
// Verifica tamanho do arquivo
if($arquivo["size"] > $config["tamanho"])
{
$erro[] = "Arquivo em tamanho muito grande!
    A imagem deve ser de no máximo " . $config["tamanho"] . " bytes.
    Envie outro arquivo";
}

// Para verificar as dimensões da imagem
$tamanhos = getimagesize($arquivo["tmp_name"]);

// Verifica largura
if($tamanhos[0] > $config["largura"])
{
$erro[] = "Largura da imagem não deve
        ultrapassar " . $config["largura"] . " pixels";
}

// Verifica altura
if($tamanhos[1] > $config["altura"])
{
$erro[] = "Altura da imagem não deve
        ultrapassar " . $config["altura"] . " pixels";
}
}

// Imprime as mensagens de erro
if(sizeof($erro))
{
foreach($erro as $err)
{
echo " - " . $err . "<BR>";
}

echo "<a href=\"foto2admin.php\">Fazer Upload de Outra Imagem</a>";
}

// Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
else
{
// Pega extensão do arquivo
preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

// Gera um nome único para a imagem
$imagem_nome = md5(uniqid(time())) . "." . $ext[1];

// Caminho de onde a imagem ficará
$imagem_dir = "images/" . $imagem_nome;

// Faz o upload da imagem
move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

$sql = "INSERT INTO imagens(codigo,endereco,autorizado) VALUES ('','$imagem_nome','nao')";

//Agora é hora de contatar o mysql

 include ("conecta.php");

//Inserindo os dados

$sql = mysql_query($sql)
or die ("Houve erro na gravação dos dados, por favor, clique em voltar e verifique os campos obrigatórios!");

 $arquivo["size"];
 $imagem_nome;
 $arquivo["name"];
  
  
echo "<h1>Cadastro efetuado com sucesso!</h1><br>";




echo "Sua foto foi enviada com sucesso!<br>
endereço da foto :$imagem_nome<br>
Aguarde a liberação do administrador<br>
Enviar <a href=\"foto2admin.php\">OUTRA FOTO</a> ou <a href=\"controle_minhas_imagens.php\">
voltar a administração</a>";
}
}
?>


<? }  ?>
</td></tr></table>
