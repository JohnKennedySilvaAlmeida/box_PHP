<?php
    $array = array(1, 2, 3, 4, 5);

    print_r($array);
    // var_dump($array);

    echo "***** <br>";
    
    $array1[] = 6;

    print_r($array1);

    echo "++++++ <br>";

    $primeiroquarto  = array(1 => 'Janeiro', 'Fevereiro', 'Março');

    echo "<br> //////";
    print_r($primeiroquarto);
    echo "<br> -+-+-+";
    count($primeiroquarto);
    echo "<br>*-+/*-+/*-";
    var_dump($array);


?>

<?php
    $array2 = array(
        "foo" => "bar",
        "bar" => "foo",
        100   => -100,
        -100  => 100,
    );

    var_dump($array2);

?>

<?php
    $array3 = array("foo", "bar", "hello", "world");
    var_dump($array3);
?>


<?php
    $array5 = array(
        "foo" => "bar",
         42    => 24,
         "multi" => array(
         "dimensional" => array(
             "array" => "foo"
            )
        )
    );

    var_dump($array5["foo"]);
    var_dump($array5[42]);
    var_dump($array5["multi"]["dimensional"]["array"]);
?>


<!-- https://www.php.net/manual/pt_BR/language.types.array.php -->