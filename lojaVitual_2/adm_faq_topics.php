<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["FAQ Topics"]["class"]) ) exit;

$index_page = false;
$page_name = "FAQ Topics";

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_faq_topics", "cod", "name", "name" );

$formdb->add_textbox( "name", "Topic:", 60 );

theme_draw_centerbox_open("FAQ Topics","100%");
$formdb->process();
$formdb->draw();

theme_draw_centerbox_close();
draw_footer();
?>