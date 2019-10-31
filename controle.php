<?php

    $num = 10;
    $num2 = 11;

    if ($num == 10) {
       echo "o numero é dez !" . "<br>";
    }
    if (($num == 10) or ($num == 20)) {
        echo "o numero é diferende de dez !" . "<br>";
    }
    if ($num <> 11) {
        echo "diferende de dez";
    }
    if (($num > 5) && ($num <20)) {
        echo "Maior que 5 ou menor 20" . "<br>";
    }
    if (!isset($x)) {
        echo "Nao existe x" . "<br>";
    }

    // if (!$x) {
    //     echo "Nao existe x";
    // }

    echo $num > $num2 ? ' sim!' : ' não!' . "<br>";

    $res = ($num > 5) ? "maior" : "menor" . "<br>";
    echo " numero $res que 5" . "<br>";



    if ($num > $num2) {
        echo "maior" . "<br>";
    }
    elseif ($num == $num2) {
        echo "Igual" . "<br>";
    }
    else {
        echo "Diferentes" . "<br>";
    }



    $i = 3;

    switch ($i) {

        case 0:
            echo "i equals 0" . "<br>";
            break;
        case 1:
            echo "i equals 1" . "<br>";
            break;
        case 2:
            echo "i equals 2" . "<br>";
            break;
        case $i > 100:
            echo "maior que 100" . "<br>";
            break;    
        default:
            echo "Diferente > que 3" . "<br>";  
            break;
    }
    
?>