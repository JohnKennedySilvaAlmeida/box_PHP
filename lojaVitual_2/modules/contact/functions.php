<?php
// functions for contact

function draw_contact( $email, $title, $text )
{
    global $config, $lang;
	$_SESSION["wt"]["contact"] = false;
    theme_draw_centerbox_open( $lang["CONTACT_SEND"] );
?>
<table border=0 cellspacing=0 cellpadding=2 width="100%">
<tr>
	<td class="centerboxtext"><form action="contact.php" method="post">
<?php
	if( !$_SESSION["wt"]["logged"] ) {
		echo "<br>{$lang["CONTACT_NOT_LOGGED"]}<br>"
			."<input type=\"text\" name=\"contact_email\" size=60 maxlength=80 class=\"field_textbox\" value=\"".htmlspecialchars($email)."\"><br>";
	}
?>
    <br><?php print $lang["CONTACT_SEND_TITLE"]; ?><br>
    <input type="hidden" name="msg_submit" value="1">
    <input type="text" name="msgtitle" size=60 maxlength=80 value="<?php print htmlspecialchars($title); ?>" class="field_textbox">
	<br><?php print $lang["CONTACT_SEND_TEXT"]; ?><br>
    <textarea cols=60 rows=10 name="msgtext" class="field_textbox"><?php print htmlspecialchars($text); ?></textarea><br>
    <input type="submit" name="submit_msg" value="<?php print $lang["CONTACT_SEND_BUTTON_S"]; ?>" class="button">
    </form></td>
</tr>
</table>
<?php
    theme_draw_centerbox_close();
}

function contact_send( $msgtitle, $msgtext, $headers) {
    global $cfg,$lang;

    $email = $cfg["core"]["mail_admin"];
	$headers .= "X-Sender: <$email>\n";
	$headers .= "X-Mailer: PHP\n";
	$headers .= "Return-Path: <$email>\n";

    if(!@mail($email, $msgtitle, $msgtext, $headers)) {
		print $lang["CONTACT_SEND_ERROR_03"];
		return false;
	} else {
		print $lang["CONTACT_SEND_SENT"];
		$_SESSION["wt"]["contact"] = true;
		return true;
	}
}

?>