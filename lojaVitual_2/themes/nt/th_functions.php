<?php
include( "themes/nt/main.php" );

function draw_menu()
{
    global $config;
    $arr_menu = $config["menu"];
    ksort($arr_menu, SORT_NUMERIC);
    reset($arr_menu);

    theme_draw_leftbox_open( "Menu" );
    while( $entry = each( $arr_menu ) )
    {
		if( $entry[1]["type"] != "A" ) {
			if( $entry[1]["type"] == "L" ) {
				if( !$_SESSION["wt"]["logged"] ) continue;
			} else if(  $entry[1]["type"] == "N" ) {
				if( $_SESSION["wt"]["logged"] ) continue;
			}
		}
        echo theme_draw_menu_item( $entry[1]["title"], $entry[1]["file"] );
    }
    theme_draw_leftbox_close();
}

function theme_draw_map()
{
    global $sitemap;
    echo "<table border=0 width=\"100%\" cellpadding=2 cellspacing=0><tr><td class=\"navbar\">";
    foreach($sitemap as $item) {
        echo "&gt; <a href=\"$item[1]\" class=\"navbarlink\">$item[0]</a> ";
    }
    echo "</td></tr></table>\n";
}
?>