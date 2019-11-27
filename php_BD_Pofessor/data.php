<?php 
    $data = date("j/m/Y H:i:s");
    echo $data; 
    echo date_default_timezone_get();
    date_default_timezone_set('Brazil/East');
    $data= date('d/m/Y H:i');
    echo $data;
?>