<?php

    function formulario(){
        
    ?>
        <form action="formulario2.php" method="POST">

        <input type="text" name="nome" placeholder="Nome"><br>
        <input type="text" name="end" placeholder="End"><br>
        <input type="submit" name="enviar" value="Enviar"><br>

        </form> 

    <?php

    }

    
    function enviar(){

        if ((isset($_POST["nome"])) && (isset($_POST["end"]))) {
            $res1 = $_POST["nome"]; 
            $res2 = $_POST["end"];
    
            echo "Nome: $res1 <br>";
            echo "Endereço: $res2 <br>";
        }else {
            echo "Favor digitar!";
        }

    }

    if (array_key_exists("enviar" , $_POST)) {
        formulario();
    }else {
        enviar();
        echo '<br> <a href="formulario2.php">voltar</a> <br>';

    }


?>



<!-- olhar !!!! algum erro ?????? -->