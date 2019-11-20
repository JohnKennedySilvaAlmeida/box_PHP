<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

//if this module is enabled, this will tell phpwebthings that we are here
$modules["links"]=true;

//include any language dependent text for this module
include_once( "modules/links/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );

//Add a menu item to the user menu
$config["menu"][100] = array( "title"=>$lang["LINKS_TITLE"], "file"=>"links.php", "type"=>"A" );

//Add any menu items to the Admin menu
$config["admmenu"]["Link Categories"] = array( "file"=>"adm_linkscat.php", "class"=>"links" );
$config["admmenu"]["Links"] = array( "file"=>"adm_links.php", "class"=>"links" );

$config["stylecss"]["links"] = false;
?>
