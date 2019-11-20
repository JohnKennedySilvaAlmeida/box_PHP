<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["Downloads Categories"]["class"]) ) exit;
if( !check_module("downloads") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["DOWNLOAD_TITLECAT"];

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_downloadscat", "cod", "name", "name" );

$formdb->add_textbox( "name", "Category:", 40 );
$formdb->add_textarea( "descr", "Description:", 40, 10 );

theme_draw_centerbox_open( $lang["DOWNLOAD_TITLECAT"] );
$formdb->process();
$formdb->draw();

theme_draw_centerbox_close();
draw_footer();
?>