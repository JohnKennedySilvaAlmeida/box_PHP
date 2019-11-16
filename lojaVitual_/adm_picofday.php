<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Pictures"]["class"]) ) exit;
if( !check_module("picofday") ) die( "module not enabled" );

$index_page = false;
$page_name = "Pic of the day";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_picofday", "id", "id,small_picture", "small_picture" );

// read drectory
$img_files = "none";
$dir = opendir("modules/picofday/images/") or die( $ERROR_05 );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") $img_files .= ",$file";
}
closedir($dir);

$formdb->add_listbox( "category", "Category", $db, "{$config["prefix"]}_picofdaycat", "id", "name", "name" );
$formdb->add_listbox( "userid", "User", $db, "{$config["prefix"]}_users", "uid", "name", "name" );
$formdb->add_static_listbox( "small_picture", "Small picture", $img_files );
$formdb->add_static_listbox( "big_picture", "Big picture", $img_files );
$formdb->add_textbox( "description", "Description", 40 );
$formdb->add_textbox( "views", "Views", 10 );
$formdb->add_textbox( "clicks", "Clicks", 10 );
$formdb->add_textarea( "full_description", "Full description", 40, 10 );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>