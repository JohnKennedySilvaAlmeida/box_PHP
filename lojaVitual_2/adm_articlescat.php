<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Articles Categories"]["class"]) ) exit;
if( !check_module("articles") ) die( "module not enabled" );

$index_page = false;
$page_name = "Articles Categories";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_articlescat", "cod", "cod,category", "category" );

$formdb->add_textbox( "cod", "ID", 10 );
$formdb->add_textbox( "category", "Category", 60 );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>