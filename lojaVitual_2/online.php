<?php
include_once("core/main.php");

$index_page = false;
$page_name = $lang["USERS_ONLINE"];
$sitemap[] = array($lang["USERS_ONLINE"], "online.php");
draw_header();

if( !$_SESSION["wt"]["logged"] )
{
    theme_draw_centerbox_open( $lang["USERS_ONLINE"] );
    echo "<span class=\"error\">".$lang["NOT_LOGGED_ONLINE"]."</span>";
    theme_draw_centerbox_close();
} else {
    theme_draw_centerbox_open( $lang["USERS_ONLINE"] );
    // Paulo: using distinct don't duplicate names
    // I didn't try to alter saving all sessions because the same user may have more than 1 session opened
    $ret = db_query( "select distinct O.uid, U.name from {$config["prefix"]}_online O left outer join {$config["prefix"]}_users U on ( O.uid = U.uid ) where O.uid > 0" );

    $col = 0;
    echo "<table width=\"100%\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\">"
        ."<tr>";
    while( $row = db_fetch_array($ret) )
    {
        if( $col == 0 ) echo "<tr>";
        echo "<td class=\"centerboxtext\" width=\"25%\">";
        echo "<a href=\"user.php?uid={$row["uid"]}\">".$row["name"]."</a>";
        echo "</td>\n";
        $col++;
        if( $col > 3 ) {
            echo "</tr>\n";
            $col = 0;
        }
    }
    if( $col > 0 ) {
        echo "<td class=\"centerboxtext\" colspan=".(3-$col+1).">&nbsp;</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
    theme_draw_centerbox_close();
}

draw_footer();
?>