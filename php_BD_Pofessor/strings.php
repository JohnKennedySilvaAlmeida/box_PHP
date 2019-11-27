<?php 
//conta a quantidade de caracteres;
echo strlen("ola");
echo strlen(" ola ");


echo "<br>";
echo substr("Ola Mundo", 1, 6); // retorna "bcd"

$email="testes@testes.com";
$verificar=strpos($email, "@");
if ($verificar === false){
    echo "invalido";
}else {
    echo "valido";
}
//retirar espaços antes e depois
echo strlen(trim(" Ola ")); // 3

//Substituir strings
echo str_replace("x","y","Ola x e muitos x");
echo str_replace("velho", "novo", "onde tiver velho");

echo round(3.4);
echo "<br>";
echo round(3.7,2);
echo "<br>";
echo round(3.5);
echo "<br>";
echo round(3.5345, 2);
echo "<br>";

//converter , em .
$x = "3,59";
$x = str_replace(",", ".", $x);
echo $x;
echo "<br>";
echo round($x, 1);







?>