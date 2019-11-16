<?php
include_once("core/main.php");
$index_page = false;
$page_name = "banner report";
if( !check_module("banners") ) die( "module not enabled" );
if( !check_user_class($config["admmenu"]["Banner Report"]["class"]) ) exit;

draw_header();

theme_draw_centerbox_open("Banner Report!");
$ret = db_query("select * from {$config["prefix"]}_banners order by cod") or die(db_error());
echo "<table border=0 cellspacing=0 cellpadding=2 width=\"100%\">"
    ."<tr><td class=\"row0\">Banner</td><td align=right class=\"row0\">Page views</td><td align=right class=\"row0\">Clicks</td></tr>";
$i=0;
while($row = db_fetch_array($ret))
{
	$class = sprintf( "class=\"row%d\"", ($i++%2)+1 );
    echo "<tr><td $class>"
		.$row["name"]."</td>"
		."<td align=right $class>".$row["views"]."</td><td align=right $class>".$row["clicks"]."</td></tr>";
}
echo "</table>";
theme_draw_centerbox_close();
draw_footer();
?>
