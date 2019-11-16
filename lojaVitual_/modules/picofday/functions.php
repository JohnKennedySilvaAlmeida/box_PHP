<?php
// functions for picofday
if( check_module("comments") )
{
    include_once( "modules/comments/functions.php" );
}

function draw_picofday_card( $picture )
{
    global $config, $lang, $cfg;
    $picture = intval($picture);
    $ret = db_query("select P.*, U.name as username from {$config["prefix"]}_picofday P left outer join {$config["prefix"]}_users U on (P.userid=U.uid) where id='$picture'");
    $row = db_fetch_array( $ret );
    db_free_result($ret);
    if( $row["big_picture"] != "none" ) $picture_img = $row["big_picture"];
    else $picture_img = $row["small_picture"];

    theme_draw_centerbox_open( $lang["PICOFDAY_TITLE"] );
    echo "<table border=0 cellpadding=2 cellspacing=0 width=\"100%\">"
        ."<tr><td class=\"picofdaytitle\" align=center height=20 colspan=4>{$row["description"]}</td></tr>"
        ."<tr><td class=\"picofdaydescr\" align=center colspan=4><img src=\"modules/picofday/images/$picture_img\" border=0></td></tr>";
    if( !empty($row["full_description"]) ) echo "<tr><td class=\"picofdaydescr\"  colspan=4>{$row["full_description"]}</td></tr>";
    echo "<tr><td class=\"picofdayfooter\" width=\"34%\">{$lang["PICOFDAY_BY"]} <a href=\"user.php?uid={$row["userid"]}\" class=\"picofdayfooterlink\">{$row["username"]}</a></td>"
        ."<td class=\"picofdayfooter\" width=\"33%\" align=center>{$lang["PICOFDAY_VIEWS"]} {$row["views"]}</td><td class=\"picofdayfooter\" width=\"33%\" align=right>{$lang["PICOFDAY_CLICKS"]} {$row["clicks"]}</td></tr>";
	echo "<tr><td class=\"rowblank\" align=\"center\" colspan=4><a href=\"picofday.php?cat={$row["category"]}\">{$lang["PICOFDAY_GOUP"]}</a></td></tr>";

    echo "</table>";
    theme_draw_centerbox_close();
    db_query( "update {$config["prefix"]}_picofday set clicks=clicks+1 where id='{$row["id"]}'" );
    // only if the pic is the pic of the day it will increment
	if( !$cfg["picofday"]["picofpage"] )
	    db_query( "update {$config["prefix"]}_picofdaysel set clicks=clicks+1 where date='{$_SESSION["wt"]["pictureofday_date"]}' and picture_id='{$row["id"]}'" );
    if( check_module("comments") )
    {
        process_comments( 4, $row["id"] );
        draw_comments( 4, $row["id"], "picofday.php?pic={$row["id"]}" );
    }
}

function draw_picofday_list()
{
    global $config, $lang;
	
	$cat = intval($_GET["cat"]);
	$ret = db_query("select id, name, description from {$config["prefix"]}_picofdaycat where id='$cat'");
	$category = db_fetch_array($ret);
	db_free_result($ret);
	if( !$category ) {
	    theme_draw_centerbox_open( $lang["PICOFDAY_TITLE"] );
		print "<div class=\"error\">{$lang["PICOFDAY_NOCAT"]}</div>";
		theme_draw_centerbox_close();
		return;
	}
	
	theme_draw_centerbox_open( $lang["PICOFDAY_TITLE"]." - ".$category["name"] );
    echo "{$category["description"]}<br><table border=0 cellpadding=0 cellspacing=0 width=\"100%\">";

    $ret = db_query("select id, description, small_picture from {$config["prefix"]}_picofday where category='$cat' order by clicks desc");
    $col=0;
    while($row=db_fetch_array($ret))
    {
        if( $col==0 ) print "<tr>\n";
        print "<td align=center class=\"centerboxtext\"><a href=\"picofday.php?pic={$row["id"]}\"><img src=\"modules/picofday/images/{$row["small_picture"]}\" border=0  hspace=2 vspace=2 alt=\"{$lang["PICOFDAY_CLICK"]}\"><br>{$row["description"]}</a></td>\n";
        $col++;
        if( $col>2 )
        {
            $col=0;
            print "</tr>\n";
        }
    }
    if( $col != 0 ) print "<td colspan=".(3-$col)." class=\"centerboxtext\">&nbsp;</td>\n</tr>\n";
	print "<tr align=\"center\"><td colspan=3 class=\"centerboxtext\"><a href=\"picofday.php\">{$lang["PICOFDAY_GOUP"]}</a></td></tr>\n";
    print "</table>";
    db_free_result($ret);
    theme_draw_centerbox_close( );
}

function draw_picofday_catlist()
{
    global $config, $lang;
    theme_draw_centerbox_open( $lang["PICOFDAY_TITLE"] );
    echo $lang["PICOFDAY_DESC"]."<table border=0 cellpadding=0 cellspacing=0 width=\"100%\">";

    $ret = db_query("select count(*) as qtde, p.category, c.name, c.description from {$config["prefix"]}_picofday p left outer join {$config["prefix"]}_picofdaycat c on (p.category=c.id) group by p.category order by c.name");
    while($row=db_fetch_array($ret))
    {
		print "<tr><td colspan=2 class=\"row1\"><a href=\"picofday.php?cat={$row["category"]}\">{$row["name"]}</a></td>"
			."<td align=right width=50 class=\"row1\">{$row["qtde"]}</td></tr>"
			."<tr><td width=25 class=\"row2\">&nbsp;</td><td class=\"row2\">{$row["description"]}</td><td width=50 class=\"row2\">&nbsp;</td></tr>";
    }
    echo "</table>";
    db_free_result($ret);
    theme_draw_centerbox_close( );
}
?>