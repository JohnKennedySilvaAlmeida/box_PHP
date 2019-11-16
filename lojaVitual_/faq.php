<?php
require_once("core/main.php");
require_once("modules/faqs/functions.php");
require_once( "core/parser.php" );

$index_page = false;
$page_name = $lang["FAQ_TITLE"];
$sitemap[] = array($lang["FAQ_TITLE"], "faq.php");
draw_header();

if( isset($_POST["faq_topic"]) && $_SESSION["wt"]["logged"] )
{
	// usuário enviou faq
	$error = "";
	$faq_topic = intval($_POST["faq_topic"]);
	$faq_question = trim(delmagic($_POST["faq_question"]));
	$faq_answer = trim(delmagic($_POST["faq_answer"]));

	if( strlen($faq_question) <= 0 ) $error .= $lang["FAQ_ERROR_02"];
	if( strlen($faq_answer) <= 0 ) $error .= $lang["FAQ_ERROR_03"];
	if( $faq_topic <= 0 ) $error .= $lang["FAQ_ERROR_04"];
	if( empty($error) ) {
		$err = "";
		$faq_question_ori = $faq_question;
		parse_tags3( $faq_question, $err );
		if( !empty($err) ) {
			$error .=  "faq_question: {$lang["ERROR_10"]} $err<br>";
			return;
		}
		$err = "";
		$faq_answer_ori = $faq_answer;
		parse_tags3( $faq_answer, $err );
		if( !empty($err) ) {
			$error .=  "faq_answer: {$lang["ERROR_10"]} $err<br>";
			return;
		}
	}
	if( empty($error) )
	{
		if( check_user_class("post_faq") ) $active = "Y";
		else $active = "N";
		$stmt = "INSERT into {$config["prefix"]}_faq (topic,uid,active,question,question_ori,answer,answer_ori) values ";
		$stmt .= sprintf( "( %d, %d, '%s', '%s', '%s', '%s', '%s' )",
			$faq_topic,
			$_SESSION["wt"]["uid"],
			$active,
			addslashes($faq_question),
			addslashes($faq_question_ori),
			addslashes($faq_answer),
			addslashes($faq_answer_ori)
		);
		$ret = db_query($stmt);
		if(!$ret) $error .= $lang["ERROR_04"]."<br>";
	}
	if( empty($error) )
	{
		theme_draw_centerbox_open( $lang["FAQ_SUBMIT_DONE_TITLE"] );
		print $lang["FAQ_SUBMIT_THANKS"];
		db_query( "update {$config["prefix"]}_users set faqposted=faqposted+1 where uid='{$_SESSION["wt"]["uid"]}'" );
		theme_draw_centerbox_close();
		print "<br>";
		$email = $cfg["core"]["mail_admin"];
		$headers ="From: $email\n"
			."X-Sender: <$email>\n"
			."X-Mailer: PHP\n"
			."Return-Path: <$email>\n";
		mail( $email, $lang["FAQ_SUBMIT_MAIL_TITLE"], $lang["FAQ_SUBMIT_MAIL"], $headers );
	} else {
		theme_draw_centerbox_open( $lang["ERROR_TITLE"] );
		echo "<span class=\"error\">$error</span>";
		theme_draw_centerbox_close();
	}
}

if( !isset($_GET["topic"]) ) draw_faq_list_topics();
else draw_faq_list();

draw_footer();
?>