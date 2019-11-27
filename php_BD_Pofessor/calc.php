<a href="calc.php">Sem paramentro</a><br>
<a href="calc.php?n1=10&n2=20"> calcular 1</a><br>
<a href="calc.php?n1=5&n2=10"> calcular 2</a><br>
<?php
    print_r($_GET);

    if ((isset($_GET["n1"]))&&(isset($_GET["n2"]))) {
        $resultado = $_GET["n1"] * $_GET["n2"];
        echo "Resultado $resultado";
    }

    // if (isset($_GET["sessao"])) {
    //     $sessao = $_GET["sessao"];
    //     $prod = (isset($_GET["prod"])) ? $_GET["prod"] : false ;        
    //     echo "Sessao $sessao <br>";
    //     echo "Produto $prod";
    // }
?>