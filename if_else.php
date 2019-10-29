<?php
    if ($a > $b)
    echo "a is bigger than b";
?>

<?php
    if ($a > $b) {
    echo "a is bigger than b";
    $b = $a;
    }
?>

<?php
    $v = 1;

    $r = (1 == $v) ? 'Yes' : 'No'; // $r is set to 'Yes'
    $r = (3 == $v) ? 'Yes' : 'No'; // $r is set to 'No'

    echo (1 == $v) ? 'Yes' : 'No'; // 'Yes' will be printed

    // and since PHP 5.3
    $v = 'My Value';
    $r = ($v) ?: 'No Value'; // $r is set to 'My Value' because $v is evaluated to TRUE

    $v = '';
    echo ($v) ?: 'No Value'; // 'No Value' will be printed because $v is evaluated to FALSE
?>

<!-- https://www.php.net/manual/pt_BR/control-structures.if.php -->


<?php
    if ($a > $b) {
    echo "a is greater than b";
    } else {
    echo "a is NOT greater than b";
    }
?>


<?php
    if ($a > $b) {
        echo "a is bigger than b";
    } elseif ($a == $b) {
        echo "a is equal to b";
    } else {
        echo "a is smaller than b";
    }
?>

<?php

    /* Incorrect Method: */
    if($a > $b):
        echo $a." is greater than ".$b;
    else if($a == $b): // Will not compile.
        echo "The above line causes a parse error.";
    endif;


    /* Correct Method: */
    if($a > $b):
        echo $a." is greater than ".$b;
    elseif($a == $b): // Note the combination of the words.
        echo $a." equals ".$b;
    else:
        echo $a." is neither greater than or equal to ".$b;
    endif;

?>

<!-- https://www.php.net/manual/pt_BR/control-structures.elseif.php -->