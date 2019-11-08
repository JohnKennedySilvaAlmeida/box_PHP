
<?php 


    function imc($peso, $altura){

        $imc = round($peso / ($altura * $altura));

        if ($imc < 20) {
            // return "Abaixo do peso! <br> Seu imc é {$imc}.";
            return "<h2 class='center red'>Abaixo do peso! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc >= 20 && $imc <= 25) {
           // return " Peso normal! <br> Seu imc é {$imc}.";
           return "<h2 class='center green'>Peso normal! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 25 && $imc <= 30) {
            //return "Com excesso de peso! <br> Seu imc é {$imc}.";
            return "<h2 class='center yellow'>Com excesso de peso! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 30 && $imc <= 35) {
           // return "Nível de obesidade! <br> Seu imc é {$imc}.";
           return "<h2 class='center orange'>Nível de obesidade! <br> Seu imc é {$imc}.</h2>";
        }
        if ($imc > 35) {
            //return "Nível de obesidade mórbida! <br> Seu imc é {$imc}.";
            return "<h2 class='center red'>Nível de obesidade mórbida! <br> Seu imc é {$imc}.</h2>";
        }

    }

    if (isset($_POST['enviar'])) {
            
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];

            
        imc($peso, $altura);

        $cauculo_imc = imc($peso, $altura);

        echo "<h2 class='center'>{$cauculo_imc}</h2>";

    }

?>


   