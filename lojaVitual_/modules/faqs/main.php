<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
//if this module is enabled, this will tell phpwebthings that we are here
$modules["faqs"]=true;
//include lang
include_once( "modules/faqs/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][70] = array( "title"=>$lang["FAQ_TITLE"], "file"=>"faq.php", "type"=>"A" );

$config["admmenu"]["FAQ Topics"] = array ( "file"=>"adm_faq_topics.php", "class"=>"faq_topics" );
$config["admmenu"]["FAQ"] = array ( "file"=>"adm_faq.php", "class"=>"faqs" );

$config["stylecss"]["faqs"] = true;
?>
