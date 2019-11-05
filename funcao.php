<html>


<?php

    function nome ($arg_1, $arg_2){
        
        echo "Exemplo de função" . '<br>';

        return $valor_retornado;
    }

    function escrever (){
        
        echo "Exemplo de função" . '<br>';
    }

    function calc ($n1, $n2){

        $r = $n1 * $n2;

        return $r;
    }

    function test (){

       return "oie" . '<br>';
    }


    $x = 2;

    function nomee (){
        global $x;  // Obs!!! global
        $x = 1;
    }


    $numero = 1;

    function soma (&$numero){
        $numero = 1;

        echo $numero;
    }


?>

<h1> Teste </h1>

<?php

    escrever();

    echo "valor : " . calc(2,3)  . '<br>';

    echo test();

    nomee();
    echo $x . '<br>';

    soma($numero);
    echo $numero;
?>



</html>