<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

$modules["fileman"] = true;
include_once( "modules/fileman/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["admmenu"]["File Manager"] = array( "file"=>"adm_fileman.php", "class"=>"admin" );

$config["stylecss"]["fileman"] = false;

if( !isset($cfg["fileman"]["max_upload"]) ) $cfg["fileman"]["max_upload"] = 1000000;
?>
