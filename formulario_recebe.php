<?php

    // print_r($_POST);

    if ((isset($_POST["nome"])) && (isset($_POST["end"]))) {
        $res1 = $_POST["nome"]; 
        $res2 = $_POST["end"];

        echo "Nome: $res1 <br>";
        echo "Endereço: $res2 <br>";
    }

?>

<br>
<a href="formulario.php">Voltar</a>