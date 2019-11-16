<?
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class("admin") ) exit;

$index_page = false;
$page_name = "Sendmail";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();

theme_draw_centerbox_open($page_name);

if( isset($_POST["snd_submit"]) )
{
	if( isset($_POST["snd_news"]) && $_POST["snd_news"]==1 ) $snd_news = 1;
	else $snd_news=0;
	if( isset($_POST["snd_frel"]) && $_POST["snd_frel"]==1 ) $snd_frel = 1;
	else $snd_news=0;
	
	if( !$snd_news && !$snd_frel ) {
		print "Select at least one of the options to send e-mail.";
		theme_draw_centerbox_close();
		draw_footer();
		exit;
	}
	$snd_start = intval($_POST["snd_start"]);
	$snd_text = trim(delmagic($_POST["snd_text"]));

	$stmt = "select name, realname, email from {$config["prefix"]}_users";
	$stmt_where = " where active='Y' and (";
	if( $snd_news ) $stmt_where .= " receivenews = 'Y'";
	if( $snd_frel ) {
		if( $snd_news ) $stmt_where .= " or ";
		$stmt_where .= " receiverel = 'Y'";
	}
	$stmt_where .= ")";
	$stmt .= $stmt_where." limit $snd_start, ".intval($cfg["core"]["sendmail_qtde"]);
	
	$stmt2 = "select count(*) from {$config["prefix"]}_users".$stmt_where;
	$ret = db_query($stmt2) or die(db_error());
	$snd_tot = db_result($ret,0,0);
	db_free_result($ret);
	print "<b>Total: </b>".$snd_tot."<br><hr>";
	
	$ret = db_query($stmt) or die(db_error());

	$i = 0;
	while( $row = db_fetch_array($ret) ) {
		print $row["realname"]." - ".$row["email"]." - ";
		
		$emailadm = $cfg["core"]["mail_admin"];
		$headers ="From: $emailadm\n"
			."X-Sender: <$emailadm>\n"
			."X-Mailer: PHP\n"
			."Return-Path: <$emailadm>\n";
		$mail = sprintf( $lang["SENDMAIL_MSG_HDR"], $row["realname"] );
		$mail .= $snd_text;
		$mail .= sprintf( $lang["SENDMAIL_MSG_FTR"], $cfg["core"]["name_admin"], $cfg["core"]["title"], $emailadm );
		if( mail($row["email"],$cfg["core"]["title"], $mail, $headers) ) print $lang["SENDMAIL_MAIL_SENT"]."<br>";
		else print $lang["ERROR_TITLE"]."<br>";
		++$i;
	}
	db_free_result($ret);
	$snd_more = $snd_tot - ($snd_start+$i);
	print "<br><hr><br><b>E-mails sent: ".$i."<br>"
		."Total sent: ".($snd_start+$i)."<br>"
		."E-mails to send: ".$snd_more."<br>";
	if( $snd_more > 0 ) {
	
		print "<form method=post action=\"adm_sendmail.php\">\n"
			."<input type=\"hidden\" name=\"snd_submit\" value=\"1\">\n"
			."<input type=\"hidden\" name=\"snd_start\" value=\"".($snd_start+$i)."\">\n"
			."<input type=\"hidden\" name=\"snd_news\" value=\"$snd_news\">\n"
			."<input type=\"hidden\" name=\"snd_frel\" value=\"$snd_frel\">\n"
			."<input type=\"hidden\" name=\"snd_text\" value=\"".htmlspecialchars($snd_text)."\">\n"
			."<input type=\"submit\" name=\"submit\" class=\"button\" value=\"{$lang["SENDMAIL_CONTINUE"]}\">\n"
			."</form>";
	}
} else {
?>
<form method=post action="adm_sendmail.php">
<?php print $lang["SENDMAIL_ACCTO"]; ?><br>
<input type="hidden" name="snd_submit" value="1">
<input type="hidden" name="snd_start" value="0">
<input type="checkbox" name="snd_news" class="field_checkbox" value="1"><?php print $lang["SENDMAIL_ACCNEWS"]; ?><br>
<input type="checkbox" name="snd_frel" class="field_checkbox" value="1"><?php print $lang["SENDMAIL_ACCFREL"]; ?><br>


<?php print $lang["SENDMAIL_TEXT"]; ?>:<br>
<textarea cols="40" rows="6" name="snd_text" class="field_textbox"></textarea><br>
<input type="Submit" name="submit"  class="button" value="<?php print $lang["SENDMAIL_SUBMIT"]; ?>">
</form>

<?php
}
theme_draw_centerbox_close();
draw_footer();
?>