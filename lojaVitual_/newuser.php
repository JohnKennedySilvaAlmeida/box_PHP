<?php
include_once("core/main.php");
include( "phpdbform/phpdbform_form.php" );
include_once("core/country.php");
include_once( "core/newuserform.php" );

$index_page = false;
$page_name = $lang["NEWUSER_TITLE"];
srand((double)microtime()*1000000);

draw_header();
if( $_SESSION["wt"]["logged"] )
{
    theme_draw_centerbox_open( $lang["MYACCT_TITLE"] );
    echo $lang["MYACCT_LOGGED"];
    theme_draw_centerbox_close();
    draw_footer();
    exit;
}

$error = "";
$ok = false;

create_userform( "newuser" );
$processed = process_userform();
if( $processed ) {

    if( strlen($userform->fields["passwd1"]->value) <= 0 )
        $error .= $lang["MYACCT_INS_ERROR_01"]."<br>";
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

    // Check if e-mail is already registered
    $ret = db_query( "select email from {$config["prefix"]}_users where"
        ." email='".addslashes($userform->fields["email"]->value)."'" ) or die(db_error());
    if( db_fetch_row($ret) ) {
        $error .= $lang["MYACCT_INS_ERROR_06"]." <a href=\"mailto:".$cfg["core"]["mail_admin"]."\">".$cfg["core"]["name_admin"]."</a>.<br>";
    }
    db_free_result($ret);

    // Check if login is already registered
    $ret = db_query( "select name from {$config["prefix"]}_users where"
        ." name='".addslashes($userform->fields["name"]->value)."'" ) or die(db_error());
    if( db_fetch_row($ret) ) $error .= $lang["MYACCT_INS_ERROR_07"]."<br>";
    db_free_result($ret);
    
    if( strlen($error) > 0 )
    {
        theme_draw_centerbox_open( $lang["ERROR_TITLE"] );
        print "<span class=\"error\">$error</span>";
        theme_draw_centerbox_close();
    } else {
        // Find a session
        $user_session = md5(uniqid(rand()));
        $active = $cfg["core"]["email_activation"]?"N":"Y";

        $stmt = sprintf( "INSERT INTO {$config["prefix"]}_users( name, password, realname, email, question1,"
            ." question2, url, receivenews, receiverel, country, city, state, icq, aim, sex, comments, session,"
            ." active, dateregistered )"
            ." VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',"
            ." '%s', '%s', '%s', NOW() )",
            addslashes($userform->fields["name"]->value),
            md5($userform->fields["passwd1"]->value),
            addslashes($userform->fields["realname"]->value),
            addslashes($userform->fields["email"]->value),
            addslashes($userform->fields["question1"]->value),
            addslashes($userform->fields["question2"]->value),
            addslashes($userform->fields["url"]->value),
            addslashes($userform->fields["receivenews"]->value),
            addslashes($userform->fields["receiverel"]->value),
            addslashes($userform->fields["country"]->value),
            addslashes($userform->fields["city"]->value),
            addslashes($userform->fields["state"]->value),
            addslashes($userform->fields["icq"]->value),
            addslashes($userform->fields["aim"]->value),
            addslashes($userform->fields["sex"]->value),
            addslashes($userform->fields["comments"]->value),
            $user_session,
            $active
        );
        $ret = db_query($stmt) or die(db_error());

        // send email
        if( $cfg["core"]["email_activation"] )
        {
            $sent = @mail($userform->fields["email"]->value, sprintf( $lang["NEWUSER_MAIL_TITLE"], $cfg["core"]["title"] ),
                sprintf( $lang["NEWUSER_MAIL_TEXT"], $userform->fields["name"]->value, $cfg["core"]["title"],
                $cfg["core"]["url"]."/activate.php?name=".$userform->fields["name"]->value."&sess=$user_session",
                $cfg["core"]["name_admin"] ), "From: ".$cfg["core"]["mail_admin"]."\n");
            theme_draw_centerbox_open( $lang["NEWUSER_MSG_TITLE"] );
            echo $lang["NEWUSER_MSG_TEXT"];
            theme_draw_centerbox_close();
        } else {
            theme_draw_centerbox_open( $lang["NEWUSER_MSG_TITLE2"] );
            echo $lang["NEWUSER_MSG_TEXT2"];
            theme_draw_centerbox_close( $lang["NEWUSER_MSG_TITLE2"] );
        }

        // send another e-mail to the admin
        if( $cfg["core"]["mail_new_user"] ) @mail( $cfg["core"]["mail_admin"],
            sprintf( $lang["NEWUSER_MAIL_TITLE"], $cfg["core"]["title"] ),
            "A new user registered at your site:\n\nuser: {$userform->fields["name"]->value}\n"
            ."e-mail: {$userform->fields["email"]->value}",
            "From: ".$cfg["core"]["mail_admin"]."\n");
    }
}

if( !$processed || strlen($error) > 0 ) {
    draw_userform( $lang["NEWUSER_FORM_TITLE"] );
}

draw_footer();
?>