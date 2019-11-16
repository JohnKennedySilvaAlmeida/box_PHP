<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Forums"]["class"]) ) exit;
if( !check_module("forum") ) die( "module not enabled" );

$index_page = false;
$page_name = "Forums";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, $config["prefix"]."_forums", "cod", "cod,title", "cod" );

$formdb->add_textbox( "title", "Title", 60 );
$formdb->add_textarea( "descr", "Description", 60, 5 );
$formdb->add_checkbox( "locked", "Locked", "Y", "N" );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();

theme_draw_centerbox_close();
draw_footer();
?>