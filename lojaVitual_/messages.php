<?php
include_once("core/main.php");
include_once("modules/messages/functions.php");
if( !check_module("messages") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["UMSG_TITLE"];
$sitemap[] = array($lang["UMSG_TITLE"], "messages.php");
draw_header();

if( !$_SESSION["wt"]["logged"] )
{
	theme_draw_centerbox_open( $lang["UMSG_TITLE"] );
	print "<span class=\"error\">".$lang["NOT_LOGGED_UMSG"]."</span>";
	theme_draw_centerbox_close();
	draw_footer();
	exit;
}

if( isset($_POST["delete_submit"]) && isset($_POST["del_message"]) ) {
	reset($_POST["del_message"]);
	$msgs = array();
	while( $k = each($_POST["del_message"]) ) $msgs[] = intval($k[1]);
	
	reset($msgs);
	while( $k = each($msgs) ) {
		if( $k[1] <= 0 ) continue;
		$stmt = "delete from {$config["prefix"]}_user_msgs where userid='{$_SESSION["wt"]["uid"]}' and cod={$k[1]}";
		$ret = db_query($stmt);
	}
} else if( isset($_POST["msg_submit"]) ) {
	process_umsg();
}

if( isset($_GET["msg"]) ) draw_umsg();
else draw_umsg_list();

draw_footer();
?>