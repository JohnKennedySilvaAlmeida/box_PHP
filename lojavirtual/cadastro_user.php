<html>
<body>

<?php
 include ("conecta.php");
//Vamos definir as variáveis de data e hora
//para inserção no banco de dados

//Agora com as variáveis de data e hora criadas
//vamos criar uma variável especial para a querie sql
if (getenv("REQUEST_METHOD") == "POST") {
   // Configura as variáveis do método POST para virarem variáveis
   // "normais" do PHP (Requer apenas nas versões do PHP acima da 4.1)
   $nome = $_POST['nome'];
   $cpf = $_POST['icpf'];
   $email = $_POST['email'];
   $sexo = $_POST['sexo'];
   $telefone = $_POST['itelefone'];
   $endereco = $_POST['endereco'];
   $cidade = $_POST['cidade'];
   $estado = $_POST['estado'];
   $bairro = $_POST['bairro'];
   $cep = $_POST['icep'];
   $pais = $_POST['pais'];
   $login = $_POST['login'];
   $senha1 = $_POST['senha1'];
   $senha2 = $_POST['senha2'];
   $hostname = $_POST['hostname'];
   $ip = $_POST['ip'];
   $data = $_POST['data'];
//tirar espaço em branco das variaveis recebidass através de formulario
$nome = trim($nome);
$cpf = trim($cpf);
$email= trim($email);
$sexo = trim($sexo);
$telefone = trim($telefone);
$endereco = trim($endereco);
$cidade = trim($cidade);
$estado = trim($estado);
$bairro = trim($bairro);
$cep = trim($cep);
$pais = trim($pais);
$login = trim($login);
$senha1 = trim($senha1);
$senha2 = trim($senha2);
$ip = trim($ip);
$data=date("d/m/Y");


$destino = "RITA <ivan.geraldo@gmail.com>";
$remetente = "$email";
$assunto = "Formulario do Site" ;
$msg = "FORMULARIO DO MEU SITE" . chr(13) . chr(10);
$msg .= "Formulario preenchido em" . date("d/m/Y") . ", os dados seguem abaixo: " . chr(13) . chr(10) . chr(10);


$msg .= "Nome : " . $nome . chr(13) . chr(10);
$msg .= "Data : " . $data . chr(13) . chr(10);
$msg .= "email : " . $email . chr(13) . chr(10);
$msg .= "telefone: " . $telefone . chr(13) . chr(10);
$msg .= "cidade : " . $cidade . chr(13) . chr(10);
$msg .= "estado : " . $estado . chr(13) . chr(10);
$msg .= "pais : " . $pais . chr(13) . chr(10);
$msg .= "hostname: " . $hostname . chr(13) . chr(10);
$msg .= "ip: " . $ip . chr(13) . chr(10);
}


//comparacao case sensitive
	if(strcmp($senha1, $senha2) <> 0) {

	    echo 'As duas senhas precisam serem iguais <a href=cadastro.php>retornar</a> '; //Imprime 'A diferente de a'
	}

else {

$sql = "INSERT INTO usuarios ( codigo,nome,cpf, email,sexo,telefone,ip,endereco,estado,cidade,bairro,cep,pais,login,senha,data,autorizado,receber)
 VALUES ('','$nome','$cpf', '$email','$sexo','$telefone','$ip','$endereco','$estado','$cidade','$bairro','$cep','$pais','$login','$senha1','$data','nao','$receber')";




//Inserindo os dados

$sql = mysql_query($sql)
or die ("Houve erro na gravação dos dados, por favor, clique em voltar e verifique os campos obrigatórios!");

echo "<table border=\"0\">";
echo "<tr>";
echo  "<td align=\"center\">";
 echo "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td align=\"center\"><h1>Muito obrigado pelo seu cadastro !</h1><br>
      <div align=\"center\">Aguarde a nossa an&aacute;lise do seu relatório <a href=\"index.php\">Voltar</a></div><br>
<B>MUITO OBRIGADO</B></td>";
echo "</tr>";
"</table>";
 mail ($destino,$assunto,$msg,"From:$remetente\n");

 }
?>
</body>
</html>









