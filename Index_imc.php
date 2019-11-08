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

    <h1 class="center blue">IMC</h1>

    <form action="#" method="post" class="container">
          
        <label>Altura:</label>
        <input type="text" name="altura" id="altura" placeholder="0.00"/>

        <label>Peso:</label>
        <input type="text" name="peso" id="peso" placeholder="00" />

        <input type="submit" value="Enviar" name="enviar" id="enviar"/>

    </form>

    <?php
    
        include("funca_imc.php");
    
    ?>






    <!-- JavaScript no final do body para otimizar o carregamento -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>

    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>

</html>