<? include ("topo.html"); ?><br>
  <?
  if (empty($HTTP_COOKIE_VARS["admin"]) or empty($HTTP_COOKIE_VARS["senha_admin"])) {

      echo "Você precisa estar conectado para ver esta área<br>faça seu <a href=\"loginadm.php\">login</a>";
      }


else {
echo "Olá ";
echo $HTTP_COOKIE_VARS["admin"]."<br>";
echo "<a href=\"../logout.php\">sair do sistema</a>";

?>
 <?Php

       if (getenv("REQUEST_METHOD") == "POST") {

       $comentario = $_POST['comentario'];
       $imagem_nome = $_FILES['file_a']['name'];
       $tipo = $_FILES['file_a']['type'];
       $tamanho1 =$_FILES['file_a']['size'];
           $nav = "<a href=\"foto.php\">voltar</a>";
      $rr = "..//images/";
      $tamanho = 100000 ;
      $comentario = trim($comentario);

      if (file_exists($rr.$_FILES['file_a']['name'])){
       $erro[]= "<font color=\"red\"><b>Arquivo ".$_FILES['file_a']['name']." já existe</b></font>.$nav";
      }
      if ( $tamanho <= $_FILES['file_a']['size']){
      $erro[] = " <font color=\"red\"><b>Os Arquivos devem ter no maximo" .$tamanho." bytes </b></font><br>
      <a href=\"foto.php\">voltar</a>";
      }
      if(sizeof($erro))
    {
        foreach($erro as $err)
        {
            echo " - " . $err . "<BR>";
        }

        echo "<a href=\"foto2.php\">Fazer Upload de Outra Imagem</a>";

        }
        if ($erro==''){
        $arquivo_e  = $_FILES['file_a']['tmp_name'];
         $arquivo_d  = $rr.$_FILES['file_a']['name'];
         if (move_uploaded_file($arquivo_e,$arquivo_d));{
         include ("conecta.php");
        $sql = "INSERT INTO imagens(codigo,endereco,comentario,autorizado) VALUES ('','$arquivo_d','$comentario','sim')";
       //Agora é hora de contatar o mysql

      //Inserindo os dados
       $sql = mysql_query($sql)
or die ("Houve erro na gravação dos dados, por favor, clique em voltar e verifique os campos obrigatórios!");
      echo '<b>Foi transferido com sucesso seu arquivo</b>';
     echo "<BR>Brevemente publicaremos ele.<B>MUITO OBRIGADO</B><br>
     deseja <a href=\"foto.php\">transferir outro arquivo</a><br>
     <a href=\"admin.php\">Voltar para Administração</a>";
   }
   }
   }


?>




  <?

}?>
