<html>

<?php 
//   function nome (){

//   }
function escrever (){
    echo "Ola mundo <br>";
}
  function calcular ($n1, $n2){
    $r = $n1 * $n2;
    return $r;
  }

  echo "Valor: " . calcular(2, 2);

  function testes (){
      return "oi";
  }
  echo testes();


$x = 2;
  function nome (){
    global $x;
    $x = 1;
  }
nome();
echo $x;
echo "<br>";
$x = 2;
  function nome2 (&$x){
    $x = 1;
    echo $x;
}
nome2($x);
echo $x;

?>

<h1> testes </h1>

<?php
escrever();

escrever();

escrever();

function formatar($texto){

    echo "<b>$texto</b>";

}

formatar("Ola mundo");
















?>

</html>