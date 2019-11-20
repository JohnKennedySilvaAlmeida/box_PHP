<?php
/*
if(!function_exists("ForumSearch_Form")) {
    function ForumSearch_Form() {
        global $forum, $sString, $total, $numpage, $lang;
        echo "<form name=\"searchform\" action=\"forum.php\" method=\"post\">".
                 "<input type=\"hidden\" name=\"forum\" value=\"$forum\">".
                 "<input type=\"text\" name=\"sString\" value=\"$sString\">".
                 "<input type=\"hidden\" name=\"search\" value=\"1\">".
                 "<input type=\"hidden\" name=\"total\" value=\"$total\">".
                 "<input type=\"hidden\" name=\"numpage\" value=\"$numpage\">".
                 "<input type=\"submit\" value=\"".$lang["FORUM_SEARCH"]."\">".
                 "</form>";
    }
}
*/
function forum_write_form( $forum, $page, $msgid, $title_rep = "", $text = "" )
{
	global $config,$lang,$cfg;
	theme_draw_centerbox_open( $lang["FORUM_POST"] );
	if( !($oktopost = ($_SESSION["wt"]["logged"] == true)) ) // only for sure that this is bool
	{
		$oktopost = ($cfg["forum"]["allow_anonymous"] == true);
	}

	if( $oktopost ) {
?>
<a name="write"></a>
<form method="post" action="forum_write.php" name="writeform">
<input type="hidden" value="1" name="forum_submit">
<input type="hidden" value="<?php print $forum; ?>" name="forum">
<input type="hidden" value="<?php print $page; ?>" name="page">
<input type="hidden" value="<?php print $msgid; ?>" name="msgid">
<table border="0" cellspacing="2" cellpadding="0" align="center">
<tr>
	<td colspan=2 class="centerboxtext"><?php print $lang["FORUM_HEADER_TITLE"]; ?><br>
	<input type="text" size=60 maxlength=80 name="title" value="<?php print htmlspecialchars($title_rep); ?>" class="field_textbox"></td>
</tr>
<tr>
	<td colspan=2 class="centerboxtext"><?php print $lang["FORUM_TEXT"]; ?><br>
	<textarea cols="60" rows="10" name="text" class="field_textbox"><?php print htmlspecialchars($text); ?></textarea></td>
</tr>
<tr>
	<td class="centerboxtext"><input type="checkbox" name="parsetext" checked value=1 class="field_checkbox"><?php print $lang["FORUM_PARSE"]; ?></td>
	<td align="right" class="centerboxtext"><input type="submit" value="<?php print $lang["FORUM_SEND"]; ?>" class="button"></td>
</tr>
</table></form>
<?php
	} else {
		echo "<div class=\"error\">".$lang["FORUM_NOT_LOGGED2"]."</div>";
	}
	theme_draw_centerbox_close();
}

/***********************************/

/* -- this goes to parser
function replace_smile($result) {
    global $module_dir;
    $result =  str_replace(":(",'<img src="'.$module_dir.'smile/bad.gif" border="0">',$result);
    $result =  str_replace(":-(",'<img src="'.$module_dir.'smile/bad.gif" border="0">',$result);
    $result =  str_replace("*cool*",'<img src="'.$module_dir.'smile/cool.gif" border="0">',$result);
    $result =  str_replace("*g*",'<img src="'.$module_dir.'smile/grin.gif" border="0">',$result);
    $result =  str_replace("*grr*",'<img src="'.$module_dir.'smile/grr.gif" border="0">',$result);
    $result =  str_replace(":-D",'<img src="'.$module_dir.'smile/laugh.gif" border="0">',$result);
    $result =  str_replace(":D",'<img src="'.$module_dir.'smile/laugh.gif" border="0">',$result);
    $result =  str_replace(":o",'<img src="'.$module_dir.'smile/oh.gif" border="0">',$result);
    $result =  str_replace(":-o",'<img src="'.$module_dir.'smile/oh.gif" border="0">',$result);
    $result =  str_replace(":)",'<img src="'.$module_dir.'smile/smile.gif" border="0">',$result);
    $result =  str_replace(":-)",'<img src="'.$module_dir.'smile/smile.gif" border="0">',$result);
    $result =  str_replace(";)",'<img src="'.$module_dir.'smile/smile2.gif" border="0">',$result);
    $result =  str_replace(";-)",'<img src="'.$module_dir.'smile/smile2.gif" border="0">',$result);
    return $result;
}

function parse_bbcode($text) {
    $text = preg_replace("/\[quote=([^\[]*) date=([^\[]*)\]([^\[]*)\[\/quote\]/i", "<blockquote><span class=\"12px\">\\1 ".FORUM_WROTE." \\2</span><hr>\\3<hr></blockquote>",$text);

    return $text;
}
*/
function getNameById($uid) {
	global $cfg,$lang,$config;
	if ($uid == 0) {
      $author = $cfg["forum"]["anonymous"];
    } else {
      $ret = db_query("SELECT name FROM {$config["prefix"]}_users WHERE uid=$uid");
	  if( $ret && (db_num_rows($ret) == 1) ) $author = db_result($ret);
	  else $author = $lang["FORUM_NOUSER"];
      db_free_result($ret);
    }
    return $author;
}

function forum_user_allowed( $forum ) {
    global $config;
	if( !$_SESSION["wt"]["logged"] ) return false;
    if( check_user_class($config["admmenu"]["Forums"]["class"]) ) {
        return true;
    }
	$stmt = "select count(*) from {$config["prefix"]}_forums_mod where forum=$forum and userid={$_SESSION["wt"]["uid"]} and type='allowed'";
	if( !($ret = db_query($stmt)) ) return false;
	$c = db_result($ret,0,0);
	db_free_result($ret);
	return ($c == 1);
}

function forum_user_moderator( $forum ) {
    global $config;
    if( check_user_class($config["admmenu"]["Forums"]["class"]) ) {
        return true;
    }
	if( !$_SESSION["wt"]["logged"] ) return false;
	$stmt = "select count(*) from {$config["prefix"]}_forums_mod where forum=$forum and userid={$_SESSION["wt"]["uid"]} and type='moderator'";
	if( !($ret = db_query($stmt)) ) return false;
	$c = db_result($ret,0,0);
	db_free_result($ret);
	return ($c == 1);
}

function prepare_quote($text, $author, $date) {
      $text2 = strip_tags($text);
      $text2 = stripslashes($text2);  //To prevent errors: remove all slashes...
      $text2 = ereg_replace("'", "\'", $text2); //... then add slashes before ' -signs
      $text2 = ereg_replace("\n", '\n', $text2);
      $text2 = ereg_replace("\r", '', $text2);
      return "[quote=$author date=".show_date($date).']\n'.$text2.'[/quote]\n';
}
?>
