<?php
require_once("core/main.php");
require_once("modules/news/functions.php");
require_once("core/parser.php");

if( !check_module("news") ) die( "module not enabled" );
$index_page = false;

if( isset($_GET["edit"]) ) $page_name = $lang["NEWS_EDIT_TITLE"];
else if( isset($_GET["new"]) ) $page_name = $lang["NEWS_SUBMIT_TITLE"];
else if( !isset($_POST["form_submit"]) ) $page_name = $lang["NEWS_PENDING_TITLE"];
else $page_name = $lang["NEWS_SUBMIT_TITLE"];

draw_header();
if( !$_SESSION["wt"]["logged"] )
{
    theme_draw_centerbox_open( $lang["NEWS_SUBMIT_TITLE"] );
	print "<span class=\"error\">{$lang["NOT_LOGGED_NEWS"]}</span>";
	theme_draw_centerbox_close();
    draw_footer();
    exit;
}

$error = "";
$rec_sent = false;

if( isset($_GET["edit"]) )
{
    $edit = intval($_GET["edit"]);
    $stmt = "select * from {$config["prefix"]}_news where cod=$edit";
    $ret = db_query( $stmt );
    if(!$ret) $error .= $lang["ERROR_04"]."<br>".db_error();
    else
    {
        $news = db_fetch_array( $ret );
        db_free_result($ret);
        if( !$news ) $error .= "Invalid code<br>";
        else
        {
            if( !check_user_class("admin") )
            {
                // checks if the user owns this news
                if( $news["userid"] != $_SESSION["wt"]["uid"] ) $error .= "This news isn't yours";
            }
        }
    }
    if( strlen($error) == 0 )
    {
        $nw_cod = $news["cod"];
        $nw_date = show_date($news["date"]);
        $nw_userid = $news["userid"];
        $nw_title = $news["title"];
        $nw_image = $news["image"];
        $nw_align = $news["align"];
        $nw_cat = $news["category"];
        $nw_text = $news["text_ori"];
        $nw_full_text = $news["full_text_ori"];
        $nw_active = $news["active"];
        $nw_archived = $news["archived"];
        $nw_action = "edit";
    }
}
else if( isset($_GET["new"]) )
{
    $nw_cod = 0;
    $nw_date = show_date( date("Y-m-d H:i:s"), true );
    $nw_userid = $_SESSION["wt"]["uid"];
    $nw_title = "";
    $nw_image = "none";
    $nw_align = "left";
    $nw_cat = 1;
    $nw_text = "";
    $nw_full_text = "";
    $nw_active = check_user_class("news")?"Y":"N";
    $nw_archived = "N";
    $nw_action = "new";
}
if( isset($_POST["form_submit"]) )
{
	// checar se não está deletando
	if( isset($_POST["delete_news"]) )
	{
		if( !check_user_class("news") ) {
			theme_draw_centerbox_open( $lang["NEWS_SUBMIT_TITLE"] );
			print "<div class=\"error\">{$lang["ERROR_11"]}</div>";
			theme_draw_centerbox_close();
			draw_footer();
			exit;
		}
		$nw_cod = intval($_POST["nw_cod"]);
		$stmt = "DELETE FROM {$config["prefix"]}_news WHERE cod='$nw_cod'";
        $ret = db_query( $stmt );
		if(!$ret)
        {
        	echo $lang["ERROR_04"]."<br>".db_error();
            draw_footer();
            exit;
		} else {
			theme_draw_centerbox_open( $lang["NEWS_EDIT_TITLE"] );
			print $lang["NEWS_DELETED"];
			theme_draw_centerbox_close();
			draw_footer();
			exit;
		}
	}
    // usuário enviou news
    $error = "";
    $nw_cod = intval($_POST["nw_cod"]);
    if( isset($_POST["nw_userid"]) ) $nw_userid = intval($_POST["nw_userid"]);
    else $nw_userid = $_SESSION["wt"]["uid"];
    $nw_date = trim(strip_tags($_POST["nw_date"]));
    $nw_title = trim(strip_tags($_POST["nw_title"]));
    $nw_image = trim(strip_tags($_POST["nw_image"]));
    $nw_align = trim(strip_tags($_POST["nw_align"]));
    $nw_cat = intval($_POST["nw_cat"]);
    $nw_text = trim($_POST["nw_text"]);
    $nw_full_text = trim($_POST["nw_full_text"]);
    if( isset($_POST["nw_active"]) ) $nw_active = ($_POST["nw_active"]=="Y")?"Y":"N";
    else $nw_active = "N";
    if( isset($_POST["nw_archived"]) ) $nw_archived = ($_POST["nw_archived"]=="Y")?"Y":"N";
    else $nw_archived = "N";
    $nw_action = trim(strip_tags($_POST["nw_action"]));
    // if the user isn't the admin or news access
    if( !check_user_class("news") )
    {
        $nw_userid = $_SESSION["wt"]["uid"];
        $nw_date = show_date( date("Y-m-d H:i:s"), true );
        $nw_active = "N";
        $nw_archived = "N";
    }
    if( $nw_action != "new" && $nw_action != "edit" ) $error .= "Invalid action<br>";
    if( strlen($nw_title) <= 0 ) $error .= $lang["ERROR_02"];
    if( strlen($nw_text) <= 0 ) $error .= $lang["ERROR_03"];
    if( $nw_cat <= 0 ) $nw_cat = 1;
	if( $error == "" ) {
		// parse the texts
		$err = "";
		$nw_text_parsed = $nw_text;
		parse_tags3( $nw_text_parsed, $err );
		if( strlen($err) > 0 ) $error .= "Text: ".$lang["ERROR_10"]." - $err<br>";

		if( strlen($nw_full_text) > 0 ) {
			// parse the texts
			$err = "";
			$nw_full_text_parsed = $nw_full_text;
			parse_tags3( $nw_full_text_parsed, $err );
			if( strlen($err) > 0 ) $error .= "Full Text: ".$lang["ERROR_10"]." - $err<br>";
		} else $nw_full_text_parsed = "";
	}
    if( $error == "" )
    {
        if( $nw_action == "new" )
        {
            $stmt = "INSERT into {$config["prefix"]}_news ( date, title, userid, image, align, active, text, text_ori, full_text, full_text_ori, category, archived ) values ";
            $stmt .= sprintf( "('%s','%s',%d,'%s','%s','%s','%s','%s','%s','%s',%d,'%s')",
                addslashes(delmagic(conv_date($nw_date))),
                addslashes(delmagic($nw_title)),
                $nw_userid,
                addslashes(delmagic($nw_image)),
                addslashes(delmagic($nw_align)),
                $nw_active,
                addslashes(delmagic($nw_text_parsed)),
                addslashes(delmagic($nw_text)),
                addslashes(delmagic($nw_full_text_parsed)),
                addslashes(delmagic($nw_full_text)),
                $nw_cat,
                $nw_archived );
        } else {
            // check again if the user owns this news, if he isn't admin
            $stmt = "select userid from {$config["prefix"]}_news where cod=$nw_cod";
            $ret = db_query( $stmt );
            if(!$ret)
            {
                echo $lang["ERROR_04"]."<br>".db_error();
                draw_footer();
                exit;
            }
            $news_cod = db_result( $ret, 0, 0 );
            db_free_result($ret);
            if( !check_user_class("admin") )
            {
                // checks if the user owns this news
                if( $news_cod != $_SESSION["wt"]["uid"] )
                {
                    echo "This news isn't yours";
                    draw_footer();
                    exit;
                }
            }
            $stmt = sprintf( "UPDATE {$config["prefix"]}_news set date='%s', title='%s', userid=%d, image='%s', align='%s', active='%s', text='%s', text_ori='%s', full_text='%s', full_text_ori='%s', category=%d, archived='%s' where cod=$nw_cod",
                addslashes(delmagic(conv_date($nw_date))),
                addslashes(delmagic($nw_title)),
                $nw_userid,
                addslashes(delmagic($nw_image)),
                addslashes(delmagic($nw_align)),
                $nw_active,
                addslashes(delmagic($nw_text_parsed)),
                addslashes(delmagic($nw_text)),
                addslashes(delmagic($nw_full_text_parsed)),
                addslashes(delmagic($nw_full_text)),
                $nw_cat,
                $nw_archived );
        }
        $ret = db_query($stmt);
        if(!$ret) $error .= $lang["ERROR_04"]."<br>".db_error();
    }

    if( $error == "" )
    {
        theme_draw_centerbox_open($lang["NEWS_SUBMIT_DONE"]);
        if( !check_user_class("news") )
        {
            echo $lang["NEWS_SUBMIT_THANKS2"];
            mail($cfg["core"]["mail_admin"], $lang["NEWS_SUBMIT_THANKS_MAIL_TITLE"], $lang["NEWS_SUBMIT_THANKS2_MAIL"],"From: ".$cfg["core"]["mail_admin"]."\n");
        } else echo $lang["NEWS_SUBMIT_DONE"];
        $rec_sent = true;
        // todo: must check if is a new news....
        // db_query( "update {$config["prefix"]}_users set newsposted=newsposted+1 where uid='$nw_userid'" );
        theme_draw_centerbox_close();
    }
}
$list = !(isset($_GET["new"]) || isset($_GET["edit"]) || isset($_POST["form_submit"]));

if( !$rec_sent && (strlen($error) == 0) && !$list )
{
    theme_draw_centerbox_open( $lang["NEWS_SUBMIT_TITLE"] );
    include( "modules/news/newsform.php" );
    theme_draw_centerbox_close();
}

if( $list && check_user_class("admin") )
{
    // list news that are waiting for publsh
    $stmt = "select cod, date, title from {$config["prefix"]}_news where active='N' and archived='N' order by date";
    $ret = db_query( $stmt );
    if( !$ret ) $error .= $lang["ERROR_04"]."<br>".db_error();
    else {
        if( db_num_rows($ret) > 0 )
        {
            draw_lnews_header();
            $item = 0;
            while( $row = db_fetch_array( $ret ) )
            {
                draw_lnews_item( $row, $item++ );
            }
            draw_lnews_footer();
        } else {
			theme_draw_centerbox_open( $lang["NEWS_PENDING"] );
			print $lang["NEWS_PENDING_NONE"];
			theme_draw_centerbox_close();
		}
        db_free_result( $ret );
    }
}

if( strlen($error)>0 )
{
    theme_draw_centerbox_open($lang["ERROR_TITLE"]);
    echo "<span class=\"error\">$error</span>";
    theme_draw_centerbox_close();
}

draw_footer();
?>