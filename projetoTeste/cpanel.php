<?php

    $usuario = $_POST['usuario'];
    $senha = $_POST['pass'];

    if($_POST['usuario'] == 'admin' && $_POST['pass'] == '123'){

        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['senha'] = $_POST['pass'];
        header("location: index.php");
    } else{
        header("Location: formulario.php");
    }

?>