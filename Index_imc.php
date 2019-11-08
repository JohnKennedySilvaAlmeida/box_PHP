<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>index</title>

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

    <nav>
        <div class="nav-wrapper black">
        <a href="#" class="material-icons">fitness_center</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html"></a></li>
            <li><a href="badges.html"></a></li>
            <li><a href="collapsible.html"></a></li>
        </ul>
        </div>
    </nav><br>

    <h1 class="center blue container">IMC</h1>

    <form action="#" method="post" class="container">

        <label>Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="abcd" pattern="[a-z\s]+$" required/>
          
        <label>Altura:</label>
        <input type="text" name="altura" id="altura" placeholder="0.00" pattern="[0-9.,]+$" required/>

        <label>Peso:</label>
        <input type="text" name="peso" id="peso" placeholder="00" pattern="[0-9.,]+$" required/>

        <a class="btn-floating pulse cyan accent-2"><i class="material-icons">arrow_forward</i></a>

        <input class="text-color cyan accent-2" type="submit" value="Calcular" name="enviar" id="enviar"/>

    </form>

    <?php
    
        include("funcaoIMC.php");
        // apenasNum();  --- teste
    
    ?>

    <br>
    <footer class="page-footer black">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <!-- <h5 class="white-text">Pratique exércícios e tenha uma boa alimentação</h5> -->
                <p class="grey-text text-lighten-4">Vida Saúde</p>
              </div>
              <!-- <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div> -->
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 Copyright 
            </div>
          </div>
        </footer>



    <!-- JavaScript no final do body para otimizar o carregamento -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>

    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>

</html>