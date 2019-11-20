<?php
// functions for messages
require_once( "core/parser.php" );

function draw_umsg_list()
{
    global $config, $lang;
	if( !isset($_GET["folder"]) ) {
		$folder = "inbox";
		$folder_name = $lang["UMSG_FLD_INBOX"];
		$max_rows = 15;
	} else {
		if( $_GET["folder"] == "inbox" ) {
			$folder = "inbox";
			$folder_name = $lang["UMSG_FLD_INBOX"];
			$max_rows = 15;
		} else {
			$folder = "sent";
			$folder_name = $lang["UMSG_FLD_SENT"];
			$max_rows = 30;
		}
	}
	if( isset( $_GET["pag"] ) ) $pag = intval($_GET["pag"]);
	else $pag = 1;
	if( $pag < 1 ) $pag = 1;
	$start_row = ($pag-1)*$max_rows;

	$stmt = "select M.cod, M.date, M.user_from, M.title, M.msg_read, U.name from {$config["prefix"]}_user_msgs M left outer join {$config["prefix"]}_users U on(M.user_from = U.uid) where M.userid='{$_SESSION["wt"]["uid"]}' and M.folder='$folder' order by M.userid, M.date desc limit $start_row, $max_rows";
    $ret = db_query( $stmt );
    $item = 0;
    draw_umsg_header($folder, $folder_name, $pag);
    while( $row = db_fetch_array($ret) )
    {
        draw_umsgitem($row,++$item,$folder,$pag);
    }
    db_free_result($ret);
    draw_umsg_footer( $pag, $folder, $max_rows, ++$item );
    if( $folder == "inbox" ) draw_umsg_form( -1, "", $folder, $pag );
}

function draw_umsg_header( $folder, $folder_name, $pag )
{
	global $lang;
	theme_draw_centerbox_open( $lang["UMSG_HEADER"]." ".$_SESSION["wt"]["name"] );
	if( $folder == "inbox" ) $tofrom = $lang["UMSG_HEADER_1"];
	else $tofrom = $lang["UMSG_SEND_TO"];
?>
<table width="100%" border=0 cellpadding=2 cellspacing=0>
<tr>
	<td class="row0" colspan=3><?php print $folder_name; ?></td>
	<form action="messages.php" name="selfolder" id="selfolder"><td class="row0" align="right"><select name="folder" class="field_listbox" onChange="selfolder.submit();"><option>&nbsp;</option><option value="inbox"><?php print $lang["UMSG_FLD_INBOX"]; ?></option><option value="sent"><?php print $lang["UMSG_FLD_SENT"]; ?></option></select></td></form>
</tr>
<form action="messages.php?<?php print "folder=$folder&pag=$pag"; ?>" method="post">
<input type="hidden" name="delete_submit" value="1">
<tr>
	<td class="rowblank" height="1" width="30"><img src="images/shim.gif" width="26" height="1" alt="" border="0"></td>
	<td class="rowblank" height="1" width="90"><img src="images/shim.gif" width="86" height="1" alt="" border="0"></td>
	<td class="rowblank" height="1" width="60"><img src="images/shim.gif" width="56" height="1" alt="" border="0"></td>
	<td class="rowblank" height="1" width="230"><img src="images/shim.gif" width="226" height="1" alt="" border="0"></td>
</tr>
<tr>
<td class="row0">&nbsp;</td>
<td class="row0"><?php print $tofrom; ?></td>
<td class="row0"><?php print $lang["UMSG_HEADER_3"]; ?></td>
<td class="row0"><?php print $lang["UMSG_HEADER_2"]; ?></td>
</tr>
<?php
}

function draw_umsgitem(&$row,$item,$folder,$pag)
{
	global $lang, $config;
	$item = ($item % 2)+1;
	$title = $row["title"];
	if( strlen($title)>30 ) $title = substr($title,0,30)."...";
	echo "<tr>"
		."<td class=\"row{$item}\"><input type=\"checkbox\" name=\"del_message[]\" value=\"{$row["cod"]}\""
		." class=\"field_checkbox\"></td>"
		."<td class=\"row{$item}\">"
		."<a href=\"user.php?uid={$row["user_from"]}\">{$row["name"]}</a></td>"
		."<td class=\"row{$item}\">".show_date($row["date"],false)."</td>"

		."<td class=\"row{$item}\">";
	if( $row["msg_read"] == 0 ) echo "<b>";
	echo "<a href=\"messages.php?msg={$row["cod"]}&folder=$folder&pag=$pag\">$title</a>";
	if( $row["msg_read"] == 0 ) echo "</b>";
	echo "</td>";
}

function draw_umsg_footer( $pag, $folder, $max_rows, $item )
{
	global $lang, $config;
	
	$stmt = "select count(*) from {$config["prefix"]}_user_msgs where userid='{$_SESSION["wt"]["uid"]}' and folder='$folder'";
    $ret = db_query( $stmt );
	$tot_rows = db_result( $ret, 0, 0 );
	db_free_result($ret);
	$tot_pag = ceil($tot_rows / $max_rows);
	$item = ($item % 2)+1;
?>
<tr>
	<td class="row<?php print $item; ?>" colspan=4><table width="100%" border=0 cellpadding=2 cellspacing=0>
		<tr>
		<td width="80%" class="row<?php print $item; ?>"><input type="submit" name="submit" value="<?php print $lang["UMSG_DELETE_MSG"]; ?>" class="button"></td>
		<td class="row<?php print $item; ?>"><?php
	if( $pag > 1 ) {
		echo "<a href=\"messages.php?folder=$folder&pag=1\">|&lt;</a>&nbsp;";
		echo "<a href=\"messages.php?folder=$folder&pag=".($pag-1)."\">&lt;&lt;</a>";
	} else echo "|&lt;&nbsp;&lt;&lt;";
	echo "&nbsp;&nbsp;";
	if( $pag < $tot_pag ) {
		echo "<a href=\"messages.php?folder=$folder&pag=".($pag+1)."\">&gt;&gt;</a>&nbsp;";
		echo "<a href=\"messages.php?folder=$folder&pag=$tot_pag\">&gt;|</a>";
	} else echo "&gt;&gt;&nbsp;&gt;|";
?></td>
		</tr>
	</table></td>
	</form>
</tr>
</table>
<?php
    theme_draw_centerbox_close();
}

function draw_umsg_form( $user_to, $msg_title, $folder, $pag )
{
    global $config, $lang;
    if( $user_to > 0 )
    {
        $button = $lang["UMSG_SEND_BUTTON_R"];
        $title_box = $lang["UMSG_REPLY"];
    } else {
        $button = $lang["UMSG_SEND_BUTTON_S"];
        $title_box = $lang["UMSG_SEND"];
    }
    theme_draw_centerbox_open( $title_box );
    echo "<table border=0 cellspacing=0 cellpadding=2><tr><td class=\"centerboxtext\">";
    echo "<form action=\"messages.php?folder=$folder&pag=$pag\" method=\"post\">";
    if( $user_to <= 0 )
    {
        echo $lang["UMSG_SEND_TO"].":&nbsp;<select name=\"msg_to\">";
        $ret = db_query( "select B.*, U.name from {$config["prefix"]}_user_book B left outer join {$config["prefix"]}_users U on (B.cod_user = U.uid) where B.userid = {$_SESSION["wt"]["uid"]} order by U.name" );
        while( $row=db_fetch_array($ret) )
        {
            echo "<option value=\"".$row["cod_user"]."\" class=\"field_listbox\">".$row["name"]."</option>";
        }
        db_free_result( $ret );
        echo "</select>&nbsp;".$lang["UMSG_SEND_ADD_USER"];
    } else {
        echo "<input type=\"hidden\" name=\"msg_to\" value=\"$user_to\">";
    }
    if( $user_to != -1 ) $msg_title = "Re: ".$msg_title;
    echo "<br>".$lang["UMSG_SEND_TITLE"]."<br>
    <input type=\"hidden\" name=\"msg_submit\" value=\"1\">
    <input type=\"text\" name=\"msgtitle\" size=60 maxlength=80 class=\"field_textbox\" value=\"$msg_title\"><br>"
    .$lang["UMSG_SEND_TEXT"]."<br>
    <textarea cols=60 rows=10 name=\"msgtext\" class=\"field_textbox\"></textarea><br>
    <input type=\"submit\" name=\"submit_msg\" class=\"button\" value=\"$button\">
    </form></td></tr></table>";
    theme_draw_centerbox_close();
}

function draw_umsg()
{
    global $config,$lang;
	if( !isset($_GET["msg"]) ) return;
	$msg = intval($_GET["msg"]);
	if( $msg <= 0 ) return;
	$stmt = "select M.*, U.name from {$config["prefix"]}_user_msgs M left outer join {$config["prefix"]}_users U on(M.user_from = U.uid) where M.userid='{$_SESSION["wt"]["uid"]}' and M.cod='$msg' order by M.userid, M.date desc";
	if( !($ret = db_query($stmt)) ) return;
	$row = db_fetch_array($ret);
	db_free_result($ret);
	if( !$row ) return;
	
	if( $row["folder"] == "inbox" ) {
		$folder_name = $lang["UMSG_FLD_INBOX"];
		$tofrom = $lang["UMSG_HEADER_1"];
	} else {
		$folder_name = $lang["UMSG_FLD_SENT"];
		$tofrom = $lang["UMSG_SEND_TO"];
	}
	
	if( !isset($_GET["folder"]) ) $folder = "inbox";
	else {
		if( $_GET["folder"] == "inbox" ) $folder = "inbox";
		else $folder = "sent";
	}
	if( isset( $_GET["pag"] ) ) $pag = intval($_GET["pag"]);
	else $pag = 1;
	if( $pag < 1 ) $pag = 1;
	theme_draw_centerbox_open( $lang["UMSG_HEADER"]." ".$_SESSION["wt"]["name"] );
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<form action="messages.php?<?php print "folder=$folder&pag=$pag"; ?>" method="post">
<input type="hidden" name="delete_submit" value="1">
<tr>
	<td class="row0" colspan=2><?php print $folder_name; ?></td>
</tr>
<tr>
	<td class="row1" width="320" valign="top"><?php print "<b>$tofrom:</b> "."<a href=\"user.php?uid={$row["user_from"]}\">{$row["name"]}</a>"; ?></td>
	<td class="row1" width="120" align="right" valign="top"><?php print "<b>".$lang["UMSG_HEADER_3"].":</b> ".show_date($row["date"]); ?></td>
</tr>
<tr>
	<td class="row1" colspan=2><?php print "<b>".$lang["UMSG_HEADER_2"].":</b> ".$row["title"]; ?></td>
</tr>
<tr>
	<td class="row2" colspan=2><?php print $row["text"]; ?></td>
</tr>
<tr>
	<td class="row1" colspan=2 align="right"><input type="checkbox" name="del_message[]" value="<?php print $row["cod"]; ?>" class="field_checkbox"><input type="submit" name="submit" value="<?php print $lang["UMSG_DELETE_MSG2"]; ?>" class="button"></td>
</tr>
</form>
</table>	
<hr>
<?php
    print "<a href=\"messages.php?folder=$folder&pag=$pag\">".$lang["UMSG_BACK"]."</a><br>";
	theme_draw_centerbox_close();
	$stmt = "update {$config["prefix"]}_user_msgs set msg_read=1 where userid='{$_SESSION["wt"]["uid"]}' and cod='$msg'";
	$ret = db_query($stmt);
	if( $row["folder"] == "inbox" ) draw_umsg_form( $row["user_from"], $row["title"], $folder, $pag );
}

function process_umsg()
{
	global $config, $lang;
	$msgtitle = delmagic( strip_tags(trim($_POST["msgtitle"])) );
	$msgtext = delmagic( trim($_POST["msgtext"]) );
	$msg_to = intval($_POST["msg_to"]);
	if( strlen($msgtitle) <= 0 || strlen($msgtext) <= 0 ) {
		print $lang["UMSG_SEND_ERROR_01"];
		return;
	}
	if( $msg_to <= 0 ) {
		print $lang["UMSG_SEND_ERROR_02"];
		return;
	}
	// parse the text
	$msgtext_ori = $msgtext;
	$err = "";
	parse_tags3( $msgtext, $err );
	if( strlen($err) > 0 ) {
		echo "<span class=\"error\">{$lang["ERROR_10"]} $err</span>";
		return;
	}
	$now = date( "Y-m-d H:i" );
	// send the message
	$stmt = "insert into {$config["prefix"]}_user_msgs(userid,folder,date,user_from,title,text) values";
	$stmt .= sprintf( "(%d, '%s', '%s', %d, '%s', '%s')",
		$msg_to,
		"inbox",
		$now,
		$_SESSION["wt"]["uid"],
		addslashes($msgtitle),
		addslashes($msgtext)
	);
	if(!db_query($stmt)) {
		print db_error();
		return;
	}
	
	// save a copy at sent box
	$stmt = "insert into {$config["prefix"]}_user_msgs(userid,folder,date,user_from,title,text) values";
	$stmt .= sprintf( "(%d, '%s', '%s', %d, '%s', '%s')",
		$_SESSION["wt"]["uid"],
		"sent",
		$now,
		$msg_to,
		addslashes($msgtitle),
		addslashes($msgtext)
	);
	if(!db_query($stmt)) {
		print db_error();
		return;
	}
	
	// mail user
	// todo: mail user
	echo "<div class=\"info\" align=\"center\">".$lang["UMSG_SENT"]."<br><br></div>";
}
?>