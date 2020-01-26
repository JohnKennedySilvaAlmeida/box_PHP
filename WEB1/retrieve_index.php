<?php
    // tela login
    // $usuario = $_POST["usuario"];
    // $senha   = $_POST["senha"];

    // system("./funcao {$usuario} {$senha}");

    // tela cadastro
    $nomeC    = $_POST["nomeC"];   
    $usuarioC = $_POST["usuarioC"];
    $senhaC   = $_POST["senhaC"];

    system("./funcao {$nomeC} {$usuarioC} {$senhaC}");

?>