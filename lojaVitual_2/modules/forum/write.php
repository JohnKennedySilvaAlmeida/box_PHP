<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
require_once( "core/parser.php" );

function forum_write_message()
{
	global $cfg,$lang,$config;
	if( !isset($_POST["forum_submit"]) ) return;

	// see if user is logged or allow anonymous is enabled
	if( !$_SESSION["wt"]["logged"] ) {
		if( !$cfg["forum"]["allow_anonymous"] ) {
			print "<div class=\"error\">".$lang["FORUM_NOT_LOGGED"]."</div>";
			return;
		}
		$userid = 0;
	} else $userid = $_SESSION["wt"]["uid"];

	$forum = intval($_POST["forum"]);
	$page = intval($_POST["page"]);
	$msgid = intval($_POST["msgid"]);
	
	$title = htmlspecialchars(trim(delmagic($_POST["title"])));
	$text_ori = trim(delmagic($_POST["text"]));
	$parsetext = (isset($_POST["parsetext"]) && ($_POST["parsetext"]==1));
	
	// checks if user posted all fields
	if( empty($title) || empty($text_ori) ) {
		print "<div class=\"error\">".$lang["FORUM_ERROR_01"]."</div>";
		return;
	}
	
	// if the user checked parsetext, try to parse the text
	if( $parsetext ) {
		$text = $text_ori;
		$err = "";
		parse_tags3( $text, $err );
		if( !empty($err) ) {
			echo "<span class=\"error\">{$lang["ERROR_10"]} $err</span>";
			return;
		}
	} else {
		$text = htmlspecialchars($text_ori);
	}

	if( $msgid > 0 ) {
		if( !forum_check_msg_locked_access( $msgid, $forum ) ) return;
		// if this is a child of a message, loads the main message and its forum
	} else {
		// load the forum to see if it's locked
		if( !forum_check_forum_locked_access( $forum ) ) return;
	}

	if( check_module("censor") ) {
		$title = censor_string($title);
		$text = censor_string($text);
	}

	$current_date = date("Y-m-d H:i:s");

	$stmt = "INSERT INTO {$config["prefix"]}_forum_msgs ( forum, msg_ref, date, date_der, userid, title, text, text_ori )";
	$stmt .= sprintf( " VALUES ( %d, %d, '%s', '%s', %d, '%s', '%s', '%s' )",
		$forum,
		$msgid,
		$current_date,
		$current_date,
		$userid,
		addslashes($title),
		addslashes($text),
		addslashes($text_ori)
	);
	if( !($ret = db_query($stmt)) )
	{
		print $lang["ERROR_04"].": ".db_error();
		return;
	}
	$ret = db_query( "SELECT LAST_INSERT_ID()" );
	$lmsgid = db_result($ret, 0, 0);
	db_free_result($ret);
	if( $msgid > 0 ) {
		$stmt = "UPDATE {$config["prefix"]}_forum_msgs SET date_der = '$current_date' WHERE cod = $msgid";
		$ret = db_query($stmt);
		if( !($ret = db_query($stmt)) )
		{
			print $lang["ERROR_04"].": ".db_error();
			return;
		}
	}
	if( !$_SESSION["wt"]["logged"] ) {
		$stmt = "UPDATE {$config["prefix"]}_users SET topicsposted = topicsposted + 1 where uid={$_SESSION["wt"]["uid"]}";
		$ret = db_query($stmt);
		if( !($ret = db_query($stmt)) )
		{
			print $lang["ERROR_04"].": ".db_error();
			return;
		}
	}

	theme_draw_centerbox_open( $lang["FORUM_MSG_POSTED"] );
	if( $msgid <= 0 ) $msgid = $lmsgid;
	print "<br><br><a href=\"forum.php?forum=$forum&page=$page\">{$lang["FORUM_MSG_OPTION1"]}</a><br><br>"
		."<a href=\"forum.php?forum=$forum&page=$page&msg=$msgid#anch$lmsgid\">{$lang["FORUM_MSG_OPTION2"]}</a>"
		."<br><br>";
	$_SESSION["wt"]["wroteforum"]=true;
	theme_draw_centerbox_close();
	return true;
}

function forum_check_msg_locked_access( $msgid, $forum )
{
	global $config, $lang;
	$stmt = "select m.cod, m.msg_ref, m.closed, f.locked from {$config["prefix"]}_forum_msgs m left outer join {$config["prefix"]}_forums f on (m.forum=f.cod) where m.cod = $msgid and forum=$forum";
	if( !($ret = db_query($stmt)) ) {
		print $lang["ERROR_04"].": ".db_error();
		return false;
	}
	$topic = db_fetch_array($ret);
	db_free_result($ret);
	if( !$ret ) {
		print "<span class=\"error\">topic not found</div>";
		return false;
	}
	// checks if this is a valid topic, ie. msg_ref == 0
	if( $topic["msg_ref"] != 0 ) {
		print "<span class=\"error\">invalid topic for posting a message</div>";
		return false;
	}
	// check if this topic is closed
	if( $topic["closed"] == "Y" ) {
		print "<span class=\"error\">{$lang["FORUM_CLOSED"]}</div>";
		return false;
	}
	if( $topic["locked"]=="Y" ) return forum_user_allowed( $forum );
	else return true;
}

function forum_check_forum_locked_access( $forum )
{
	global $config, $lang;
	$stmt = "select locked from {$config["prefix"]}_forums where cod = $forum";
	if( !($ret = db_query($stmt)) ) {
		print $lang["ERROR_04"].": ".db_error();
		return false;
	}
	$flock = db_fetch_array($ret);
	db_free_result($ret);
	if( !$ret ) {
		print "<span class=\"error\">forum not found</div>";
		return false;
	}
	if( $flock["locked"]=="Y" ) return forum_user_allowed( $forum );
	else return true;
}
?>