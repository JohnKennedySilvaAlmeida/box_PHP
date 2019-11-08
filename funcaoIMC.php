
<?php 

    function imc($peso, $altura){


        $imc = round($peso / ($altura * $altura));

        if ($imc < 18.5) {
            // return "Abaixo do peso! <br> Seu imc é {$imc}.";
            return "<h2 class='center red container'>Abaixo do peso! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc >= 18.5 && $imc <= 24.5) {
           // return " Peso normal! <br> Seu imc é {$imc}.";
           return "<h2 class='center green container'>Peso normal! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 24.5 && $imc <= 29.9) {
            //return "Com excesso de peso! <br> Seu imc é {$imc}.";
            return "<h2 class='center yellow container'>Com excesso de peso! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 29.9 && $imc <= 34.9) {
           // return "Nível de obesidade! <br> Seu imc é {$imc}.";
           return "<h2 class='center orange container'>Nível 1 de obesidade! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 34.9 && $imc <= 39.9) {
            //return "Nível de obesidade mórbida! <br> Seu imc é {$imc}.";
            return "<h2 class='center red container'>Nível 2 de obesidade mórbida! <br> Seu imc é {$imc}.</h2>";
        } else{
            return "<h2 class='center red container'>Nível 3 de obesidade mórbida! <br> Seu imc é {$imc}.</h2>";
        }

    }

    if (isset($_POST['enviar'])) {

        $nome = $_POST['nome']; 
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];

        // str_replace(",",".", $altura);  // obs!!
        // str_replace(",",".", $peso);   // obs!!
            
        imc($peso, $altura);

        $cauculo_imc = imc($peso, $altura);

        echo "<h2 class='center'>Sr.{$nome}<i class='material-icons'>face</i></h2>";
        echo "<h2 class='center'>{$cauculo_imc}</h2>";

    }


    
    // teste****************************************************************************************************************************** php

    // function valida(){

    //     echo "<br>"; 

    //     if (isset($_POST["enviar"])) {

    //         $erros = array(); // array

    //         $nome = filter_input(INPUT_POST, "nome",FILTER_SANITIZE_SPECIAL_CHARS,FILTER_SANITIZE_STRING);

    //         $altura = filter_input(INPUT_POST, "altura",FILTER_SANITIZE_NUMBER_FLOAT);

    //         $peso = filter_input(INPUT_POST, "peso",FILTER_SANITIZE_NUMBER_FLOAT);


    //         $vnome = strlen($_POST["nome"]);

    //         if ($vnome < 4) {

    //             $erros[] = "Nome inválido!";

    //         }

    //         $altura = filter_input(INPUT_POST,"altura", FILTER_VALIDATE_FLOAT);

    //         if (!$valtura) {

    //             $erros[] = "Altura inválida!";

    //         }

    //         $vpeso = filter_input(INPUT_POST,"peso", FILTER_VALIDATE_FLOAT);

    //         if (!$vpeso) {

    //             $erros[] = "Peso inválido!";

    //         }


    //         if (!empty($erros)) {

    //         foreach ($erros as $erro) {

    //             echo "$erro <br>";

    //         }

    //         exit();

    //         }

    //         echo "Dados enviados com sucesso!";

    //         echo "<br> Nome: " . $nome;

    //         echo "<br> Altura: " . $altura;

    //         echo "<br> Peso: " . $peso;

    //     }
    // }


?>


   