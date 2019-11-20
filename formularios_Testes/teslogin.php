<!DOCTYPE html>

<html lang="pt-br">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />

    <title>Cleanex</title>



    <!-- CSS  -->

    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <link rel="shortcut icon" href="images/favicon (8).ico" type="image/x-icon">

    <link rel="icon" href="images/favicon (8).ico" type="image/x-icon">







    <style>

        body {

            display: flex;

            min-height: 100vh;

            flex-direction: column;

        }



        main {

            flex: 1 0 auto;

        }



        body {

            background: white;

        }



        .input-field input[type=date]:focus+label,

        .input-field input[type=text]:focus+label,

        .input-field input[type=email]:focus+label,

        .input-field input[type=password]:focus+label {

            color: #e91e63;

        }



        .input-field input[type=date]:focus,

        .input-field input[type=text]:focus,

        .input-field input[type=email]:focus,

        .input-field input[type=password]:focus {

            border-bottom: 2px solid #e91e63;

            box-shadow: none;

        }

    </style>

</head>



<body>



    <!--   Cabeçalho   -->

    <?php include("inc_header.php"); ?>



    <div class="section center container"></div>

    <main>

        <div class="center"><a href="index.php"><img class="responsive-img" style="width: 450px; " src="Logo_Cleanex.png" /></a></div>

        <div class="section center"></div>

        <div class="section center"></div>



        <div class="container center">

            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">



                <form class="col s12" method="post">

                    <div class='row center'>

                        <div class='col s12'>

                        </div>

                    </div>



                    <div class='row center'>

                        <div class='input-field col s12'>

                            <input class='validate' type='email' name='email' id='email' />

                            <label for='email'>E-mail</label>

                        </div>

                    </div>



                    <div class='row center'>

                        <div class='input-field col s12'>

                            <input class='validate' type='password' name='password' id='password' />

                            <label for='password'>Senha</label>

                        </div>

                        <label style='float: right;'>

                            <a class='pink-text' href='#!'><b>Esqueceu sua senha?</b></a>

                        </label>

                    </div>



                    <br />

                    <div class='row center'>

                        <a href="index.php"><button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo' id="login" onclick="functionTeste()">Login</button></a>

                    </div>

                </form>

            </div>

        </div>

        <div class="center"><a href="create_acount.php">Cadastrar-se</a></div>

        <div class="section center"></div>

        <div class="section center"></div>

    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>




    <!--  Scripts-->

    <?php include("inc_scripts.php"); ?>



</body>



</html>