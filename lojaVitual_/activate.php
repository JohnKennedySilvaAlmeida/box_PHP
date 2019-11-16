<?php
include_once("core/main.php");

$index_page = false;
$page_name = $lang["ACTIVATE_TITLE"];

draw_header();
if( isset($_GET["name"]) && isset($_GET["sess"]) ) {
    $name = delmagic(trim(strip_tags($_GET["name"])));
    $sess = delmagic(trim(strip_tags($_GET["sess"])));
	if( strlen($name) <= 0 || strlen($sess) <= 0 ) die("Invalid parameters");
	$ret = db_query("select uid from {$config["prefix"]}_users where name='".addslashes($name)."' and session='".addslashes($sess)."' and active='N'");
	if( db_num_rows($ret) == 1 ) $uid = db_result($ret,0,0);
	else $uid = 0;
	db_free_result($ret);

	if($uid > 0) {
		db_query("update {$config["prefix"]}_users set active='Y', dateactivated=NOW() where uid='$uid'") or die(db_error());
		theme_draw_centerbox_open( $lang["ACTIVATE_TITLE"] );
		echo $lang["NEWUSER_ACTIVATED"]."<br><br>".$cfg["core"]["name_admin"];

		//send e-mail to admin
		if( $cfg["core"]["mail_new_user"] ) mail( $cfg["core"]["mail_admin"],
			sprintf( $lang["NEWUSER_MAIL_TITLE"], $cfg["core"]["title"] ),
			"A user has activated his account:\n\nuser: $name",
			"From: ".$cfg["core"]["mail_admin"]."\n");
		theme_draw_centerbox_close();
		db_query("insert into {$config["prefix"]}_user_book( userid, cod_user ) values ( $uid, 1 )");
	} else {
		theme_draw_centerbox_open( $lang["ACTIVATE_TITLE"] );
        print "<span class=\"error\">".$lang["NEWUSER_ACTIVATE_ERROR"]."</span>";
        theme_draw_centerbox_close();
	}
}
else if( isset($_GET["name"]) && isset($_GET["nesess"]) ) {
    $name = delmagic(trim(strip_tags($_GET["name"])));
    $nesess = delmagic(trim(strip_tags($_GET["nesess"])));
	if( strlen($name) <= 0 || strlen($nesess) <= 0 ) die("Invalid parameters");
	$ret = db_query("select uid from {$config["prefix"]}_users where name='".addslashes($name)."' and newemailsess='".addslashes($nesess)."' and active='Y'");
	if( db_num_rows($ret) == 1 ) $uid = db_result($ret,0,0);
	else $uid = 0;
	db_free_result($ret);

	if($uid > 0)
	{
		db_query("update {$config["prefix"]}_users set email=newemail, newemailsess='' where uid='$uid'") or die(db_error());
		theme_draw_centerbox_open( $lang["MYACCT_EMAIL_CHANGED_TITLE"] );
		print $lang["MYACCT_EMAIL_CHANGED_OK"]."<br><br>";

		//send e-mail to admin
		if( $cfg["core"]["mail_new_user"] ) mail( $cfg["core"]["mail_admin"],
			$lang["MYACCT_EMAIL_CHANGED_TITLE"]." (".$cfg["core"]["title"].")",
			"A user changed his e-mail:\n\nuser: $name",
			"From: ".$cfg["core"]["mail_admin"]."\n");
		theme_draw_centerbox_close();
	} else {
		theme_draw_centerbox_open( $lang["MYACCT_EMAIL_CHANGED_TITLE"] );
        print "<span class=\"error\">".$lang["MYACCT_EMAIL_CHANGED_ERROR"]."</span>";
        theme_draw_centerbox_close();
	}
}
draw_footer();
?>