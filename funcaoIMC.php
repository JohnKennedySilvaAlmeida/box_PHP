
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

            
        imc($peso, $altura);

        $cauculo_imc = imc($peso, $altura);

        echo "<h2 class='center'>Sr.{$nome}<i class='material-icons'>face</i></h2>";
        echo "<h2 class='center'>{$cauculo_imc}</h2>";

    }

    // function apenasNum(){
    //     $campo = $_POST['altura'];

    //     if($campo != is_numeric($campo)){
    //     echo "Não é numero";
    //     }else{
    //     echo "É numero";
    //     }
    // } teste**

?>


   