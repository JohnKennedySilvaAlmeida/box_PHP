<?php
// Thanks to Abu Mami <admin@abumami.com> for this module
include_once("core/main.php");
include_once("modules/contact/functions.php");
if( !check_module("contact") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["CONTACT_TITLE"];
$sitemap[] = array($lang["CONTACT_TITLE"], "contact.php");

draw_header();

$msgemail = "";
$msgtitle = "";
$msgtext = "";
$sendok = false;
$mailsent = false;

if( !isset( $_SESSION["wt"]["contact"] ) ) $_SESSION["wt"]["contact"] = false;

if ( isset($_POST["msg_submit"]) ) {
	if( !$_SESSION["wt"]["contact"] ) {
		$msgtitle = delmagic(strip_tags(trim($_POST["msgtitle"])));
		$msgtext  = delmagic(strip_tags(trim($_POST["msgtext"])));
		if ( strlen($msgtitle) >= 1 || strlen($msgtext) >= 1 ) {
			if( $_SESSION["wt"]["logged"] ) {
				$username  = $_SESSION["wt"]["name"];
				$q = db_query("SELECT email FROM {$config["prefix"]}_users WHERE uid='{$_SESSION["wt"]["uid"]}'");
				$useremail = db_result($q, 0, 0);
				$headers   = "From: " . $username . " <" . $useremail . ">\n";
				$sendok = true;
			} else {
				// validate the user supplied email address
				$msgemail = strip_tags(trim($_POST["contact_email"]));
				if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$", $msgemail)) {
					theme_draw_centerbox_open( $lang["ERROR_TITLE"] );
					echo $lang["CONTACT_SEND_ERROR_02"];
					theme_draw_centerbox_close();
				} else {
					$headers  = "From: " . $msgemail . "\n";
					$sendok = true;
				}
			}
		} else {
			theme_draw_centerbox_open( $lang["ERROR_TITLE"] );
			echo $lang["CONTACT_SEND_ERROR_01"];
			theme_draw_centerbox_close();
		}
		if( $sendok ) {
			theme_draw_centerbox_open( $lang["CONTACT_SEND"] );
			$mailsent = contact_send( $msgtitle, $msgtext, $headers );
			theme_draw_centerbox_close();
		}
	} else {
		$mailsent = true;
	}
}

if( !$mailsent ) draw_contact( $msgemail, $msgtitle, $msgtext );
draw_footer();
?>