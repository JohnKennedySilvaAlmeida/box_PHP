<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");


function forum_list_messages()
{
	global $config,$lang,$cfg;
	if( !isset( $_GET["msg"] ) ) return;
	$msgid = intval($_GET["msg"]);

	$page = 0;
	if( isset($_GET["page"]) ) $page = intval($_GET["page"]);
	if( $page <= 0 ) $page = 1;

	// load main message
	$stmt = "SELECT m.cod, m.msg_ref, m.forum, m.closed, m.title, f.title as forum_title FROM {$config["prefix"]}_forum_msgs m LEFT OUTER JOIN {$config["prefix"]}_forums f ON (m.forum=f.cod) WHERE m.cod=$msgid";
	if (!($ret = db_query($stmt))) {
		echo $lang["ERROR_04"].": ".db_error();
		return;
	}
	$topic = db_fetch_array($ret);
	db_free_result($ret);
	
	if( !$topic ) {
		print "Topic not found.";
		return;
	}
	if( $topic["msg_ref"] != 0 ) {
		print "Invalid topic.";
		return;
	}

	//ForumSearch_Form();
	theme_draw_centerbox_open( $lang["FORUM_TITLE"]." - ".$topic["forum_title"] );

	print "<table width=\"100%\" cellspacing=2 cellpadding=2 border=0>";

	$stmt = "SELECT cod, title, closed, userid, date, text FROM {$config["prefix"]}_forum_msgs WHERE cod=$msgid OR msg_ref=$msgid AND forum={$topic["forum"]} ORDER BY date ".($cfg["forum"]["newest_first"] ? "DESC" : "ASC");
	if( !($ret = db_query($stmt)) ) {
		echo $lang["ERROR_04"].": ".db_error();
		print "</table>";
		theme_draw_centerbox_close();
		return;
	}
	$n = 0;
	while( $message = db_fetch_array($ret) ) {
		forum_entry_item( $message["title"], $message["userid"], $message["date"], $message["text"], ($n++%2)+1, $message["cod"]);
	}
	print "</table><br>";
	print "<a href=\"forum.php?forum={$topic["forum"]}&page=$page\">{$lang["FORUM_GOUP"]}</a><br>";
	theme_draw_centerbox_close();

	// Update the number of views:
	db_query("UPDATE wt_forum_msgs SET views=views+1 WHERE cod=$msgid");
	if( $topic["closed"] != "Y" ) forum_write_form( $topic["forum"], $page, $msgid, "Re: ".$topic["title"] );
}


function forum_entry_item( $title, $uid, $date, $text, $class, $msgid )
{
	global $cfg,$config,$lang;

	if( $uid == 0 ) {
		$author = $cfg["forum"]["anonymous"];
		$avatar = "";
	} else {
		$ret2 = db_query("SELECT name, avatar FROM {$config["prefix"]}_users WHERE uid=$uid");
		if( $ret2 && (db_num_rows($ret2) == 1) ) {
			$author = db_result($ret2,0,0);
			$avatar = db_result($ret2,0,1);
		} else {
			$author = $lang["FORUM_NOUSER"];
			$avatar = "";
		}
		db_free_result($ret2);
	}

	if( $_SESSION["wt"]["logged"] || $cfg["forum"]["allow_anonymous"] ) {
		$text2 = prepare_quote($text, $author, $date);
	} else {
		$text2 = "";
	}
//	$text = parse_bbcode($text);
	//if($smileys == 'Y') $text = replace_smile($text);

	if ( check_user_class($config["admmenu"]["Forum Topics"]["class"]) ) {
		$admin_link = "<br><a href=\"adm_forum_topics.php?adm_sel=".$msgid."\" class=\"ForumItemPanelLink\">{$lang["FORUM_EDIT"]}</a>";
	} else {
		$admin_link = "";
	}

	if( !empty($title) ) {
		print "<tr><td class=\"ForumItemTitle\" colspan=2><b>"
			."<span class=\"ForumItemTitleText\">$title</span></b></td></tr>";
	}
	print "<tr><td class=\"ForumItemPanel$class\" valign=\"top\" width=\"110\"><a name=\"anch$msgid\"></a>"
		.show_date($date)."<br><br>";
	if( $uid > 0 ) print "<a href=\"user.php?uid={$uid}\" class=\"ForumItemPanelLink\">";
	print $author."<br>";
	if( $cfg["core"]["avatars"] && $avatar != "" ) {
		print "<img src=\"{$cfg["core"]["avatars_folder"]}/$avatar\" alt=\"$author\" width=100 height=100 border=0>"
			."<br><br>";
	} else {
		print "<br>";
	}
	if( $uid > 0 ) print "</a>";
	if( $_SESSION["wt"]["logged"] || $cfg["forum"]["allow_anonymous"] )
		print "<a href=\"#write\" onClick=\"writeform.text.value+='$text2';\" class=\"ForumItemPanelLink\">".$lang["FORUM_QUOTE"]."</a>";
	print $admin_link."</td>"
		."<td class=\"ForumItemPanel$class\" valign=\"top\">$text</td></tr>"
		."<tr><td colspan=2 class=\"ForumItemGap\"><img src=\"modules/forum/images/blank.gif\" width=1 height=3>"
		."</td></tr>";
}
?>