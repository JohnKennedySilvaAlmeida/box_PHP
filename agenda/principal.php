<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title>Agenda Web</title>

</head>

<body>
<?php

if (!$_SESSION['autenticado']){
  include_once "index.php";
  exit("<div class='alert alert-danger col-sm-12'>Para acessar o sistema você deve efetuar login</div>");
}
?>
<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Agenda Web - Bem vindo <b><?=$_SESSION['usuario'];?></b></div>
                        
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="logout.php"> Sair </a></div>
                    </div>     
            </div>
            
              <!-- Menu dropdown com bootstrap -->
              <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                    <li><a href="?q=1">Cadastrar Contato</a></li>
                    <li><a href="#">Visualizar Contatos</a></li>
                    <li><a href="#">Localizar</a></li>
              </ul>
              </div>

<?php
  if (isset($_GET['q'])){
    switch($_GET['q']) {
      case '1':
        include_once 'novoContato.inc.php';
        break;
      case '1b':
        include_once 'Contato.class.php';
        $contato = new Contato();
        try {
          $contato->novo($_POST['nome'],$_POST['email'],$_POST['telefone'],$_SESSION['usuario']);
          echo "<br /><br /><div class='alert alert-success col-sm-12'>Contato salvo com sucesso.</div>";
        } catch(PDOException $p) {
          echo "Ocorreu um erro inesperado: ". $p->getMessage();
        }  
    }
  } else {
    ?>
         <div style="font-size:60px;color:white;text-shadow: 2px -5px 3px skyblue;margin:0 auto;width:50%">Agenda WEB 1.0</div> 
    <?php
  }      
?>
            
            
            
        </div>
</div>
</body>
</html>