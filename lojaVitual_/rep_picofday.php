<?php
include_once("core/main.php");
$index_page = false;
$page_name = "picofday report";
if( !check_user_class($config["admmenu"]["Pictures report"]["class"]) ) exit;
if( !check_module("picofday") ) die( "module not enabled" );

draw_header();

theme_draw_centerbox_open("Picture of the Day Report!");
$ret = db_query("select s.date, s.views, s.clicks, p.id, p.small_picture, p.description from {$config["prefix"]}_picofdaysel s left outer join {$config["prefix"]}_picofday p on (s.picture_id = p.id) order by s.date desc") or die(db_error());
?>
<table border=0 cellspacing=0 cellpadding=2 width="100%">
	<tr>
		<td class="row0">Date</td>
		<td class="row0">Description</td>
		<td class="row0" align=right>Views</td>
		<td class="row0" align=right>Clicks</td>
<?php if( check_module("comments") ) echo "<td class=\"row0\" align=right>Comments</td>"; ?>
	</tr>
<?php
$i = 0;
while($row = db_fetch_array($ret))
{
	$class = sprintf( "class=\"row%d\"", (($i++)%2)+1 );
?>
	<tr>
		<td <?php print $class; ?>><?php print show_date( $row["date"], false ); ?></td>
		<td <?php print $class; ?>><?php print $row["description"]; ?></td>
		<td <?php print $class; ?> align=right><?php print $row["views"]; ?></td>
		<td <?php print $class; ?> align=right><?php print $row["clicks"]; ?></td>
<?php
    if( check_module("comments") )
    {
		// the comments are for the picture, not for the selection, like
		// other statistics here
		$ret2 = db_query( "select count(cod) from {$config["prefix"]}_comments where type=4 and link='{$row["id"]}'" );
		echo "<td $class align=right>".db_result( $ret2, 0, 0 )."</td>";
		db_free_result( $ret2 );
	}
?>
	</tr>
<?php
}
?>
</table>
<?php
db_free_result($ret);
theme_draw_centerbox_close();
draw_footer();
?>
