<?php
if (strstr($HTTP_SERVER_VARS["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
//if this module is enabled, this will tell phpwebthings that we are here
$modules["downloads"]=true;
include_once( "modules/downloads/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][60] = array( "title"=>$lang["DOWNLOAD_TITLE"], "file"=>"download.php", "type"=>"A" );
$config["admmenu"]["Downloads Categories"] = array( "file"=>"adm_downloadscat.php", "class"=>"downloads" );
$config["admmenu"]["Add Downloads"] = array( "file"=>"add_download.php", "class"=>"downloads" );
$config["admmenu"]["Downloads"] = array( "file"=>"adm_downloads.php", "class"=>"downloads" );

$config["fileman"]["downloads"] = array( "name"=>"Downloads", "folder"=>"/modules/downloads/images/" );

$config["stylecss"]["downloads"] = true;

if( !isset($cfg["downloads"]["dir"]) ) $cfg["downloads"]["dir"] = "/files/";
if( !isset($cfg["downloads"]["rating"]) ) $cfg["downloads"]["rating"] = true;
?>
