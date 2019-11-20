<?php
if (strstr($HTTP_SERVER_VARS["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

$modules["articles"] = true;
include_once( "modules/articles/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][40] = array( "title"=>$lang["ARTICLES_TITLE"], "file"=> "articles.php", "type"=>"A" );

$config["admmenu"]["Articles Categories"] = array ( "file"=>"adm_articlescat.php", "class"=>"articles" );
$config["admmenu"]["Articles Titles"] = array ( "file"=>"adm_articles_title.php", "class"=>"articles" );
$config["admmenu"]["Articles"] = array ( "file"=>"adm_articles.php", "class"=>"articles" );

$config["stylecss"]["articles"] = true;

if( !isset($cfg["articles"]["max_at_index"]) ) $cfg["articles"]["max_at_index"] = 5;

function list_articles_at_index()
{
	global $config, $cfg, $lang;
	$ret = db_query( "select t.article_id, t.title, t.date, t.userid, u.name, t.views from {$config["prefix"]}_articles_title t left outer join {$config["prefix"]}_users u on (t.userid=u.uid) order by t.date desc limit 0, {$cfg["articles"]["max_at_index"]}" );
	if( !$ret )
	{
		print db_error();
		return;
	}
	if( db_num_rows( $ret ) <= 0 ) return;
	theme_draw_centerbox_open( $lang["ARTICLES_LAST_TITLE"] );
	while( $row = db_fetch_array( $ret ) )
	{
		echo show_date( $row["date"], false )."&nbsp;-&nbsp;"
			."<b><a href=\"articles.php?id={$row["article_id"]}\">{$row["title"]}</a></b>"
			."&nbsp;-&nbsp;{$row["name"]}<br>\n";
	}
	theme_draw_centerbox_close();
	db_free_result( $ret );
}
?>