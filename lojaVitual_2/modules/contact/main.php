<?php
if (strstr($_SERVER['PHP_SELF'], "/modules/"))  die ("You can't access this file directly...");
//if this module is enabled, this will tell phpwebthings that we are here
$modules["contact"]=true;
include_once( "modules/contact/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][140] = array( "title"=>$lang["CONTACT_TITLE"], "file"=>"contact.php", "type"=>"A" );

$config["stylecss"]["contact"] = false;
?>