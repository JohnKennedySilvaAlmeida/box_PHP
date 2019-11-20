<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Links"]["class"]) ) exit;
if( !check_module("links") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["LINKS_TITLE"];

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_links", "id", "name", "name" );

$formdb->add_listbox( "category", "Category", $db, "{$config["prefix"]}_linkscat", "cod", "name", "name");
$formdb->add_textbox( "name", "Name", 30 );
$formdb->add_textbox( "url", "URL", 60 );
$formdb->add_textarea( "descr", "Short description", 60, 10 );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>
