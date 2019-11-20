<?php
include_once("core/main.php");
if( !check_module("banners") ) die( "module not enabled" );
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["Edit banners"]["class"]) ) exit;

$index_page = false;
$page_name = "Banners";

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
//phpdbform( $db, $table, $keys, $sel_fields, $sel_order )
$formdb = new phpdbform( $db, "{$config["prefix"]}_banners", "cod", "name", "name" );

// read drectory
$img_files = "none";
$dir = opendir("modules/banners/images/") or die( $lang["ERROR_05"] );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") $img_files .= ",".$file;
}
closedir($dir);

$formdb->add_textbox( "name", "Name:", 20 );
$formdb->add_checkbox( "active", "Active:", "Y", "N" );
$formdb->add_static_listbox( "image", "Image:", $img_files );
$formdb->add_textbox( "url_image", "Or URL Image:", 60 );
$formdb->add_textbox( "url", "URL:", 60 );
$formdb->add_textarea( "code", "Or full code to banner:", 60, 10 );

theme_draw_centerbox_open("Banners");
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();

draw_footer();
?>