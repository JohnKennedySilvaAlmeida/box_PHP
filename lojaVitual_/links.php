<?php
include_once("core/main.php");
include_once("modules/links/functions.php");
if( !check_module("links") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["LINKS_TITLE"];

//Add any sitemap information before calling draw_header()
$sitemap[] = array($lang["LINKS_TITLE"], "links.php");

//You can perform any redirections or other header() functions here.

if( isset($_GET["link"]) )
{
    $link = intval($_GET["link"]);
    $ret = db_query("select url from {$config["prefix"]}_links where id='$link'");
    $url = db_result($ret,0,0);
    db_free_result($ret);
    if( strlen(trim($url)) <= 0 ) print $lang["ERROR_07"];
    else {
        @db_query("update {$config["prefix"]}_links set count=count+1 where id='$link'");
        Header("Location: $url");
    }
}

draw_header();
if( isset($_GET["cat"]) ) draw_links_list();
else draw_links_categories();
draw_footer();
?>
