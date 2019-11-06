<?php

    echo strlen ("ola");

    echo '<br>';

    echo strlen (" ola ");

    // conta caracteres...

    echo '<br>';

    echo substr("olar mundo", 1, 3);   //corta carcteres...


    echo '<br>';

    $email = "teste@teste.com";   //verifica se @ existe no email

    $verifica = strpos($email, "@");

    if ($verifica === false) {
        echo("Inválido");
    }else {
        echo("Correto");
    }


    echo '<br>';

    echo strlen(trim(" ola "));   // retira espaços
    echo strlen(ltrim(" ola"));
    echo strlen(rtrim("ola "));

 

    // strtolower(string);
    // strtoupper(string);
    // ucfirst(string);
    // ucwords(string);               maiusculo e minusculos etc.


    echo '<br>';

    echo str_replace("x","y","ola x e muitos x");   // substitui x pelo y n texto


    echo '<br>';

    $Url = "https://materializecss.com/john";    // pega (/) depois o nome e depois reverte

    $vetor = explode("/", $Url);

    $arrayReverso = array_reverse($vetor);

    echo $arrayReverso[0];


    echo '<br>';

   // arredonda / matematia

    echo ceil(4.3); // 5

    echo '<br>';    

    echo floor(4.3); // 4

    echo '<br>';

    echo round(4.365, 2); // arredonda um numero    


    echo '<br>';

    $x = "3,59";

    $x = str_replace(",",".","$x");    // converte

    echo $x . "<br>";
    echo round($x, 1);


    echo '<br>';
    // data e hora

    $data = date("j/m/Y");
    echo "data:".$data;

    echo '<br>';

    $hora = date("H:i:s");
    echo "hora: ".$hora;

    echo '<br>';

    echo date_default_timezone_get();

    echo '<br>';    // hora brasil

    date_default_timezone_set('Brazil/East');

    $dataeHora = date('d/m/Y H:i');

    echo  $dataeHora;



?>