<?php
require_once("core/main.php");
require_once("modules/forum/functions.php");

$index_page = false;

$sitemap[] = array($lang["FORUM_TITLE"], "forum.php");

draw_header();
$_SESSION["wt"]["wroteforum"]=false;
if( isset($_GET["msg"]) ) {
	require("modules/forum/messages.php");
	forum_list_messages();
} else if( isset($_GET["forum"]) ) {
	require("modules/forum/topics.php");
	forum_list_topics();
} else {
	require("modules/forum/list.php");
	forum_list_forums();
}
draw_footer();
?>
