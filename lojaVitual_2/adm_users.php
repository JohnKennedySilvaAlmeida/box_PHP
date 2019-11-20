<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class("admin") ) exit;

$index_page = false;
$page_name = "Users";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_users", "uid", "uid,name", "name" );

$formdb->add_textbox( "name", "Name", 20 );
$formdb->add_textbox( "realname", "Real Name", 40 );
$formdb->add_textbox( "email", "E-mail", 50 );
$formdb->add_static_listbox( "class", "Class", "normal,admin" );
$formdb->add_checkbox( "active", "Active", "Y", "N" );
$formdb->add_textbox( "dateregistered", "Registered", 20 );
$formdb->add_textbox( "dateactivated", "Activated", 20 );
$formdb->add_checkbox( "receivenews", "Receive News", "Y", "N" );
$formdb->add_checkbox( "receiverel", "Receive Release", "Y", "N" );
$formdb->add_textbox( "avatar", "Avatar", 30 );

theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();

?>
