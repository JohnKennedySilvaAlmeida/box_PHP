<?php
include_once("core/main.php");
include_once( "modules/picofday/functions.php" );
if( !check_module("picofday") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["PICOFDAY_TITLE"];
$sitemap[] = array($lang["PICOFDAY_TITLE"], "picofday.php");
draw_header();
if( isset($_GET["pic"]) ) draw_picofday_card($_GET["pic"]);
else if( isset($_GET["cat"]) ) draw_picofday_list();
else draw_picofday_catlist();

draw_footer();
?>