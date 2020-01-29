<?php
    session_start();
    session_destroy();
    header('Location: index.php');
    exit();
    // logout.php

    // https://www.canalti.com.br/programacao/web/php/como-criar-sistema-de-login-com-php-e-mysql/
?>