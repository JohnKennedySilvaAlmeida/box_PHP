<?php

    session_start();

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
        echo "<a href='cpanel.php'>Login</a>";
        exit;
    }

?>