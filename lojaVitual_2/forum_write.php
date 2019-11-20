<?php
require_once("core/main.php");
require_once("modules/forum/functions.php");

$index_page = false;

$sitemap[] = array($lang["FORUM_TITLE"], "forum.php");

draw_header();
if( !$_SESSION["wt"]["wroteforum"] ) {
	if( isset($_POST["forum_submit"]) ) {
		require("modules/forum/write.php");
		if( !forum_write_message() ) {
			forum_write_form(
				intval($_POST["forum"]),
				intval($_POST["page"]),
				intval($_POST["msgid"]),
				trim(delmagic($_POST["title"])),
				trim(delmagic($_POST["text"]))
			);
		}
	}
}
draw_footer();
?>
