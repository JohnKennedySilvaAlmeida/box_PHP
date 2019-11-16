<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

function forum_list_topics()
{
	global $config, $lang, $cfg;
	if( !isset($_GET["forum"]) ) return;
	$forum_cod = intval($_GET["forum"]);
	
	$page = 0;
	if( isset($_GET["page"]) ) $page = intval($_GET["page"]);
	if( $page <= 0 ) $page = 1;
	
	$stmt = "select * from {$config["prefix"]}_forums where cod=$forum_cod";
	if( !($ret = db_query($stmt)) ) {
		print $lang["ERROR_04"].": ".db_error();
		return;
	}
	$forum = db_fetch_array($ret);
	db_free_result($ret);
	if( !$forum ) return;
	
	// if this is a private forum, lets see if the user has the permission
	if( $forum["locked"] == "Y" ) {
		if( !forum_user_allowed( $forum["cod"] ) ) {
			print "<span class=\"error\">{$lang["FORUM_LOCKED"]}</div>";
			return;
		}
	}
	theme_draw_centerbox_open( $lang["FORUM_TITLE"]." - ".$forum["title"] );

	$stmt = "SELECT cod, title, userid, date, views, closed FROM {$config["prefix"]}_forum_msgs WHERE msg_ref = 0 AND forum = {$forum["cod"]} order by date_der desc";
	switch ( $config["dbtype"] ) {
		case "mysql":
			$stmt .= " LIMIT ".(($page-1)*$cfg["forum"]["nbmess"]).", ".$cfg["forum"]["nbmess"];
			break;
		case "pgsql":
			$stmt .= " LIMIT ".$cfg["forum"]["nbmess"]." OFFSET ".(($page-1)*$cfg["forum"]["nbmess"]);
	}
	if( !$ret = db_query($stmt) ) {
		print $lang["ERROR_04"].": ".db_error();
		theme_draw_centerbox_close();
		return;
	}

	forum_topics_header();
	$ntopics = 0;
	while( $topic = db_fetch_array($ret) ) {
	
		$stmt = "SELECT COUNT(*) AS qtde FROM {$config['prefix']}_forum_msgs WHERE msg_ref={$topic["cod"]}";
		if( !($ret2 = db_query($stmt)) ) {
			print $lang["ERROR_04"].":".db_error();
			theme_draw_centerbox_close();
			return;
		}
		$tcount = db_result($ret2,0,0);
		db_free_result($ret2);
		
		if( $tcount > 0 ) {
			$stmt = "SELECT userid, date FROM {$config['prefix']}_forum_msgs WHERE msg_ref={$topic["cod"]} order by date desc limit 0,1";
			if( !($ret2 = db_query($stmt)) ) {
				print $lang["ERROR_04"].":".db_error();
				theme_draw_centerbox_close();
				return;
			}
			$lmsg = db_fetch_array($ret2);
			db_free_result($ret2);
		} else {
			$lmsg = array( "userid"=>$topic["userid"], "date"=>$topic["date"] );
		}

		$author = getNameById($lmsg["userid"]);
		if( $topic["closed"] == "Y" ) $pic = "modules/forum/images/folder_locked.gif";
		else $pic = "modules/forum/images/folder.gif";
		$class = sprintf( "class=\"row%d\"", ($ntopics++%2)+1 );
		print "<tr><td align=\"center\" $class><img src=\"$pic\" border=\"0\" alt=\"\"></td>"
			."<td $class>"
			."<a href=\"forum.php?forum={$forum["cod"]}&page=$page&msg={$topic["cod"]}\">{$topic["title"]}</a>"
			."</td>"
			."<td align=\"right\" valign=\"top\" $class>{$topic["views"]} / {$tcount["qtde"]}</td>"
			."<td align=\"right\" valign=\"top\" $class>".show_date($lmsg["date"],true)."<br>";
		if( $lmsg["userid"] > 0 ) {
			print "<a href=\"user.php?uid={$lmsg["userid"]}\">$author</a>";
		} else {
			print "$author";
		}
		print "</td></tr>";
	}
	db_free_result($ret);
	forum_topics_footer();

    //Calculating the number of pages
	$stmt = "select count(*) from {$config["prefix"]}_forum_msgs where msg_ref=0 and forum={$forum["cod"]}";
	if( !($ret = db_query($stmt)) ) {
		print $lang["ERROR_04"].": ".db_error();
		return;
	}
	$total = db_result($ret,0,0);
	db_free_result($ret);
	
	echo "<br><table width=80 border=0 cellspacing=0 cellpadding=2 align=\"center\"><tr>";
	if( $page > 1 ) {
		print "<td width=20 align=\"center\">"
			."<a href=\"forum.php?forum={$forum["cod"]}&page=1\"><img src=\"modules/forum/images/navbar_r1_c1.png\" width=16 height=16 alt=\"\" border=0></a></td>"
			."<td width=20 align=\"center\">"
			."<a href=\"forum.php?forum={$forum["cod"]}&page=".($page-1)."\"><img src=\"modules/forum/images/navbar_r1_c2.png\" width=16 height=16 alt=\"\" border=0></a></td>";
	} else {
		print "<td width=20 align=\"center\"><img src=\"modules/forum/images/navbar_r1_c1.png\" width=16 height=16 alt=\"\" border=0></td>"
			."<td width=20 align=\"center\"><img src=\"modules/forum/images/navbar_r1_c2.png\" width=16 height=16 alt=\"\" border=0></td>";	
	}

	$lpage = ceil($total / $cfg["forum"]["nbmess"]);
	if( $page < $lpage ) {
		print "<td width=20 align=\"center\">"
			."<a href=\"forum.php?forum={$forum["cod"]}&page=".($page+1)."\"><img src=\"modules/forum/images/navbar_r1_c3.png\" width=16 height=16 alt=\"\" border=0></a></td>"
			."<td width=20 align=\"center\">"
			."<a href=\"forum.php?forum={$forum["cod"]}&page=$lpage\"><img src=\"modules/forum/images/navbar_r1_c4.png\" width=16 height=16 alt=\"\" border=0></a></td>";
	} else {
		print "<td width=20 align=\"center\"><img src=\"modules/forum/images/navbar_r1_c3.png\" width=16 height=16 alt=\"\" border=0></td>"
			."<td width=20 align=\"center\"><img src=\"modules/forum/images/navbar_r1_c4.png\" width=16 height=16 alt=\"\" border=0></td>";	
	}
	print "</tr></table>";
	print "<a href=\"forum.php\">{$lang["FORUM_GOUP"]}</a><br>";
	theme_draw_centerbox_close();
	forum_write_form( $forum["cod"], $page, 0, "" );
}

function forum_topics_header()
{
	global $lang;
?>
<table width="100%" cellspacing="0" cellpadding="2" border=0>
<tr>
	<td width="16" height="1"><img src="images/shim.gif" width="16" height="1" alt="" border="0"></td>
	<td width="100%" height="1"><img src="images/shim.gif" width="200" height="1" alt="" border="0"></td>
	<td width="40" height="1"><img src="images/shim.gif" width="40" height="1" alt="" border="0"></td>
	<td width="100" height="1"><img src="images/shim.gif" width="100" height="1" alt="" border="0"></td>	
</tr>
<tr>
	<td class="row0">&nbsp;</td>
	<td class="row0"><?php print $lang["FORUM_HEADER_TOPICS"]; ?></td>
	<td class="row0" align="right"><?php print $lang["FORUM_HEADER_VR"]; ?></td>
	<td class="row0" align="right"><?php print $lang["FORUM_HEADER_LASTPOST"]; ?></td>
</tr>
<?php
}

function forum_topics_footer()
{
	echo "</table>";
}
?>