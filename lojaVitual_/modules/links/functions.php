<?php
// functions for links

function draw_links_categories()
{
	global $config, $lang;
	$ret = db_query("select count(*) as qtde, c.cod, c.name, c.descr from {$config["prefix"]}_links l left outer join {$config["prefix"]}_linkscat c on (l.category=c.cod) group by l.category order by l.category" );
	if( !$ret ) return;
	theme_draw_centerbox_open( $lang["LINKS_TITLE"] );
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php
	while( $row = db_fetch_array($ret) ) {
?>
<tr><td class="rowblank" colspan=2>&nbsp;</td></tr>
<tr><td class="row1"><a href="links.php?cat=<?php print $row["cod"]; ?>"><?php print $row["name"]; ?></a></td><td class="row1" align="right">Links: <?php print $row["qtde"]; ?></td></tr>
<tr><td class="row2" colspan=2><?php print $row["descr"]; ?></td></tr>
<?php
	}
	db_free_result($ret);
?>
</table>
<?php
	theme_draw_centerbox_close();
}


function draw_links_list()
{
	global $config, $lang;
	if( !isset($_GET["cat"]) ) return;
	$cat = intval($_GET["cat"]);
	
	// get category name
	$ret = db_query("select name from {$config["prefix"]}_linkscat where cod=$cat");
	// todo: error handling
	if( !$ret ) return;
	if( db_num_rows($ret) != 1 ) {
		db_free_result( $ret );
		print $lang["LINKS_ERROR01"];
		return;
	}
	$cat_name = db_result( $ret, 0, 0 );
	db_free_result( $ret );

	$ret = db_query( "select id, name, count, descr from {$config["prefix"]}_links where category=$cat order by name" );
	// todo: error handling
	if( !$ret ) return;
	theme_draw_centerbox_open( $cat_name );
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
	<td class="row0"><?php print $lang["LINKS_HEADER_1"]; ?></td>
	<td class="row0" align="right" width=60><?php print $lang["LINKS_HEADER_4"]; ?></td>
</tr>
<?php
	while( $row = db_fetch_array($ret) ) {
		print "<tr><td class=\"row1\"><b><a href=\"links.php?link={$row["id"]}\" target=\"_blank\">{$row["name"]}</a></b></td><td class=\"row1\" align=\"right\" width=60>{$row["count"]}</td></tr>";
		print "<tr><td class=\"row2\">{$row["descr"]}</td><td align=\"center\" class=\"row2\"><a href=\"links.php?link={$row["id"]}\" target=\"_blank\"><img src=\"modules/links/link.png\" width=32 height=32 alt=\"{$lang["LINKS_VISIT"]}\" border=0></a></td></tr>";
		print "<tr><td class=\"rowblank\" colspan=2><hr></td></tr>";
	}
?>
</table>
<a href="links.php"><?php print $lang["LINKS_GOUP"]; ?></a>
<?php
	db_free_result($ret);
	theme_draw_centerbox_close();
}
?>