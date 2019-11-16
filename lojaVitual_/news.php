<?php
require_once("core/main.php");
require_once("modules/news/functions.php");
if( !check_module("news") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["NEWS_TITLE"];
$sitemap[] = array($lang["NEWS_TITLE"], "news.php");

draw_header();

if( isset($_GET["cod"]) ) draw_news_full(intval($_GET["cod"]));
else
{
    if( isset($_GET["cat"]) ) $cat = intval($_GET["cat"]);
    else $cat = -1;
    $archived = isset($_GET["archived"]);
    draw_news(false, $cat, $archived);
}

draw_footer();
?>