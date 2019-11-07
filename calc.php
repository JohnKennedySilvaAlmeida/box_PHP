<a href="calc.php">Sem paramentro</a><br>
<a href="calc.php?n=10&n2=20">Calcular 1</a><br>
<a href="calc.php?n=5&n2=10">Calcular 2</a><br>

<?php

    print_r($_GET);

    if ((isset($_GET["n"])) && (isset($_GET["n2"]))) {
        $res = $_GET["n"] * $_GET["n2"];

        echo "Resultado: $res <br>";
    }

    // if (isset($_GET ["sessao"])) {

    //     $sessao = $_GET["sessao"];
    //     // $prod = $_GET["prod"];
    //     $prod = (isset($_GET["prod"])) ? $_GET ["prod"] : false; 

    //     echo "Sessão: $sessao <br>";
    //     echo "Produto: $prod <br>";

    // }

?>