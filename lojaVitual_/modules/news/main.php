<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

$modules["news"] = true;
include_once( "modules/news/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][20] = array( "title"=>$lang["NEWS_TITLE"], "file"=>"news.php", "type"=>"A" );
$config["menu"][30] = array( "title"=>$lang["NEWS_SUBMIT_TITLE"], "file"=> "adm_news2.php?new=1", "type"=>"L" );

$config["admmenu"]["News Categories"] = array( "file"=>"adm_newscat.php", "class"=>"admin" );
$config["admmenu"]["Pending news"] = array( "file"=>"adm_news2.php", "class"=>"admin" );
//$config["admmenu"]["News"] = array( "file"=>"adm_news.php", "class"=>"news" );
$config["admmenu"]["Archive News"] = array( "file"=>"adm_arch_news.php", "class"=>"news" );

$config["fileman"]["news"] = array( "name"=>"News", "folder"=>"/modules/news/images/" );
$config["fileman"]["news_cat"] = array( "name"=>"News Categories", "folder"=>"/modules/news/cat_images/" );

$config["stylecss"]["news"] = true;

if( !isset($cfg["news"]["max_at_index"]) ) $cfg["news"]["max_at_index"] = 5;
if( !isset($cfg["news"]["max_per_page"]) ) $cfg["news"]["max_per_page"] = 10;

function draw_news_pending( $side="left" )
{
	global $config, $lang;
	if( !check_user_class($config["admmenu"]["Pending news"]["class"]) ) return;
	// list news that are waiting for publish
	$stmt = "select count(*) from {$config["prefix"]}_news where active='N' and archived='N'";
	$ret = db_query( $stmt );
	$pnews = false;
	if( $ret ) {
		$pnews = (db_result( $ret, 0, 0 ) > 0);
		db_free_result( $ret );
	}
	if( $pnews ) {
		if( $side=="left" )	theme_draw_leftbox_open($lang["NEWS_PENDING_TITLE"]);
		else theme_draw_rightbox_open($lang["NEWS_PENDING_TITLE"]);
		print "<a href=\"adm_news2.php\">{$lang["NEWS_PENDING_MSG"]}</a>";
		if( $side=="left" )	theme_draw_leftbox_close();
		else theme_draw_rightbox_close();
	}
}
?>
