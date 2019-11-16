<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Forum Access"]["class"]) ) exit;
if( !check_module("forum") ) die( "module not enabled" );

$index_page = false;
$page_name = "Forums - Access";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, $config["prefix"]."_forums_mod", "forum,userid,type", "forum,userid,type", "forum,userid,type" );

$formdb->add_listbox( "forum", "Forum", $db, $config["prefix"]."_forums", "cod", "title", "cod" );
$formdb->add_textbox( "userid", "User ID", 10 );
$formdb->add_static_radiobox( "type", "Access type", "allowed,moderator" );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();

draw_footer();
?>