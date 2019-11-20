<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

function forum_list_forums() {
	global $config, $sitemap, $lang, $cfg;
	$stmt = "SELECT cod, title, descr, locked FROM {$config["prefix"]}_forums ORDER BY cod;";
	if (!($ret = db_query($stmt))) {
		echo $lang["ERROR_04"].": ".db_error();
		return;
	}

	theme_draw_centerbox_open( $lang["FORUM_TITLE"] );
	//ForumSearch_Form();
	Forum_list_header();

	$n = 0;
	while( $forum = db_fetch_array($ret) ) {
		$stmt = "SELECT SUM(IF(msg_ref > 0, 0, 1)) AS tnb, COUNT(*) AS mnb, MAX(date) AS ldate FROM {$config['prefix']}_forum_msgs WHERE forum={$forum["cod"]};";
		if( !($ret2 = db_query($stmt)) ) {
			print $lang["ERROR_04"].":".db_error();
			theme_draw_centerbox_close();
			return;
		}
		$fcount = db_fetch_array($ret2);
		db_free_result($ret2);

		$rclass = sprintf( "row%d", ($n++ % 2)+1 );
		if( $fcount["tnb"] > 0 ) {
			$stmt = "SELECT userid FROM {$config['prefix']}_forum_msgs WHERE forum={$forum["cod"]} AND date='{$fcount["ldate"]}';";
			if( $ret2 = db_query($stmt) ) {
				if( db_num_rows($ret2) > 0 ) $user = db_result($ret2,0,0);
				else $user = 0;
				$author = getNameById($user);
				db_free_result($ret2);
			} else {
				$author = "***";
			}
		} else $author = "";
		if( ($forum["locked"] != 'Y') || $cfg["forum"]["show_locked_forums"] || (forum_user_allowed($forum["cod"])) ) {
			$pic = 'folder.gif';
			if ($forum["locked"] == 'Y') {
				$pic = 'folder_locked.gif';
			}
			forum_list_item( $forum["cod"], $forum["title"], $forum["descr"], $fcount["tnb"], $fcount["mnb"], $rclass, $fcount["ldate"], $author, $pic);
		}
	}
	db_free_result($ret);
	ForumList_Footer();

	theme_draw_centerbox_close();
}

function forum_list_header()
{
	global $lang;
?>
<table width="100%" cellspacing="01" cellpadding="1" border=0>
<tr>
	<td width="16" height="1"><img src="images/shim.gif" width="16" height="1" alt="" border="0"></td>
	<td width="100%" height="1"><img src="images/shim.gif" width="1" height="1" alt="" border="0"></td>
	<td width="50" height="1"><img src="images/shim.gif" width="50" height="1" alt="" border="0"></td>
	<td width="50" height="1"><img src="images/shim.gif" width="50" height="1" alt="" border="0"></td>
	<td width="100" height="1"><img src="images/shim.gif" width="100" height="1" alt="" border="0"></td>	
</tr>
<tr>
	<td class="row0">&nbsp;</td>
	<td class="row0"><?php print $lang["FORUM_HEADER_TITLE"]; ?></td>
	<td align="right" class="row0"><?php print $lang["FORUM_HEADER_TOPICS"]; ?></td>
	<td align="right" class="row0"><?php print $lang["FORUM_HEADER_POSTS"]; ?></td>
	<td align="center" class="row0"><?php print $lang["FORUM_HEADER_LASTPOST"]; ?></td>
</tr>
<?php
}

function forum_list_item( $cod, $title, $descr, $tnb, $mnb, $class, $ldate, $author, $pic ) {
	global $lang;
	echo "<tr><td class=\"$class\" align=\"center\"><img src=\"modules/forum/images/$pic\" border=0></td>"
		."<td class=\"$class\"><a href=\"forum.php?forum=$cod\"><b>$title</b></a>";
	if( $tnb <= 0 ) $date = "&nbsp;";
	else $date = show_date($ldate,true)."<br>$author";
	echo "<td class=\"$class\" align=\"right\">$tnb</td>"
		."<td class=\"$class\" align=\"right\">$mnb</td>"
		."<td class=\"$class\" align=\"center\" rowspan=2 valign=\"top\">$date</td>"
		."</tr>\n";
	echo "<tr><td class=\"$class\" colspan=4>$descr</td></tr>";
}

function ForumList_Footer() {
	echo "</table>";
}

?>