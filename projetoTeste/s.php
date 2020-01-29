<?php
    session_start();
    session_destroy();
    header('Location: l.php');
    exit();


    
    // logout.php
    // https://www.canalti.com.br/programacao/web/php/como-criar-sistema-de-login-com-php-e-mysql/
   // https://blog.vilourenco.com.br/php-trabalhando-com-sessions/
?>