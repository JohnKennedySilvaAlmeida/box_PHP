<?php

function draw_login_box()
{
    global $config, $lang;
    $content = "";
    theme_draw_leftbox_open( $lang["LOGIN_TITLE"] );
    if(!$_SESSION["wt"]["logged"])
    {
        if(isset($_SESSION["wt"]["error"]) && strlen($_SESSION["wt"]["error"])>0) print  "<span class=\"error\">".$_SESSION["wt"]["error"]."</span>";
?>
<table border=0 cellpadding=2 cellspacing=0>
<form action="index.php" name="login_form" id="login_form" method="post">
    <tr><td class="sideboxtext"><?php echo $lang["LOGIN_NAME"]; ?><br>
        <input type="text" name="login_name" size=15 maxlength=20 class="field_textbox"><br>
        <?php echo $lang["LOGIN_PASSWD"]; ?><br>
        <input type="password" name="login_passwd" size=15 maxlength=20 class="field_textbox"><br>
        <input type="checkbox" name="login_auto" value="1" class="field_checkbox"><?php echo $lang["LOGIN_AUTOLOGIN"]; ?></td>
    </tr>
    <tr><td class="sideboxtext" align="center">
        <input type="submit" name="submit_login" value="<?php echo $lang["LOGIN_BUTTON"]; ?>" class="button"></td>
    </tr>
</form>
</table><br>
<a href="newuser.php"><?php echo $lang["LOGIN_REGISTER"]; ?></a><br>
<a href="lostpasswd.php"><?php echo $lang["LOGIN_LOST_PWD"]; ?></a>
<?php
    } else {
?>
<?php printf( $lang["LOGIN_WELCOME"], $_SESSION["wt"]["name"] );
        // if message module is on, show how many messages the user has
        if( check_module("messages") )
        {
			print check_user_messages();
        }
?><br><br>
<a href="index.php?act=logout"><?php echo $lang["LOGIN_LOGOUT"]; ?></a>
<?php
    }
    theme_draw_leftbox_close();
}

function check_user_class( $attr )
{
    // classes used in phpwebthings
    // normal - normal user
    // admin - superuser

    // $_SESSION["wt"]["access"]{"modulename"] == true for every access module

    if( !$_SESSION["wt"]["logged"] ) return false;
    if( $_SESSION["wt"]["class"] == "admin" ) return true;
    // if user is not admin, and the class must be admin, returns
    if( $attr == "admin" ) return false;
    if( isset($_SESSION["wt"]["access"][$attr]) && $_SESSION["wt"]["access"][$attr] == true ) return true;
    else return false;
}

function draw_admin_box()
{
    if( !$_SESSION["wt"]["logged"] ) return;
    $content = "";

    global $config;
    $admmenu = "";
    while( $entry = each( $config["admmenu"] ) )
    {
        if( check_user_class($entry[1]["class"]) ) $admmenu .= "\t<a href=\"{$entry[1]["file"]}\">{$entry[0]}</a><br>\n";
    }
    if( strlen($admmenu)>0) {
		theme_draw_leftbox_open( "Administrator" );
		print $admmenu;
		theme_draw_leftbox_close();
	}

/*
    if( check_user_class( "superuser" ) )
    {
        $content .= "<a href=\"adm_forum_topics.php\">Forum Topics</a><br>";
    }
*/
}

function draw_users_online()
{
    global $config, $lang;
    // Users online - 5 minutes to invalidate the session
    $ctime = time()-300;
    db_query("delete from {$config["prefix"]}_online where time < '$ctime'");
    if($_SESSION["wt"]["logged"]) $user = $_SESSION["wt"]["uid"];
    else $user = 0;
    $ret=db_query("select id from {$config["prefix"]}_online where id='".session_id()."'");
    if(db_num_rows($ret)) db_query("update {$config["prefix"]}_online set time='".time()."', uid='$user' where id='".session_id()."'");
    else db_query("insert into {$config["prefix"]}_online(id,time,uid) values('".session_id()."','".time()."','$user')");
    db_free_result($ret);

    $ret = db_query("select count(id) from {$config["prefix"]}_online");
    $tot_users = db_result($ret,0,0);
    db_free_result($ret);

    $ret = db_query("select count(id) from {$config["prefix"]}_online where uid=0");
    $tot_guests = db_result($ret,0,0);
    db_free_result($ret);
    theme_draw_leftbox_open( $lang["USERS_ONLINE"] );
    printf( $lang["USERS_ONLINE_TEXT"], ($tot_users-$tot_guests), $tot_guests, "<a href=\"online.php\">", "</a>" );
    theme_draw_leftbox_close();
}

function clear_login()
{
    global $cfg, $modules;
    $wt = array();
    // All session vars used may be listed here
    $_SESSION["wt"] = array();
    $_SESSION["wt"]["uid"]=0;
    $_SESSION["wt"]["name"]="";
    $_SESSION["wt"]["class"]="normal";
    $_SESSION["wt"]["logged"]=false;
    $_SESSION["wt"]["style"]="style.css";
    $_SESSION["wt"]["url"] = $cfg["core"]["url"];
    $_SESSION["wt"]["access"] = array();

//    if( check_module("banners") ) count_banners();
    if( check_module("picofday") ) picofday_select();

    // this is only used at some pages or by some modules
    //$_SESSION["wt"]["myacct_email"]
    //$_SESSION["wt"]["error"] = "";
    //$_SESSION["wt"]["banners"];
    //$_SESSION["wt"]["pictureofday_date"]
    //$_SESSION["wt"]["pictureofday"]
}

function fill_login( $uid, $autologin = false, $login_passwd = "" )
{
    // fills session with login data
    global $config;

    $uid = intval( $uid );
    $ret = db_query("select uid, name, class, session from {$config["prefix"]}_users where uid='$uid' and active='Y'");
    if(!$ret || db_num_rows($ret)!=1) {
        $_SESSION["wt"]["error"] = "An error ocurred trying to fill login data";
    } else {
        $row = db_fetch_array($ret);

        $_SESSION["wt"]["uid"] = $row["uid"];
        $_SESSION["wt"]["name"] = $row["name"];
        $_SESSION["wt"]["class"] = $row["class"];
        $_SESSION["wt"]["logged"] = true;

        // get modules access for the user
        $retacc = db_query("select module from {$config["prefix"]}_user_access where userid=$uid");
        if(!$retacc) {
            $_SESSION["wt"]["error"] = "An error ocurred trying to get access";
        } else {
            while( $row_access = db_fetch_array($retacc) ) {
                $_SESSION["wt"]["access"][$row_access["module"]] = true;
            }
            db_free_result( $retacc );
        }
        // update some data into user table
        @db_query("update {$config["prefix"]}_users set lastvisit=NOW(), logins=logins+1 where uid='$uid'");

        // if user checked auto_login...
        if( $autologin ) {
            create_autologin( $login_passwd, $row["session"] );
        }
    }
    db_free_result( $ret );
}

function do_login()
{
    global $config;
    clear_login();

    $login_name = addslashes(delmagic($_POST["login_name"]));
    $login_passwd = md5(addslashes(delmagic($_POST["login_passwd"])));

    $ret = db_query("select uid from {$config["prefix"]}_users where name='$login_name' and password='$login_passwd' and active='Y'");
    if(!$ret) {
        $_SESSION["wt"]["error"] = "An error ocurred trying to check login";
    } else {
        if(db_num_rows($ret)!=1) {
            $_SESSION["wt"]["error"] = "Login failed";
        } else {
            $row = db_fetch_array($ret);
            $autologin = ( isset($_POST["login_auto"]) && $_POST["login_auto"] == 1 );
            fill_login( $row["uid"], $autologin, $login_passwd );
        }
        db_free_result( $ret );
    }
}

function create_autologin( $passwd, $activate_session )
{
    $sess = $_SESSION["wt"];
    if( !$sess["logged"] ) return;

    $cookie = sprintf( "%010d", $sess["uid"] );
    $cookie .= substr(md5($sess["name"]),0,10);
    $cookie .= substr(md5($passwd),0,10);
    $cookie .= substr(md5($activate_session),0,10);
    setcookie( "phpwebthings", $cookie, time()+2592000 );
}

function delete_autologin()
{
    if( isset($_COOKIE["phpwebthings"]) )
    {
        $cookie = $_COOKIE["phpwebthings"];
        setcookie( "phpwebthings", $cookie, time()-3600 );
    }
}

function check_autologin()
{
    // If user not logged, try autologin
    global $config;
    if( !isset( $_COOKIE["phpwebthings"] ) ) return;
    $cookie = $_COOKIE["phpwebthings"];
    $id = intval(substr($cookie,0,10));
    $ret = db_query("select uid, name, password, session from {$config["prefix"]}_users where uid='$id' and active='Y'");
    if(!$ret)
    {
        delete_autologin();
        clear_login();
        $_SESSION["wt"]["error"] = "An error ocurred trying to check auto-login";
        return;
    }
    if(db_num_rows($ret)!=1)
    {
        db_free_result($ret);
        delete_autologin();
        clear_login();
        $_SESSION["wt"]["error"] = "Login failed";
        return;
    }
    $row = db_fetch_array($ret);
    db_free_result($ret);

    $mdh = substr($cookie,10,30);
    $mdr = substr(md5($row["name"]),0,10).substr(md5($row["password"]),0,10).substr(md5($row["session"]),0,10);
    if( $mdh != $mdr )
    {
        delete_autologin();
        clear_login();
        $_SESSION["wt"]["error"] = "Login failed";
        return;
    }
    // setup the session
    fill_login( $id );
}
?>