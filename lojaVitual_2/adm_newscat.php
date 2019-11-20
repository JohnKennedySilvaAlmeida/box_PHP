<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["News Categories"]["class"]) ) exit;
if( !check_module("news") ) die( "module not enabled" );
$index_page = false;
$page_name = "News Categories";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_newscat", "cod", "cod,name", "cod" );

// read drectory
$img_files = "none";
$dir = opendir("modules/news/cat_images/") or die( $ERROR_05 );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") $img_files .= ",".$file;
}
closedir($dir);

//$formdb->add_textbox( "cod", "Cod", 10 );
$formdb->add_textbox( "name", "Name", 40 );
$formdb->add_static_listbox( "image", "Image", $img_files );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();

?>