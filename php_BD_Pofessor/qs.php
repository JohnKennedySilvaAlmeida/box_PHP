<a href="qs.php">Sem paramentro</a><br>
<a href="qs.php?sessao=1"> Um paramentro</a><br>
<a href="qs.php?sessao=2&prod=teste"> dois paramentros</a><br>
<?php 
    if (isset($_GET["sessao"])) {
        $sessao = $_GET["sessao"];
        $prod = (isset($_GET["prod"])) ? $_GET["prod"] : false ;        
        echo "Sessao $sessao <br>";
        echo "Produto $prod";
    }
?>