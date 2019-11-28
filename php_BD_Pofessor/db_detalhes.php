<!DOCTYPE html>
  <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Blog</title>

        <!-- Google Icon Font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- materialize.css -->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!-- CSS Customizado -->
        <link rel="stylesheet" href="css/customizado.css">
        
        <!-- viewport para mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>



<nav>
    <div class="nav-wrapper black">
      <a href="#!" class="brand-logo center ">Blog PHP</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
        <li><a href="db_completo.php">Voltar</a></li>
        <!-- <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li> -->
      </ul>
    </div>
</nav>

<?php 
require_once("db_conectar.php");


$cod = filter_input(INPUT_GET, "cod",FILTER_SANITIZE_NUMBER_INT);

if ($cod >=1) {
    $sql = "SELECT * FROM usuarios WHERE cod = :cod";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cod', $cod);
    if($stmt->execute()) {
        $resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($stmt->rowCount()) {
            foreach ($resultado as $campo) {
                echo $campo['cod'] . " - " . $campo['nome']. '<br>';
            }
        }else{
            echo "<br>Registro nao encontrado!<br>";
        }
        echo '<a href="db_completo.php">Exibir todos os resultados</a>';
    } else {
        echo "Erro: " . $stmt->errorCode();
    }    
}else {
    echo "Codigo invalido";
}

// include("inc_rodape.php");


?>
