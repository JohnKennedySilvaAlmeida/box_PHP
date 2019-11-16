<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Side Boxes"]["class"]) ) exit;
if( !check_module("sideboxes") ) die( "module not enabled" );

$index_page = false;
$page_name = "Side Boxes";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_sideboxes", "cod", "pos,side,title", "side,pos" );

// read drectory
$img_files = "none";
$dir = opendir("modules/sideboxes/files/") or die( $ERROR_05 );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") $img_files .= ",".substr( $file, 0, strrpos( $file, "." ) );
}
closedir($dir);

$formdb->add_textbox( "pos", "Position", 10 );
$formdb->add_static_listbox( "side", "Side", "left,right" );
$formdb->add_checkbox( "onlyindex", "Shows only at index page ?", "1", "0" );
$formdb->add_textbox( "title", "Title", 60 );
$formdb->add_textarea( "content", "Content", 60, 10 );
$formdb->add_static_listbox( "file", "PHP file", $img_files );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();

?>