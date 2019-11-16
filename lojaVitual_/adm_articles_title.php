<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Articles Titles"]["class"]) ) exit;
if( !check_module("articles") ) die( "module not enabled" );

$index_page = false;
$page_name = "Articles Titles";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_articles_title", "article_id", "date,title", "date" );

$formdb->add_listbox( "category", "Category", $db, "{$config["prefix"]}_articlescat", "cod", "category", "category" );
$formdb->add_textbox( "title", "Title", 60 );
$formdb->add_date( "date", "Date", $cfg["core"]["date_format"] );
$formdb->add_listbox( "userid", "User", $db, "{$config["prefix"]}_users", "uid", "name", "name" );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>