<?php
// functions for articles
if( check_module("comments") )
{
	include_once( "modules/comments/functions.php" );
}

function list_articles()
{
	global $config, $lang;
	$ret = db_query( "select t.article_id, t.category, c.category as category_name, t.title, t.date, t.views, t.userid, u.name from {$config["prefix"]}_articles_title t left outer join {$config["prefix"]}_users u on (t.userid=u.uid) left outer join {$config["prefix"]}_articlescat c on (t.category=c.cod) order by t.category, t.date desc" );
	if( !$ret )
	{
		print db_error();
		return;
	}
	theme_draw_centerbox_open( $lang["ARTICLES_TITLE"] );
	echo "<table border=0 cellpadding=2 cellspacing=0 width=\"100%\">\n";
	echo "<tr><td class=\"row0\">".$lang["ARTICLES_HEADER1"]."</td>"
			."<td class=\"row0\">".$lang["ARTICLES_HEADER2"]."</td>"
			."<td class=\"row0\">".$lang["ARTICLES_POSTEDBY"]."</td>"
			."<td class=\"row0\" align=\"right\">".$lang["ARTICLES_HEADER4"]."</td></tr>\n";
	$i = 0;
	$category = -1;
	while( $row = db_fetch_array( $ret ) )
	{
		if( $category != $row["category"] )
		{
			echo "<tr><td class=\"rowgroup\" colspan=4>{$row["category_name"]}</td></tr>\n";
			$category = $row["category"];
			$i = 0;
		}
		if( $i%2 == 0 ) $crow = "row1";
		else $crow = "row2";
		echo "<tr><td class=\"$crow\"><a href=\"articles.php?id={$row["article_id"]}\">{$row["title"]}</a></td>"
			."<td class=\"$crow\">".show_date( $row["date"], false )."</td>"
			."<td class=\"$crow\">{$row["name"]}</td>"
			."<td class=\"$crow\" align=\"right\">{$row["views"]}</td></tr>\n";
		$i++;
	}
	echo "</table>\n";
	db_free_result($ret);
	theme_draw_centerbox_close( false );
}

function draw_article()
{
global $config, $lang;

	if( !isset($_GET["id"]) ) return;
	$id = intval( $_GET["id"] );
	if( !isset($_GET["page"]) ) $page = -1;
	else $page = intval($_GET["page"]);
	if( $page == -1 )
	{
		$firstview = true;
		$page = 1;
	} else $firstview = false;
	$ret = db_query( "select t.title, t.date, t.userid, a.subtitle, a.page, a.text, u.name from {$config["prefix"]}_articles a left outer join {$config["prefix"]}_articles_title t on (a.article_id = t.article_id)  left outer join {$config["prefix"]}_users u on (t.userid = u.uid) where a.article_id=$id and a.page=$page" );
	if( !$ret )
	{
		print db_error();
		return;
	}
	$row = db_fetch_array( $ret );
	db_free_result( $ret );
	if( !$row ) return;
	if( $firstview ) db_query( "update {$config["prefix"]}_articles_title set views=views+1 where article_id=$id" );
	db_query( "update {$config["prefix"]}_articles set views=views+1 where article_id=$id and page=$page" );
	theme_draw_centerbox_open( $row["title"] );
?>
<table border=0 cellpadding=2 cellspacing=0 width="100%">
<tr>
	<td class="articlesubtitle" colspan=3 align="center"><?php print $row["subtitle"]; ?></td>
</tr>
<tr>
	<td class="rowpostedby" colspan=2><?php print $lang["ARTICLES_POSTEDBY"]; ?> <a class="rowpostedbylink"  href="user.php?uid=<?php print $row["userid"]; ?>"><?php print $row["name"]; ?></a></td>
	<td class="rowpostedby" align="right"><?php print show_date($row["date"],false); ?></td>
</tr>
<tr>
	<td class="articletext" colspan=3 align="justify" height=450 valign="top">
	<br><?php print $row["text"]; ?><br><br></td>
</tr>
<tr>
	<td class="articlefooter" width="40%">
<?php
	// previous page
	$ret = db_query( "select subtitle, page from {$config["prefix"]}_articles where article_id=$id and page < $page order by page desc limit 0,1" );
	if( !$ret )
	{
		print db_error();
		return;
	}
	$rprev = db_fetch_array( $ret );
	db_free_result( $ret );
	if( $rprev )
	{
		$prevsubtitle = $rprev["subtitle"];
		if( strlen( $prevsubtitle ) > 20 ) $prevsubtitle = substr( $prevsubtitle, 0, 20 )."...";
		echo "<a href=\"articles.php?id=$id&page={$rprev["page"]}\"  class=\"articlefooterlink\">$prevsubtitle<br>".$lang["ARTICLES_PREV"]."</a>";
	} else echo "&nbsp;";
	
	echo "</td><td class=\"articlefooter\" align=center width=\"20%\">{$row["page"]}</td><td class=\"articlefooter\" align=right  width=\"40%\">";
	// next page
	$ret = db_query( "select subtitle, page from {$config["prefix"]}_articles where article_id=$id and page > $page order by page limit 0,1" );
	if( !$ret )
	{
		print db_error();
		return;
	}
	$rnext = db_fetch_array( $ret );
	db_free_result( $ret );
	if( $rnext )
	{
		$nextsubtitle = $rnext["subtitle"];
		if( strlen( $nextsubtitle ) > 20 ) $nextsubtitle = substr( $nextsubtitle, 0, 20 )."...";
		echo "<a href=\"articles.php?id=$id&page={$rnext["page"]}\"  class=\"articlefooterlink\">$nextsubtitle<br>".$lang["ARTICLES_NEXT"]."</a>";
	} else echo "&nbsp;";
	echo "</td></tr>\n";
	
	
	echo "</table>";
	theme_draw_centerbox_close( false );

	if( check_module("comments") )
	{
		process_comments( 5, $id );
		draw_comments( 5, $id, "articles.php?id=$id&page=$page" );
	}
}

?>
