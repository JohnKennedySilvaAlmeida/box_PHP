<?php
include_once("core/main.php");
include_once( "modules/articles/functions.php" );

$index_page = false;
$page_name = $lang["ARTICLES_TITLE"];

$sitemap[] = array($lang["ARTICLES_TITLE"], 'articles.php');

if( isset( $_GET["id"] ) )
{
	$id = intval( $_GET["id"] );
	$q = db_query( "select title from {$config["prefix"]}_articles_title where article_id=$id" );
	if( $q )
	{
		if( db_num_rows( $q ) == 1 )
		{
			$sitemap[] = array( db_result( $q, 0, 0 ), "articles.php?id=$id" );
		}
		db_free_result( $q );
	}
}
draw_header();

if( isset($_GET["id"]) ) draw_article();
else list_articles();

draw_footer();
?>