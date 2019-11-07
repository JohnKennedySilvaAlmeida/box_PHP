<form action="validar.php" method="POST">

    <input type="text" name="nome" placeholder="Nome"><br>
    <input type="text" name="email" placeholder="e-mail"><br>
    <input type="text" name="idade" placeholder="Idade"><br>
    <input type="submit" name="enviar" value="Enviar"><br>

</form> 

<?php

    print_r($_POST);

    echo "<br>";

    if (isset($_POST ["enviar"])) {
        $erro = array();
    }

?>


<!-- falta ???? -->