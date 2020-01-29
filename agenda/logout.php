<?php
    session_start();
    unset($_SESSION['autenticado']);
    unset($_SESSION['usuario']);
    session_destroy();
    header("Location: index.php");
?>