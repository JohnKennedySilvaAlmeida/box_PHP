<?php
// functions for module news
// include it only when it's necesary
// ie: when using draw_news() and draw_news_full()

// if modules comments is enabled, include its functions here
if( check_module("comments") )
{
    include_once( "modules/comments/functions.php" );
}

function draw_news($athome=false, $cat=-1, $archived=false)
{
    global $config, $lang, $cfg;
    $s_arch = $archived?"Y":"N";
    if( isset($_GET["page"]) ) $page = intval($_GET["page"]);
    else $page = 0;
    if( $cat != -1 )
    {
        $stmt = "select N.*, C.name as cat_name, C.image as cat_image, C.name as cat_name, U.name as user_name from {$config["prefix"]}_news N left outer join {$config["prefix"]}_users U on (N.userid=U.uid) left outer join {$config["prefix"]}_newscat C on (N.category=C.cod) where N.active='Y' and N.archived='$s_arch' and N.category='$cat' order by date DESC";
        $stmt2 = "select count(*) from {$config["prefix"]}_news where active='Y' and archived='$s_arch' and category='$cat'";
    } else {
        $stmt = "select N.*, C.name as cat_name, C.image as cat_image, C.name as cat_name, U.name as user_name from {$config["prefix"]}_news N left outer join {$config["prefix"]}_users U on (N.userid=U.uid) left outer join {$config["prefix"]}_newscat C on (N.category=C.cod) where N.active='Y' and N.archived='$s_arch' order by date DESC";
        $stmt2 = "select count(*) from {$config["prefix"]}_news where active='Y' and archived='$s_arch'";
        if($athome) $stmt .= " limit 0,".$cfg["news"]["max_at_index"];
        else $stmt .= " limit ".($cfg["news"]["max_per_page"]*$page).",".$cfg["news"]["max_per_page"];
    }
    $ret = db_query($stmt2);
    $totnews = db_result( $ret, 0, 0 );
    db_free_result($ret);
    $ret = db_query($stmt);
    while($row = db_fetch_array($ret))
    {
        $full_text = ( strlen($row["full_text"]) > 0 );
        if( check_user_class("admin") ) $edit = true;
        else if( $row["userid"] == $_SESSION["wt"]["uid"] ) $edit = true;
        else $edit = false;
        echo "<table width=\"95%\" border=0 cellpadding=2 cellspacing=0 class=\"newsexttable\" align=\"center\">"
            ."<tr class=\"newstitle\"><td class=\"newstitle\" colspan=2><span class=\"newsdate\">".show_date($row["date"])." -</span>&nbsp;<a href=\"news.php?cod={$row["cod"]}\" class=\"newstitlelink\">{$row["title"]}</a></td></tr>"
            ."<tr class=\"newspostedby\"><td class=\"newspostedby\" colspan=1>".$lang["NEWS_POSTED_BY"]." <a href=\"user.php?uid={$row["userid"]}\" class=\"newspostedbylink\">{$row["user_name"]}</a></td><td class=\"newspostedby\" align=\"right\">";
        echo "<a href=\"news.php?cat={$row["category"]}\" class=\"newspostedbylink\">".$lang["NEWS_SAME_CAT"]." ({$row["cat_name"]})</a></td></tr>"
            ."<tr class=\"newstext1\"><td class=\"newstext1\" colspan=2>"
            ."<table width=\"100%\" border=0 cellpadding=2 cellspacing=0>"
            ."<tr class=\"newstext1\"><td class=\"newstext1\" width=80>";
        if(strlen($row["cat_image"])>0 && $row["cat_image"]!="none") echo "<img src=\"modules/news/cat_images/{$row["cat_image"]}\" border=0 alt=\"{$row["cat_name"]}\">";
        else echo "&nbsp;";
        echo "</td><td class=\"newstext1\">{$row["text"]}</td></tr></table></td></tr>";
        echo "<tr><td class=\"newsfooter\">";
	    if( check_module("comments") )
        {
            $num_comments = num_comments( 1, $row["cod"] );
            echo "<a href=\"news.php?cod={$row["cod"]}\" class=\"newsfooterlink\"><img src=\"images/show_comments.png\" border=0 width=16 height=16 align=left> $num_comments ".$lang["COMMENTS_NUM"]."</a>";
        }
        else echo "&nbsp;";
        echo "</td><td class=\"newsfooter\" align=\"right\">";
        if( $edit ) echo "<a href=\"adm_news2.php?edit={$row["cod"]}\" class=\"newsfooterlink\">".$lang["NEWS_EDIT"]."</a>&nbsp;&nbsp;";
        if($full_text) echo "<a href=\"news.php?cod={$row["cod"]}\" class=\"newsfooterlink\">".$lang["NEWS_CLICK_MORE"]."</a>";
        else echo "&nbsp;";
        echo "</td></tr></table><br>";
    }
    echo "<table width=\"70%\" border=0 cellpadding=2 cellspacing=0 align=\"center\"><tr>";
    echo "<td width=\"33%\" align=\"left\">";
    if( $page > 0 ) {
        echo "<a href=\"news.php?cat=$cat";
        if( $archived ) echo "&archived=1";
        echo "&page=".($page-1)."\">&lt;&lt;</a>";
    }
    else echo "&nbsp;";
    echo "</td><td width=\"34%\" align=\"center\">";
    if( !$archived ) echo "<a href=\"news.php?cat=$cat&archived=1\">".$lang["NEWS_ARCHIVED"]."</a>";
    else echo "&nbsp;";
    echo "</td><td width=\"33%\" align=\"right\">";
    if( (($page+1)*$cfg["news"]["max_per_page"])  < $totnews ) {
        echo "<a href=\"news.php?cat=$cat";
        if( $archived ) echo "&archived=1";
        echo "&page=".($page+1)."\">&gt;&gt;</a>";
    } else echo "&nbsp;";
    echo "</td></tr></table>";
    db_free_result($ret);
}

function draw_news_full($cod)
{
    global $config, $lang;
    $cod=intval($cod);
    $stmt = "select N.*, C.name as cat_name, C.image as cat_image, C.name as cat_name, U.name as user_name from {$config["prefix"]}_news N left outer join {$config["prefix"]}_users U on (N.userid=U.uid) left outer join {$config["prefix"]}_newscat C on (N.category=C.cod) where N.active='Y' and N.cod='$cod'";
    $ret = db_query( $stmt );
    $row = db_fetch_array( $ret );
    db_free_result( $ret );

    echo "<table width=\"95%\" border=0 cellpadding=2 cellspacing=0 class=\"newsexttable\" align=\"center\">"
        ."<tr><td class=\"newstitle\" colspan=2><span class=\"newsdate\">".show_date($row["date"])." -</span>&nbsp;{$row["title"]}</td></tr>"
        ."<tr><td class=\"newspostedby\" colspan=1>".$lang["NEWS_POSTED_BY"]." <a href=\"user.php?uid={$row["userid"]}\" class=\"newspostedbylink\">{$row["user_name"]}</a></td><td class=\"newspostedby\" align=\"right\"><a href=\"news.php?cat={$row["category"]}\" class=\"newspostedbylink\">".$lang["NEWS_SAME_CAT"]."</a></td></tr>"
        ."<tr><td class=\"newstext1\" colspan=2>"
        ."<table width=\"100%\" border=0 cellpadding=2 cellspacing=0>"
        ."<tr><td class=\"newstext1\" width=80>";
    if(strlen($row["cat_image"])>0 && $row["cat_image"]!="none") echo "<img src=\"modules/news/cat_images/{$row["cat_image"]}\" border=0 alt=\"{$row["cat_name"]}\">";
    else echo "&nbsp;";
    echo "</td><td class=\"newstext1\">{$row["text"]}</td></tr></table></td></tr>";
    echo "<tr><td class=\"newsgap\" colspan=2 height=1><img src=\"images/shim.gif\" width=1 height=1 alt=\"\" border=0></td></tr>";
    echo "<tr><td class=\"newstext2\" colspan=2>";
    if( $row["image"]!="none" ) echo "<img src=\"modules/news/images/{$row["image"]}\" border=0 alt=\"\" align=\"{$row["align"]}\">";
    echo "{$row["full_text"]}</td></tr></table><br>";

    if( check_module("comments") )
    {
        process_comments( 1, $cod );
        draw_comments( 1, $cod, "news.php?cod=$cod" );
    }
    db_query( "update {$config["prefix"]}_news set counter=counter+1 where cod='$cod'" );
}

function draw_lnews_header()
{
    global $lang;
    theme_draw_centerbox_open( $lang["NEWS_PENDING"] );
    echo "<table width=\"100%\" border=0 cellpadding=2 cellspacing=0>";
}

function draw_lnews_item(&$row,$item)
{
    global $config;
    $item = ($item % 2)+1;
    echo "<tr><td class=\"row{$item}\"><span class=\"row{$item}\">"
        ."<a href=\"adm_news2.php?edit={$row["cod"]}\">".show_date($row["date"])." - {$row["title"]}</a></span></td></tr>\n";
}

function draw_lnews_footer()
{
    echo "</table>";
    theme_draw_centerbox_close();
}
?>