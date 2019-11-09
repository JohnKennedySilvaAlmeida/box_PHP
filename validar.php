<form action="validar.php" method="post">

    <input type="text" name="nome" placeholder="Nome" value="Marioooooo"><br>

    <input type="text" name="email" placeholder="e-mail"><br>

    <input type="text" name="idade" placeholder="idade"><br>

    <input type="submit" name="enviar" value="Enviar">

</form>

<?php 

  //print_r($_POST);

  echo "<br>"; 

  if (isset($_POST["enviar"])) {

    $erros = array(); // array



      //$nome = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_STRING);

    $nome = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);

    $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_EMAIL);

    $idade = filter_input(INPUT_POST, "idade",FILTER_SANITIZE_NUMBER_INT);



    $vnome = strlen($_POST["nome"]);

    if ($vnome < 5) {

        $erros[] = "Nome invalido!";

    }

    $vemail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);           

    if (!$vemail) {

        $erros[] = "e-mail invalido!";

    }

    $vidade = filter_input(INPUT_POST,"idade", FILTER_VALIDATE_INT);

    if (!$vidade) {

        $erros[] = "Idade invalida!";

    }



    if (!empty($erros)) {

      foreach ($erros as $erro) {

          echo "$erro <br>";

      }

    exit();

    }

  

    echo "Dados enviados com sucesso!";

    echo "<br> Nome: " . $nome;

    echo "<br> Email: " . $email;

    echo "<br> Idade: " . $idade;

  }

?>