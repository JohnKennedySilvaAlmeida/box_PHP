<?php
include_once("core/main.php");
$index_page = false;
$page_name = $lang["PASSWD_TITLE"];

draw_header();

theme_draw_centerbox_open( $lang["PASSWD_TITLE"] );

if(isset($_POST["recpass"]))
{
    $error = "";
    $rv_email = delmagic(trim(strip_tags($_POST["rv_email"])));
    if(!ereg("^.+@.+\\..+$", $rv_email)) $error .= $lang["ERROR_08"];
    //" this line is only here to quanta parse it right :)

    if( $error == "" ) {
        $ret = db_query( "select uid,name,password,active,session from {$config["prefix"]}_users where email='".addslashes($rv_email)."'" );
        if( !$ret ) $error .= $lang["ERROR_04"]."<br>";
        else {
            if( db_num_rows($ret) != 1 ) $error .= $lang["ERROR_09"];
            else $row = db_fetch_array($ret);
            db_free_result($ret);
        }
    }

    if( $error == "" ) {
        if( $row["active"] == 'Y' ) {
            // we should reset the password
            $newpass = substr( md5(uniqid(rand())), 0, 8 );
            $ret = db_query( "update {$config["prefix"]}_users set password='".addslashes(md5($newpass))."'"
                ." where uid='{$row["uid"]}'" );
            if( $ret ) {
                $mail_ret = mail( $rv_email, $lang["PASSWD_MAIL_TITLE"].$cfg["core"]["title"],
                    sprintf( $lang["PASSWD_MAIL_TEXT1"], $cfg["core"]["url"], $row["name"], $newpass )
                    ."\n\n\n".$cfg["core"]["name_admin"], "From: ".$cfg["core"]["mail_admin"]."\n");
            } else $error .= $lang["ERROR_04"]."<br>";
        } else $mail_ret = mail( $rv_email, $lang["PASSWD_MAIL_TITLE"].$cfg["core"]["title"],
            sprintf( $lang["PASSWD_MAIL_TEXT1"], $cfg["core"]["url"], $row["name"], "******" )."\n\n"
                . $lang["PASSWD_MAIL_TEXT2"].$cfg["core"]["url"]."/activate.php?name=".$row["name"]
                ."&sess=".$row["session"]."\n\n\n".$cfg["core"]["name_admin"], "From: ".$cfg["core"]["mail_admin"]."\n");
        if( $mail_ret ) echo $lang["PASSWD_MAIL_DONE"];
        else $error .= $lang["PASSWD_MAIL_ERROR"]."<br>";
    }

    if( $error != "" ) {
        echo "<span class=\"error\">$error</span><br><br>";
    }
}

if( !isset($_POST["recpass"]) || $error!="" )
{
    print $lang["PASSWD_TEXT"];
?>
<br><br>
<form method="post" action="lostpasswd.php">
<?php echo $lang["PASSWD_FORM_EMAIL"]; ?><br>
    <input type="text" size=40 maxlenght=50 name="rv_email"><br><br>
    <input type="hidden" name="recpass" value="1">
    <input type="submit" name="submit_recpass" value="<?php echo $lang["PASSWD_FORM_SUBMIT"]; ?>">
</form>
<?php
}
theme_draw_centerbox_close();

draw_footer();
?>