<?php

    function formatar ($t){
            
        echo "<u><em><b>$t</b></em></u>";
    }

    function calc($x , $y){
            
        echo "Vezes  | " . $s = $x * $y . '<br>';
        echo "Somar  | " . $m = $x + $y . '<br>';
        echo "Subtração  | " . $mn = $x - $y . '<br>';
        echo "Divisão  | " . $d = $x / $y . '<br>';
    }

    calc(2,5);

    formatar("lula livre")  . '<br>';
?>
