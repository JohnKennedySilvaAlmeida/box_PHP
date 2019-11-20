<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
//if this module is enabled, this will tell phpwebthings that we are here
$modules["comments"]=true;

//include lang
include_once( "modules/comments/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );

$config["stylecss"]["comments"] = false;
?>
