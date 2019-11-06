<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <title>Documento</title>

    <!-- Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- materialize.css -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!-- CSS Customizado -->
    <link rel="stylesheet" href="css/customizado.css">

    <!-- viewport para mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <?php
    
        include("inc_cabecalho.php");
        // require("inc_cabecalho.php") or die("Site em manutenção");
        require("inc_funcoes.php");

        card("john kennedy","blue");
        card("john kennedy","red");
    
    ?>

    <!-- <div class="card blue-grey darken-1">
        <div class="card-content white-text">
            <span class="card-title"></span>
            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
            <a href="#">This is a link</a>
            <a href="#">This is a link</a>
        </div>
    </div> -->
    
    <?php
        
        ola();

        include("inc_rodape.php");
    
    ?>



    <!-- JavaScript no final do body para otimizar o carregamento -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>

</html>