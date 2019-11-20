<?php
// functions for comments
require_once( "core/parser.php" );

function num_comments( $type, $link )
{
    global $config;
    $stmt = "select count(cod) from {$config["prefix"]}_comments where link='$link' and type='$type'";
    $ret2 = db_query($stmt);
    $num_comments = db_result($ret2,0,0);
    db_free_result($ret2);
    return $num_comments;
}

function draw_comments_item( &$row, $action )
{
  echo "<tr><td class=\"rowpostedby\">";
  if( check_user_class( "admin" ) )
  {
      if( (strpos($action, "?")) > 0 ) $del = $action . "&del_comment={$row["cod"]}";
    else $del = $action . "?del_comment={$row["cod"]}";

    echo "<a href=\"$del\"><img src=\"images/del.png\" width=8 height=8 border=0 align=right></a>";
  }
  echo show_date($row["date"])."&nbsp;-&nbsp;<a href=\"user.php?uid={$row["userid"]}\" class=\"rowpostedbylink\">{$row["name"]}</a></td></tr>"
      ."<tr><td class=\"centerboxtext\">".$row["comment"]
      ."</td></tr>\n"
      ."<tr><td class=\"rowblank\">&nbsp;</td></tr>\n";
}

function draw_comments_form( $type, $link, $action )
{
	global $lang;
    theme_draw_centerbox_open( $lang["COMMENTS_FORM_TITLE"] );
    if( $_SESSION["wt"]["logged"] )
    {
?>
<table border=0 cellspacing=0 cellpadding=2>
	<tr>
		<td class="centerboxtext">
		<form method="post" action="<?php print $action; ?>">
		<input type=hidden name="rem_type" value="<?php print $type; ?>">
		<input type=hidden name="rem_link" value="<?php print $link; ?>">
		<?php print $lang["COMMENTS_FIELD"]; ?><br>
		<textarea cols=60 rows=10 name="rem_text" wrap class="field_textbox"></textarea><br><br>
	    <input type=submit name="submit_rem" class="button" value="<?php print $lang["COMMENTS_POST"]; ?>">
		</form></td>
	</tr>
</table>
<?php
    } else {
        echo "<div align=\"center\" class=\"error\">{$lang["NOT_LOGGED_COMMENTS"]}</div>";
    }
    theme_draw_centerbox_close();
}

function draw_comments( $type, $link, $action )
{
    global $del_comment, $config, $lang;
    //$type: 1 - news
    //       2 - polls
    //         3 - downloads
    //         4 - picofday
    //         5 - articles
    $ret = db_query( "select C.*, U.name from {$config["prefix"]}_comments C left outer join {$config["prefix"]}_users U on (C.userid=U.uid) where type=$type and link=$link order by date DESC" );
    if( !$ret ) {
		print db_error();
		return;
	}
    if( db_num_rows( $ret ) > 0 )
    {
        theme_draw_centerbox_open( $lang["COMMENTS_TITLE"] );
        echo "<table width=\"100%\" border=0 cellpadding=2 cellspacing=0>";
        while( $row = db_fetch_array( $ret ) )
        {
            draw_comments_item( $row, $action );
        }
        echo "</table>";
        theme_draw_centerbox_close();
    }
    db_free_result($ret);
    draw_comments_form( $type, $link, $action );
}

function process_comments( $type, $link )
{
	global $lang, $config;
	if( isset($_POST["rem_type"]) )
	{
		if( !$_SESSION["wt"]["logged"] ) return;
		$rem_type = intval( $_POST["rem_type"] );
		$rem_link = intval( $_POST["rem_link"] );
		$rem_text = trim( delmagic($_POST["rem_text"]) );

		if( check_module("censor") ) $rem_text = censor_string($rem_text);

		// Only to double check for parameters
		if( $rem_type != $type || $rem_link != $link ) return;
		if( strlen( $rem_text ) <= 0 ) {
			echo "<span class=\"error\">{$lang["ERROR_03"]}</span>";
			return;
		}

		// parse the comment
		$err = "";
		parse_tags3( $rem_text, $err );
		if( strlen($err) > 0 ) {
			echo "<span class=\"error\">{$lang["ERROR_10"]} $err</span>";
			return;
		}
		$stmt = "insert into {$config["prefix"]}_comments ( type, link, date, userid, comment ) values "
			."( $rem_type, $rem_link, NOW(), {$_SESSION["wt"]["uid"]}, '".addslashes($rem_text)."' )";
		$ret = db_query( $stmt );
		if( $ret ) {
			echo "<span class=\"info\">{$lang["COMMENTS_ADDED"]}</span>";
			db_query( "update {$config["prefix"]}_users set commentsposted=commentsposted+1 where uid='{$_SESSION["wt"]["uid"]}'" );
		} else echo "<span class=\"error\">{$lang["ERROR_04"]}</span>";
	}

    if( isset( $_GET["del_comment"] ) )
    {
        $del_comment = intval( $_GET["del_comment"] );
        if( !check_user_class("admin") ) return;
        $stmt = "delete from {$config["prefix"]}_comments where cod=$del_comment";
        $ret = db_query( $stmt );
        if( $ret ) echo "<span class=\"info\">{$lang["COMMENTS_DELETED"]}</span>";
        else echo "<span class=\"error\">{$lang["ERROR_04"]}</span>";
    }
}
?>