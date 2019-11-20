<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Links"]["class"]) ) exit;

$index_page = false;
$page_name = "Links Categories";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_linkscat", "cod", "name", "name" );

$formdb->add_textbox( "name", "Category", 60 );
$formdb->add_textarea( "descr", "Description", 60, 10 );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();
?>
