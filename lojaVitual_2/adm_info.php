<?php
include_once("core/main.php");
$index_page = false;
$page_name = "Info - webthings";
// this is forced here for security reasons
if( !check_user_class("admin") ) exit;

draw_header();

theme_draw_centerbox_open( "Modules" );
reset( $modules );

$col = 0;
$maxcol = 4;
print "<table border=0 align=center width=400 cellpadding=2 cellspacing=0>\n";
while( $entry = each( $modules ) )
{
	if( $col == 0 ) print "<tr>\n";
	print "\t<td width=100 class=\"centerboxtext\">{$entry[0]}</td>\n";
    $col++;
    if( $col > $maxcol ) {
		print "</tr>\n";
		$col = 0;
	}
}
if( $col > 0 )
{
    print "<td colspan=".($maxcol-$col+1)." class=\"centerboxtext\">&nbsp;</td>\n";
    print "</tr>\n";
}
echo "</table>";
theme_draw_centerbox_close();

theme_draw_centerbox_open( "config[admmenu]" );
reset( $config["admmenu"] );
print "<table border=0 align=center width=400 cellpadding=2 cellspacing=0>\n";
$col = 0;
$maxcol = 1;
while( $entry = each( $config["admmenu"] ) )
{
	if( $col == 0 ) print "<tr>\n";
	echo "\t<td class=\"centerboxtext\"><b>{$entry[0]}</b></td><td class=\"centerboxtext\">{$entry[1]["class"]}</td>\n";
	$col++;
    if( $col > $maxcol ) {
		echo "</tr>\n";
		$col = 0;
	}
}
if( $col > 0 )
{
    print "<td colspan=".($maxcol-$col+1)." class=\"centerboxtext\">&nbsp;</td>\n";
	print "<td colspan=".($maxcol-$col+1)." class=\"centerboxtext\">&nbsp;</td>\n";
    print "</tr>\n";
}
echo "</table>";
theme_draw_centerbox_close();

theme_draw_centerbox_open( "Config" );
reset( $config );
print "<table border=0 align=center width=400 cellpadding=2 cellspacing=0>\n";
while( $entry = each( $config ) )
{
    echo "<tr>";
	echo "\t<td class=\"centerboxtext\"><b>{$entry[0]}</b></td><td class=\"centerboxtext\">{$entry[1]}</td>\n";
    echo "</tr>\n";
}
echo "</table>";
theme_draw_centerbox_close();

theme_draw_centerbox_open( "config[menu]" );
reset( $config["menu"] );
ksort( $config["menu"] );
print "<table border=0 align=center width=400 cellpadding=2 cellspacing=0>\n";
while( $entry = each( $config["menu"] ) )
{
	echo "<tr><td width=30 align=right class=\"centerboxtext\"><b>{$entry[0]}</b></td><td width=100 class=\"centerboxtext\">{$entry[1]["title"]}</td><td width=150 class=\"centerboxtext\">{$entry[1]["file"]}</td><td width=30 align=right class=\"centerboxtext\">{$entry[1]["type"]}</td></tr>\n";
}
echo "</table>";
theme_draw_centerbox_close();

theme_draw_centerbox_open( "Session" );
reset( $_SESSION["wt"] );
print "<table border=0 align=center width=400 cellpadding=2 cellspacing=0>\n";
while( $entry = each( $_SESSION["wt"] ) )
{
    echo "<tr>";
	echo "\t<td class=\"centerboxtext\"><b>{$entry[0]}</b></td>";
    if( !is_array($entry[1]) ) echo "<td class=\"centerboxtext\">{$entry[1]}</td>\n";
    else {
        echo "<td class=\"centerboxtext\"><table border=0 align=center>\n";
        while( $entry1 = each( $entry[1] ) ) {
            echo "<tr>\t<td class=\"centerboxtext\"><b>{$entry1[0]}</b></td><td class=\"centerboxtext\">{$entry1[1]}</td>\n</tr>";
        }
        echo "</table></td>\n";
    }
    echo "</tr>\n";
}
echo "</table>";
theme_draw_centerbox_close();

draw_footer();
?>