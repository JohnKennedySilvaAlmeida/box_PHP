
<a href="qs.php">Sem paramentro</a><br>
<a href="qs.php?sessao=1">Um paramentro</a><br>
<a href="qs.php?sessao=2&prod=teste">Dois paramentros</a><br>

<?php

    if (isset($_GET ["sessao"])) {

        $sessao = $_GET["sessao"];
        // $prod = $_GET["prod"];
        $prod = (isset($_GET["prod"])) ? $_GET ["prod"] : false; 

        echo "Sessão: $sessao <br>";
        echo "Produto: $prod <br>";

    }

?>