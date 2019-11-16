<?php
include_once("core/main.php");
include( "phpdbform/phpdbform_form.php" );
include_once("core/country.php");
include_once( "core/newuserform.php" );

$index_page = false;
$page_name = $lang["MYACCT_TITLE"];
//$sitemap[] = array(MYACCT_TITLE, "myaccount.php");

draw_header();
if( !$_SESSION["wt"]["logged"] )
{
    theme_draw_centerbox_open( $lang["MYACCT_TITLE"] );
    echo $lang["NOT_LOGGED_MYACCT"];
    theme_draw_centerbox_close();
    draw_footer();
    exit;
}

// Add user
if( isset($_GET["add"]) )
{
    $add = intval( $_GET["add"] );
    db_query( "insert into {$config["prefix"]}_user_book (userid, cod_user) values ( '{$_SESSION["wt"]["uid"]}', '$add' )" );
    print "<span class=\"info\">".$lang["MYACCT_USER_ADDED"]."</span>";
}
// Del user
if( isset($_GET["del"]) )
{
    $del = intval( $_GET["del"] );
    db_query( "delete from {$config["prefix"]}_user_book where userid='{$_SESSION["wt"]["uid"]}' and cod_user='$del'" );
    print "<span class=\"info\">".$lang["MYACCT_USER_DELETED"]."</span>";
}

theme_draw_centerbox_open( $lang["MYACCT_TITLE"]." ({$_SESSION["wt"]["name"]})" );

echo "<a href=\"listusers.php\">".$lang["LIST_USERS_TITLE"]."</a>";
echo "<br><br>";
theme_draw_centerbox_close();

$error = "";
$ok = false;

create_userform( "myaccount" );

$ret = db_query( "select * from {$config["prefix"]}_users where uid={$_SESSION["wt"]["uid"]}" ) or die(db_error());
$user = db_fetch_array($ret);
db_free_result($ret);

$userform->fields["name"]->value = $user["name"];
$userform->fields["realname"]->value = $user["realname"];
$userform->fields["email"]->value = $user["email"];
// Store the user e-mail in the session, so we can check if he changed it
$_SESSION["wt"]["myacct_email"] = $user["email"];
// empty passwords for security, only if the user enters any passwd it will be updated
$userform->fields["passwd1"]->value = "";
$userform->fields["passwd2"]->value = "";
$userform->fields["sex"]->value = $user["sex"];
$userform->fields["question1"]->value = $user["question1"];
$userform->fields["question2"]->value = $user["question2"];
$userform->fields["country"]->value = $user["country"];
$userform->fields["city"]->value = $user["city"];
$userform->fields["state"]->value = $user["state"];
$userform->fields["receivenews"]->value = $user["receivenews"];
$userform->fields["receiverel"]->value = $user["receiverel"];
$userform->fields["url"]->value = $user["url"];
$userform->fields["icq"]->value = $user["icq"];
$userform->fields["aim"]->value = $user["aim"];
$userform->fields["comments"]->value = $user["comments"];

$processed = process_userform();
if( $processed ) {

    if( $userform->fields["passwd1"]->value != $userform->fields["passwd2"]->value )
        $error .= $lang["MYACCT_INS_ERROR_02"]."<br>";
    if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$", $userform->fields["email"]->value))
        $error .= $lang["ERROR_08"];
    if( strlen($userform->fields["name"]->value) <= 0 )
        $error .= $lang["MYACCT_INS_ERROR_03"]."<br>";
    if(ereg("[^A-Za-z0-9_.-]+", $userform->fields["name"]->value))
        $error .= $lang["MYACCT_INS_ERROR_04"]."<br>";
    if( strlen($userform->fields["country"]->value) <= 0 )
        $error .= $lang["MYACCT_INS_ERROR_05"]."<br>";
    if( strstr($cfg["core"]["question1_values"],$userform->fields["question1"]->value) === false )
        $error .= $lang["MYACCT_INVALID_VALUE"]." '".$cfg["core"]["question1_small"]."'<br>";
    if( strstr($cfg["core"]["question2_values"],$userform->fields["question2"]->value) === false )
        $error .= $lang["MYACCT_INVALID_VALUE"]." '".$cfg["core"]["question2_small"]."'<br>";
    if( strlen($error) > 0 )
    {
        theme_draw_centerbox_open( $lang["ERROR_TITLE"] );
        print "<span class=\"error\">$error</span>";
        theme_draw_centerbox_close();
    } else {
        $changed_email = false;
        $stmt = sprintf( "update {$config["prefix"]}_users set realname='%s', question1='%s', question2='%s', country='%s', city='%s', state='%s', receivenews='%s', receiverel='%s', url='%s', icq='%s', aim='%s', sex='%s', comments='%s'", 
            addslashes($userform->fields["realname"]->value),
            addslashes($userform->fields["question1"]->value),
            addslashes($userform->fields["question2"]->value),
            addslashes($userform->fields["country"]->value),
            addslashes($userform->fields["city"]->value),
            addslashes($userform->fields["state"]->value),
            addslashes($userform->fields["receivenews"]->value),
            addslashes($userform->fields["receiverel"]->value),
            addslashes($userform->fields["url"]->value),
            addslashes($userform->fields["icq"]->value),
            addslashes($userform->fields["aim"]->value),
            addslashes($userform->fields["sex"]->value),
            addslashes($userform->fields["comments"]->value)
        );

        if( strlen($userform->fields["passwd1"]->value) > 0 )
            $stmt .= ", password='".md5($userform->fields["passwd1"]->value)."'";
        if( strcasecmp( $userform->fields["email"]->value, $_SESSION["wt"]["myacct_email"] ) != 0 ) {
            // if email_activation is off, just change the e-mail
            if( !$cfg["core"]["email_activation"] ) {
                $stmt .= ", email='".addslashes($userform->fields["email"]->value)."'";
            } else {
                $user_session = md5(uniqid(rand()));
                $stmt .= ", newemail='".addslashes($userform->fields["email"]->value)."', "
                    ." newemailsess='".addslashes($user_session)."'";
                $changed_email = true;
            }
        }
        $stmt .= " where uid={$_SESSION["wt"]["uid"]}";
        $ret = db_query($stmt) or die(db_error());

        if( $changed_email )
        {
            theme_draw_centerbox_open( $lang["MYACCT_EMAIL_CHANGED_TITLE"] );
            printf( "<span class=\"info\"><br>".$lang["MYACCT_EMAIL_CHANGED_TEXT"]."<br><br></span>",
                $userform->fields["email"]->value );
            // send e-mail
            @mail( $userform->fields["email"]->value,
                sprintf( $lang["MYACCT_EMAIL_CHANGED_MAIL_TITLE"], $cfg["core"]["title"] ),
                sprintf( $lang["MYACCT_EMAIL_CHANGED_MAIL_TEXT"], addslashes($userform->fields["name"]->value),
                    $cfg["core"]["title"],
                    $cfg["core"]["url"]."/activate.php?name=".addslashes($userform->fields["name"]->value)
                    ."&nesess=$user_session", $cfg["core"]["name_admin"] ), "From: ".$cfg["core"]["mail_admin"]."\n");
            theme_draw_centerbox_close();
        }
    }
}
draw_userform( $lang["MYACCT_INFO"] );

if( $cfg["core"]["avatars"] )
{
    $error = "";
    // Avatars
    theme_draw_centerbox_open( $lang["AVATAR_TITLE"] );

    if( isset($_POST["avatar_file_submit"]) ) {
        $img = getimagesize( @$_FILES["avatar_file"]["tmp_name"] );
        if( $img ) {
            if( $img[0] != 100 // width
                || $img[1] != 100 //height
                || ( $img[2] < 1 || $img[2] > 3 ) ) { // 1, gif 2 jpg, 3 png
                print "<span class=\"error\">Invalid picture, it must be 100x100 of type gif, jpg or png</span><br>";
            } else {
                if( $img[2] == 1 ) $ext = ".gif";
                else if( $img[2] == 2 ) $ext = ".jpg";
                else $ext = ".png";
                $target = sprintf( "%010d%s", $_SESSION["wt"]["uid"], $ext );
                $ret = @move_uploaded_file( $_FILES["avatar_file"]["tmp_name"],
                    "{$cfg["core"]["avatars_folder"]}/$target" );
//                    "d:/cvsroot/webthings07/var/avatars/$target");
                if( !$ret ) {
                    print "<span class=\"error\">An error ocurred trying to create the avatar.</span>";
                } else {
                    $ret = db_query( "update {$config["prefix"]}_users set avatar = '$target' where uid='{$_SESSION["wt"]["uid"]}'" );
                    if( !$ret ) {
                        print "<span class=\"error\">A database error ocurred trying to create the avatar.</span>";
                    } else {
                        print "<span class=\"info\">Avatar created.</span>";
                    }
                }
            }
        }
    } else if( isset($_POST["avatar_sel_submit"]) ) {
        $avatar = delmagic($_POST["sel_avatar"]);
        if( $avatar != "none" ) {
            // pre-made avatars
            if( !eregi("^[a-z0-9_]*\.(jpg|png|gif)$", $avatar) ) {
                $error = "Invalid filename.<br>";
            } else {
                if( !file_exists("{$cfg["core"]["avatars_folder"]}/$avatar" ) ) {
                    $error = "Avatar not found.<br>";
                } else {
                    $ret = db_query( "update {$config["prefix"]}_users set avatar = '$avatar' where uid='{$_SESSION["wt"]["uid"]}'" );
                    if( !$ret ) {
                        print "<span class=\"error\">A database error ocurred trying to change the avatar.</span>";
                    } else {
                        print "<span class=\"info\">Avatar changed.</span>";
                    }
                }
            }
        } else {
            $ret = db_query( "update {$config["prefix"]}_users set avatar = NULL where uid='{$_SESSION["wt"]["uid"]}'" );
            if( !$ret ) {
                print "<span class=\"error\">A database error ocurred trying to change the avatar.</span>";
            } else {
                print "<span class=\"info\">Avatar changed.</span>";
            }
        }
    }
    if( !empty($error) ) print "<div class=\"error\">$error</div>";

    $avatar_list = array();
    $dir = opendir( $cfg["core"]["avatars_folder"] );
    if( $dir ) {
        while( false !== ($file = readdir($dir))) { 
            if( eregi("^[a-z0-9_]*\.(jpg|png|gif)$", $file) ) $avatar_list[] = $file;
        }
        sort( $avatar_list, SORT_STRING );
    } else print "<div class=\"error\">Invalid path configured at wt_config</div>";
    
    $ret = db_query( "select realname, avatar from {$config["prefix"]}_users where uid={$_SESSION["wt"]["uid"]}" );
    $realname = db_result( $ret, 0, 0 );
    $avatar = db_result( $ret, 0, 1 );
    db_free_result($ret);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr><td width="110" valign="top" class="centerboxtext"><?php print showavatar( $avatar, $realname ); ?></td>
<td class="centerboxtext"><form action="myaccount.php" method="post" enctype="multipart/form-data" name="avatar_form" id="avatar_form">
<input type="hidden" name="avatar_submit" value="1">
<?php echo $lang["AVATAR_SELECT"]; ?><br>
<select name="sel_avatar" class="field_listbox">
    <option value="none"><?php echo $lang["AVATAR_NONE"]; ?></option>
<?php
reset($avatar_list);
while( $file = each($avatar_list) ) {
    echo "<option value=\"{$file[1]}\">{$file[1]}</option>\n";
}
?>
</select><br><input type="submit" class="button" name="avatar_sel_submit"><br><br>
<?php echo $lang["AVATAR_UPLOAD"]; ?><br>
<input type="file" name="avatar_file" class="field_filebox"><br><input type="submit" class="button" name="avatar_file_submit">
</form>
</td><tr></table>
<?php
theme_draw_centerbox_close();
}
// List my book
theme_draw_centerbox_open( $lang["MYACCT_USER_BOOK"] );
?>
<table width="90%" border=0 align="center" cellpadding="2" cellspacing="0">
<tr class="row0">
    <td class="row0"><? echo $lang["MYACCT_FORM_LOGIN"]; ?></td>
    <td class="row0"><? echo $lang["MYACCT_FORM_REALNAME"]; ?></td>
    <td class="row0"><? echo $lang["MYACCT_FORM_COUNTRY"]; ?></td>
    <td class="row0">URL</td>
    <td class="row0">ICQ#</td>
    <td class="row0">AIM#</td>
</tr>
<?php
$class = "row2";

$ret = db_query( "select B.cod_user, U.name, U.realname, U.country, U.url, U.icq, U.aim from {$config["prefix"]}_user_book B left outer join {$config["prefix"]}_users U on (U.uid = B.cod_user) where B.userid = {$_SESSION["wt"]["uid"]}" );
while( $row = db_fetch_array( $ret ) )
{
    if( $class=="row2" ) $class = "row1";
    else $class = "row2";
    echo "<tr class=\"$class\"><td class=\"$class\"><a href=\"user.php?uid={$row["cod_user"]}\">{$row["name"]}</a></td><td class=\"$class\">{$row["realname"]}</td><td class=\"$class\">{$row["country"]}</td><td class=\"$class\">";
    if( strlen($row["url"]) > 0 ) echo "<a href=\"{$row["url"]}\">{$row["url"]}</a>";
    else echo "&nbsp;";
    echo "</td><td class=\"$class\">{$row["icq"]}</td><td class=\"$class\">{$row["aim"]}</td></tr>";
}

?>
</table>
<?php
theme_draw_centerbox_close();
draw_footer();
?>