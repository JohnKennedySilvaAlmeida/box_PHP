<?php
include_once("core/main.php");
if( !check_user_class("admin") ) exit;

$index_page = false;
$page_name = "Menu";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_menu", "pos", "pos,title", "pos" );

$formdb->add_textbox( "pos", "Position", 10 );
$formdb->add_textbox( "title", "Title", 60 );
$formdb->add_textbox( "url", "Url (relative or absolute)", 60 );
$type = array();
$types[] = array( "A","Every time" );
$types[] = array( "N","Not Logged" );
$types[] = array( "L","Logged" );
$formdb->add_static_listbox( "type", "Appears when user:", $types );
theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>