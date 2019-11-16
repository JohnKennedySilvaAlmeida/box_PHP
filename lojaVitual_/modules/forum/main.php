<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

$modules["forum"] = true;

include_once( "modules/forum/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][50] = array( "title"=>$lang["FORUM_TITLE"], "file"=>"forum.php", "type"=>"A" );

$config["admmenu"]["Forums"] = array( "file"=>"adm_forums.php", "class"=>"admin" );
$config["admmenu"]["Forum Topics"] = array( "file"=>"adm_forum_topics.php", "class"=>"forums" );
$config["admmenu"]["Forum Access"] = array( "file"=>"adm_forums_mod.php", "class"=>"forums" );

$config["stylecss"]["forum"] = true;

if( !isset($cfg["forum"]["nbmess"]) )             $cfg["forum"]["nbmess"] = 8;
if( !isset($cfg["forum"]["search_type"]) )        $cfg["forum"]["search_type"] = "AND";
if( !isset($cfg["forum"]["allow_anonymous"]) )    $cfg["forum"]["allow_anonymous"] = false;
if( !isset($cfg["forum"]["anonymous"]) )          $cfg["forum"]["anonymous"] = "Anonymous";
if( !isset($cfg["forum"]["newest_first"]) )       $cfg["forum"]["newest_first"] = false;
if( !isset($cfg["forum"]["show_locked_forums"]) ) $cfg["forum"]["show_locked_forums"] = true;
?>