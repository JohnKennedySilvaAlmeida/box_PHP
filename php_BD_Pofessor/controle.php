<?php 
  $num = 10;
    if ($num == 10) {
        echo "O numero é 10!";
    }
    if (($num == 10) or ($num == 20)) {
        echo "O numero é 10 ou 20";
    }
    if ($num <> 11) {
        echo "diferente de 10";
    }
    if (($num > 5)&&($num < 20)) {
        echo "Numero entre 5 e 20";
    }
    //Incorreto eh exibido um notice
    // if (!$x) {
    //     echo "nao existe x";
    // }
    if (!isset($x)) {
        echo "nao existe x";
    }
    if (isset($x)) {
        echo "existe x";
    }
    if ($num > 5) {
        echo "Numero maior que 5";
    } else {
        echo "Numero menor que 5";
    }
    //IF ternario (coisa do capeta)
    $numero = ($num > 5) ? "maior" : "menor" ;
    echo "Numero $numero que 5";

    if ($num == 5) {
        echo "Numero 5";
    } elseif ($num == 10) {
        echo "Numero 10";
    } else {
        echo "Numero nao e 5 ou 10";
    }
    switch ($num) {
        case 5:
            echo "Num 5";
            break;
        case $num > 5:
            echo "maior que 5";
            break;
        case $num < 5:
            echo "menor que 5";
            break;
        default:
            echo "nenhum";
            break;
    }

    for ($num=1; $num <= 10; $num++)
    {
        echo "Número: $num <br>";
    }
    for ($n=1; $n <= 6; $n++)
    {
        echo "<h$n>Cabecalho $n </h$n>";
    }
    // echo "Ola" . $n;

    $n = 1;
    while ($n <= 6){
        echo "<h$n>teste</h$n>";
        $n++;
    }

    $n = 1;
    while ($n <= 10){
        echo "Número: $n <br>";
        $n++;
    }
    //arrumar;
    $n = 1;
    do {
        echo "Num: $n <br>";
        $n++;    
    } while ($n <= 10);
    
?>

