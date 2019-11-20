<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class("admin") ) exit;

$index_page = false;
$page_name = "User access";

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$modulelist = "none";
$loclasses = array();
reset( $config["admmenu"] );
while( $entry = each( $config["admmenu"] ) )
{
	if($entry[1]["class"] != "admin") $loclasses[$entry[1]["class"]] = true;
}
ksort( $loclasses );
reset( $loclasses );
while( $entry = each( $loclasses ) )
{
	$modulelist .= ",".$entry[0];
}

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
//phpdbform( $db, $table, $keys, $sel_fields, $sel_order )
$formdb = new phpdbform( $db, "{$config["prefix"]}_user_access", "userid,module", "userid,module", "userid,module" );
//function add_listbox( $field, $title, $db, $table, $key, $value, $order )
$formdb->add_listbox( "userid", "User:", $db, "{$config["prefix"]}_users", "uid", "name", "name"  );
$formdb->add_static_listbox( "module", "Module:", $modulelist );

theme_draw_centerbox_open("User access","100%");
$formdb->process();
$formdb->draw();

theme_draw_centerbox_close();
draw_footer();
?>