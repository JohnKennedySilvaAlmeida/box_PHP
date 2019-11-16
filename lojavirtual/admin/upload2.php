<?
$erro = $config = array();

// Prepara a variável do arquivo
$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
     $campo1 = $_POST['campo1'];
   $campo2 = $_POST['campo2'];
   $campo3 = $_POST['campo3'];
   $campo4 = $_POST['campo4'];
   $campo5 = $_POST['campo5'];
   $campo6 = $_POST['campo6'];
   $campo7 = $_POST['campo7'];


//tirar espaço em branco das variaveis recebidass através de formulario
  $campo1 = trim( $campo1);
  $campo2 = trim( $campo2);
  $campo3 = trim( $campo3);
  $campo4 = trim( $campo4);
  $campo5 = trim( $campo5);
  $campo6 = trim( $campo6);//preco
   $campo6= number_format($campo6, 2);//formata numero para padrao mysql
  $campo7 = trim( $campo7);

// Tamanho máximo do arquivo (em bytes)
$config["tamanho"] = 100000;
// Largura máxima (pixels)
$config["largura"] = 350;
// Altura máxima (pixels)
$config["altura"]  = 180;

// Formulário postado... executa as ações
if($arquivo)
{
        // Verifica se o mime-type do arquivo é de imagem
    if(!eregi("^image\/(pjpeg|jpeg)$", $arquivo["type"]))
    {
        $erro[] = "Arquivo em formato inválido! A imagem deve ser jpg ou jpeg . Envie outro arquivo";
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

        echo "<a href=\"foto.php\">Fazer Upload de Outra Imagem</a>";
    }

    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
    else
    {
        // Pega extensão do arquivo
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

        // Gera um nome único para a imagem
        $imagem_nome = $arquivo["name"];

        // Caminho de onde a imagem ficará
        $imagem_dir = "..//images/" . $imagem_nome;

        // Faz o upload da imagem
        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
        include ("conecta.php");
        $sql = "INSERT INTO produtos(codigo,id,id_filho,fabricante,produto,preco,imagem,autorizado,detalhes) VALUES('',$campo2,'$campo3','$campo4','$campo5','$campo6','images/$imagem_nome','sim','$campo7')";
       //Agora é hora de contatar o mysql

      //Inserindo os dados
       $resultado = mysql_query($sql)
or die ("Houve erro na gravação dos dados, por favor, clique em voltar e verifique os campos obrigatórios!");
      echo '<b>Foi transferido com sucesso seu arquivo</b>';
     echo "<BR>Brevemente publicaremos ele.<B>MUITO OBRIGADO</B><br>
     deseja <a href=\"foto.php\">transferir outro arquivo</a><br>
     <a href=\"admin.php\">Voltar para Administração</a>";
     mysql_close($conexao);
    }
}
?>

