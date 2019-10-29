<?php
/* exemplo 1 */

    for ($i = 1; $i <= 10; $i++) {
        echo $i;
    }

/* exemplo 2 2 */

    for ($i = 1; ; $i++) {
        if ($i > 10) {
            break;
        }
        echo $i;
    }

/* exemplo 3 */

    $i = 1;
    for (; ; ) {
        if ($i > 10) {
            break;
        }
        echo $i;
        $i++;
    }

/* exemplo 4 */

    for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++);

?>


<?php
/*
 * Esta é uma array com alguns dados que devem ser modificadoswant to modify
 * durante a execuçao do loop for.
 */
    $people = array(
        array('name' => 'Kalle', 'salt' => 856412),
        array('name' => 'Pierre', 'salt' => 215863)
    );

    for($i = 0; $i < count($people); ++$i) {
        $people[$i]['salt'] = mt_rand(000000, 999999);
    }
?>


<?php
    $people = array(
        array('name' => 'Kalle', 'salt' => 856412),
        array('name' => 'Pierre', 'salt' => 215863)
    );

    for($i = 0, $size = count($people); $i < $size; ++$i) {
        $people[$i]['salt'] = mt_rand(000000, 999999);
    }
?>

<!-- https://www.php.net/manual/pt_BR/control-structures.for.php -->


<?php
/* example 1 */

    $i = 1;
    while ($i <= 10) {
        echo $i++;  /* the printed value would be
                    $i before the increment
                    (post-increment) */
    }

    /* example 2 */

    $i = 1;
    while ($i <= 10):
        echo $i;
        $i++;
    endwhile;
?>

<?php 
    $myArray=array('aa','bb','cc','dd'); 
    while (list ($key, $val) = each ($myArray) ) echo $val; 
    reset($myArray); 
    while (list ($key, $val) = each ($myArray) ) echo $val; 
?>

<?php
    $arr = array("orange", "banana", "apple", "raspberry");

    $i = 0;
    while ($i < count($arr)) {
    $a = $arr[$i];
    echo $a ."\n";
    $i++;
    }
    // or
    $i = 0;
    $c = count($arr);
    while ($i < $c) {
    $a = $arr[$i];
    echo $a ."\n";
    $i++;
    }
    ?>

    <!-- This could be more efficient; -->

    <?php
    while ($a = $arr[1 * $i++]) echo $a ."\n";

?>

<!-- https://www.php.net/manual/pt_BR/control-structures.while.php -->


<?php
    $i = 0;
    do {
        echo $i;
    } while ($i > 0);
?>

<?php
    do {
        if ($i < 5) {
            echo "i is not big enough";
            break;
        }
        $i *= $factor;
        if ($i < $minimum_limit) {
            break;
        }
    echo "i is ok";

        /* process i */

    } while (0);
?>

<?php
    $i = 100
    while ($i < 10) :
        echo "\$i is $i.";
    endwhile;
    ?>
    <!-- returning: -->

    <!-- if you write with DO/WHILE: -->
    <?php
    $i = 100;
    do {
        echo "\$i is $i.";
    } while ($i < 10);
?>

<!-- https://www.php.net/manual/pt_BR/control-structures.do.while.php -->