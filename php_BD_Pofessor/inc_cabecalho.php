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



      <style>
        iframe{
          position:absolute;
          top: 90px;
          left: 10px;
        }
        .f1{
          position:absolute;
          top: 290px;
          left: 10px;
        }
        .f2{
          position:absolute;
          top: 490px;
          left: 10px;
        }
        .f3{
          position:absolute;
          top: 690px;
          left: 10px;
        }
        

      </style> 

    </head>

<body>  


<nav>
    <div class="nav-wrapper black">
      <a href="#!" class="brand-logo center ">Blog do PHP</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
        <li><a href="login.php">Login</a></li>
        <!-- <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li> -->
      </ul>
    </div>
</nav>

    
<div class="row center container">
    <div class="col s12 m12">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Tecnologia</span>
          <p> Havia um tempo sem celulares, 
            sem ipods, sem computadores, sem videogames. Uma época em que o trabalho era feito, as pessoas voltavam para casa,
            assistiam televisão e iam ler, conversar, enfim, viver.

            Hoje, vivemos uma época em que estar fora da tecnologia é estar fora do mundo.
            A tecnologia deixou de ser um simples diferencial no trabalho, transformou-se em obrigatoriedade. 
            Sem tecnologia básica de um computador e internet, ter emprego hoje é quase impossível.</p>
        </div>
        <div class="card-action">
          <a href="https://materializecss.com/">Materialize</a>
          <a href="https://olhardigital.com.br/">Olhar Digital</a>
          <a href="https://www.microsoft.com/pt-br">Dicas</a>
          <a href="https://www.mysql.com/">Mysql</a>
          <a href="https://www.php.net/manual/pt_BR/intro-whatis.php">PHP</a>
        </div>
      </div>
    </div>
  </div>
            
    <br><br>


    <iframe  src="https://netsupport.com.br/blog/o-que-e-ti/" 
    frameborder="5"></iframe>

    <iframe class='f1' src="https://www.maisdados.com.br/o-que-o-profissional-de-ti-faz-entenda-de-uma-vez-por-todas/" 
    frameborder="5"></iframe>

    <iframe class='f2' src="http://www.b3.com.br/pt_br/" 
    frameborder="5"></iframe>

    <iframe class='f3' src="https://olhardigital.com.br/" 
    frameborder="5"></iframe>



  <!-- <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">Javascript</a></li>
    <li><a href="mobile.html">Mobile</a></li>
  </ul> -->