<?php
include_once("core/main.php");
$index_page = false;
$page_name = $lang["LIST_USERS_TITLE"];
$sitemap[] = array($lang["LIST_USERS_TITLE"], "listusers.php");

draw_header();

if( !$_SESSION["wt"]["logged"] )
{
    theme_draw_centerbox_open( $lang["LIST_USERS_TITLE"] );
    print "<span class=\"error\">{$lang["NOT_LOGGED_LIST_USERS"]}</span>";
    theme_draw_centerbox_close();
    draw_footer();
    exit;
}

theme_draw_centerbox_open( $lang["LIST_USERS_TITLE"] );
$maxrows = 25;
$maxcols = 3;

$val = 0;
if( isset($_GET["val"]) ) $val = intval($_GET["val"]);
if( $val < 0 ) $val = 0;
$offset = $val;
$limit = $maxrows * ($maxcols+1);
?>
<table width="100%" border=0 cellpadding=2 cellspacing=0 bgcolor="#eeeeee">
    <tr>
<?php
$country = "";
$col = 0;
$rec = $val;
$crow = 0;
$lastrec = 0;
$ret = db_query( "select uid,name,country from {$config["prefix"]}_users where active='Y' order by country,name limit $offset,$limit" );

while( $row = db_fetch_array($ret) ) {
    if( $crow == $maxrows ) {
        $lastrec = $rec;
        break;
    }
    if( $row["country"]!=$country ) {
        if( $col > 0 ) {
            echo "<td class=\"centerboxtext\" colspan=".($maxcols-$col+1).">&nbsp;</td>\n";
            echo "</tr>\n<tr>";
            $crow++;
        }
        echo "<td colspan=".($maxcols+1)." class=\"centerboxtext\"><b>{$row["country"]}</b></td>\n</tr>\n";
        $country = $row["country"];
        $col = 0;
        $crow++;
    }

    if( $col == 0 ) echo "<tr>";
    echo "<td class=\"centerboxtext\" width=\"25%\">";
    echo "<a href=\"user.php?uid={$row["uid"]}\">".$row["name"]."</a>";
    echo "</td>\n";
    $col++;
    $rec++;
    if( $col > $maxcols ) {
        echo "</tr>\n";
        $col = 0;
        $crow++;
    }
}
db_free_result( $ret );
if( $col > 0 )
{
    echo "<td class=\"centerboxtext\" colspan=".($maxcols-$col+1).">&nbsp;</td>\n";
    echo "</tr>\n";
}
echo "</table>\n";

echo "<table width=\"100%\" border=0 cellpadding=2 cellspacing=0 align=\"center\"><tr>";
    echo "<td width=\"50%\" align=\"center\" class=\"centerboxtext\">";
    if( $val > 0 ) {
        echo "<a href=\"listusers.php?val=0\">|&lt&lt</a>";
    }
    else echo "&nbsp;";
    echo "</td><td width=\"50%\" align=\"center\" class=\"centerboxtext\">";
    if( $lastrec > 0 ) {
        echo "<a href=\"listusers.php?val=$lastrec\">&gt&gt</a>";
    } else echo "&nbsp;";
    echo "</td></tr></table>";

theme_draw_centerbox_close();

draw_footer();
?>
