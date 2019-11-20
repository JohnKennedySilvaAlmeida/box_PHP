<?php
// functions for downloads
if( check_module("comments") )
{
    include_once( "modules/comments/functions.php" );
}

function draw_download_categories()
{
	global $config, $lang;
	$ret = db_query("select count(*) as qtde, c.cod, c.name, c.descr from {$config["prefix"]}_downloads d left outer join {$config["prefix"]}_downloadscat c on (d.category=c.cod) group by d.category order by c.cod" );
	if( !$ret ) return;
	theme_draw_centerbox_open( $lang["DOWNLOAD_TITLE"] );
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php
	while( $row = db_fetch_array($ret) ) {
?>
<tr><td class="rowblank" colspan=2>&nbsp;</td></tr>
<tr><td class="row1"><a href="download.php?cat=<?php print $row["cod"]; ?>"><?php print $row["name"]; ?></a></td><td class="row1" align="right"><?php print $lang["DOWNLOAD_FILES"].": ".$row["qtde"]; ?></td></tr>
<tr><td class="row2" colspan=2><?php print $row["descr"]; ?></td></tr>
<?php
	}
	db_free_result($ret);
?>
</table>
<?php
	theme_draw_centerbox_close();
}

function draw_download_list()
{
	global $config, $lang;
	if( !isset($_GET["cat"]) ) return;
	$cat = intval($_GET["cat"]);
	
	// get category name
	$ret = db_query("select name from {$config["prefix"]}_downloadscat where cod=$cat");
	// todo: error handling
	if( !$ret ) return;
	if( db_num_rows($ret) != 1 ) {
		db_free_result( $ret );
		print $lang["DOWNLOAD_ERROR01"];
		return;
	}
	$cat_name = db_result( $ret, 0, 0 );
	db_free_result( $ret );

	$ret = db_query( "select id, name, date, size, count, rate_sum, rate_count, short_description from {$config["prefix"]}_downloads where category=$cat order by date desc" );
	// todo: error handling
	if( !$ret ) return;
	theme_draw_centerbox_open( $cat_name );
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
	<td class="row0"><?php print $lang["DOWNLOAD_HEADER_1"]; ?></td>
	<td class="row0" align="center" width=90><?php print $lang["DOWNLOAD_HEADER_2"]; ?></td>
	<td class="row0" align="right" width=60><?php print $lang["DOWNLOAD_HEADER_4"]; ?></td>
</tr>
<?php
	while( $row = db_fetch_array($ret) ) {
		if( $row["rate_count"] > 0 ) {
			$rate = number_format( $row["rate_sum"]/$row["rate_count"], 1 )." (".$row["rate_count"].")";
		} else {
			$rate = "- (0)";
		}
		if( $row["size"] > 1048576 ) $filesize = number_format($row["size"]/1048576, 2) . " Mb";
	    else if( $row["size"] > 1024 ) $filesize = number_format($row["size"]/1024, 2) . " Kb";
	    else $filesize = number_format($row["size"], 2) . " bytes";
		
		print "<tr><td class=\"row1\"><b><a href=\"download.php?file={$row["id"]}\">{$row["name"]}</a></b></td><td class=\"row1\" align=\"center\" width=90>".show_date($row["date"], false)."</td><td class=\"row1\" align=\"right\" width=60>{$row["count"]}</td></tr>";
		print "<tr><td class=\"row2\" colspan=2>{$row["short_description"]}</td><td rowspan=2 align=\"center\" class=\"row2\"><a href=\"download.php?download={$row["id"]}\"><img src=\"modules/downloads/download.png\" width=16 height=16 alt=\"{$lang["DOWNLOAD_FILE"]}\" border=0></a></td></tr>";
		print "<tr><td class=\"row2\" colspan=2>{$lang["DOWNLOAD_HEADER_3"]}: $filesize<br>{$lang["DOWNLOAD_HEADER_5"]}: $rate</td></tr>";
		print "<tr><td class=\"rowblank\" colspan=3><hr></td></tr>";

		
	}
?>
</table>
<a href="download.php"><?php print $lang["DOWNLOAD_GOUP"]; ?></a>
<?php
	db_free_result($ret);
	theme_draw_centerbox_close();
}

function draw_download_card()
{
	global $config, $lang, $cfg;
	if( !isset($_GET["file"]) ) return;
	$file = intval($_GET["file"]);

	$ret = db_query("select * from {$config["prefix"]}_downloads where id='$file'");
	$row = db_fetch_array( $ret );
	db_free_result($ret);
	theme_draw_centerbox_open( $lang["DOWNLOAD_TITLE"] );
	if( $row["rate_count"] > 0 ) {
		$rate = number_format( $row["rate_sum"]/$row["rate_count"], 1 )." (".$row["rate_count"].")";
	} else {
		$rate = "- (0)";
	}
	if( $row["size"] > 1048576 ) $filesize = number_format($row["size"]/1048576, 2) . " Mb";
	else if( $row["size"] > 1024 ) $filesize = number_format($row["size"]/1024, 2) . " Kb";
	else $filesize = number_format($row["size"], 2) . " bytes";
	
	echo "<table border=0 cellpadding=2 cellspacing=0 width=\"100%\">"
		."<tr><td class=\"downloadtitle\" align=center height=20 colspan=2><b><a href=\"download.php?download={$row["id"]}\"><img src=\"modules/downloads/download.png\" width=16 height=16 alt=\"{$lang["DOWNLOAD_FILE"]}\" border=0 align=left></a>&nbsp;<a href=\"download.php?download={$row["id"]}\" class=\"downloadtitlelink\">{$row["name"]}</a></b></td></tr>";
	echo "<tr><td class=\"downloadtoppanel\" width=\"100%\"><b>{$lang["DOWNLOAD_HEADER_2"]}: ".show_date($row["date"], false)."<br>"
		."{$lang["DOWNLOAD_HEADER_3"]}: $filesize<br>"
		."{$lang["DOWNLOAD_HEADER_4"]}: {$row["count"]}<br>"
		."{$lang["DOWNLOAD_HEADER_5"]}: $rate</b><br><br>"
		."{$row["short_description"]}</td>";
	echo "<td class=\"downloadtoppanel\" align=right width=180 valign=top>";
	if( $row["small_picture"] != "none" )
	{
		// todo: file security (must contain only one point and no slashes)
		if( $row["big_picture"] != "none" ) echo "<a href=\"modules/downloads/images/{$row["big_picture"]}\" target=\"_blank\">";
		echo "<img src=\"modules/downloads/images/{$row["small_picture"]}\" border=0";
		if( $row["big_picture"] != "none" ) echo " alt=\"".$lang["DOWNLOAD_CLICK"]."\"";
		echo ">";
		if( $row["big_picture"] != "none" ) echo "</a>";
	} else echo "&nbsp;";
	echo "</td></tr>";
	echo "<tr><td class=\"downloadbottompanel\" colspan=2>{$row["description"]}</td></tr>";
	
	if( $cfg["downloads"]["rating"] ) {
		print "<tr><td class=\"downloadbottompanel\" colspan=2 align=\"right\"><form action=\"download.php?file=$file\" method=\"post\" name=\"ratedownload\"><input type=\"hidden\" name=\"ratedlsubmit\" value=\"$file\"><b>{$lang["DOWNLOAD_RATEIT"]}</b>&nbsp;&nbsp;&nbsp;<select name=\"rating\" class=\"field_selectbox\"><option value=\"0\">&nbsp</option>";
		for( $i = 1; $i <= 10; ++$i ) {
			$value = $i;
			$key = sprintf( "DOWNLOAD_RATE%02d", $i );
			if( !empty($lang[$key]) ) $value .= " - ".$lang[$key];
			print "<option value=\"$i\">$value</option>";
		}
		print "</select>&nbsp;&nbsp;<input type=\"submit\" class=\"button\" name=\"submit\" value=\"OK\"></form></td></tr>";
	}
	
    echo "</table>";
	print "<br><a href=\"download.php?cat={$row["category"]}\">{$lang["DOWNLOAD_GOUP"]}</a>";
    theme_draw_centerbox_close();
	if( check_module("comments") )
	{
		process_comments( 3, $row["id"] );
		draw_comments( 3, $row["id"], "download.php?file={$row["id"]}" );
	}
}
?>
