<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
//if this module is enabled, this will tell phpwebthings that we are here
$modules["messages"]=true;
include_once( "modules/messages/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][90] = array( "title"=>$lang["UMSG_TITLE"], "file"=>"messages.php", "type"=>"L" );

$config["stylecss"]["messages"] = false;

if( !isset($cfg["messages"]["max_size"]) ) $cfg["messages"]["max_size"] = 300000;

function check_user_messages()
{
	global $config,$lang;
	if( !$_SESSION["wt"]["logged"] ) return "";
	$ret = db_query( "select count(cod) from {$config["prefix"]}_user_msgs where userid='{$_SESSION["wt"]["uid"]}' and msg_read=0 and folder='inbox'");
	$tot_msg = db_result($ret,0,0);
    db_free_result($ret);
	if( $tot_msg > 0 ) return sprintf( $lang["UMSG_MESSAGES"], $tot_msg, "<a href=\"messages.php\">","</a>" );
	else return "";
}

?>
