<!-- // criar banco / conexao  -->
<?php

    $DB_HOST="localhost";
    $DB_NAME="site"; // nome BD
    $DB_USER="root";
    $DB_PASS="123456"; // Senha BD

    $DNS = "mysql:host=$DB_HOST;dbname=$DB_NAME";

    try {
        $conexao = new PDO($DNS, $DB_USER, $DB_PASS);

    } catch (PDPException $e) {
        echo '<br>Erro: ' . $e -> getCode();
        echo '<br>Msg: ' . $e -> getMessage();
    }

?>

