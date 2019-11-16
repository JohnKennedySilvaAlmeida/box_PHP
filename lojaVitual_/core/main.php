<?php
if (strstr($_SERVER["PHP_SELF"], "/core/"))  die ("You can't access this file directly...");
session_start();

function getmicrotime()
{ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
}
$time_start = getmicrotime();

$modules = array();
$headcode = "";
$config = array();
$config["menu"] = array();
require("wt_config.php");
if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require("core/{$config["dbtype"]}.lib.php");
} else {
    require("core/mysql.lib.php");
}
include_once("core/login.php");

function check_lang( $lang )
{
    // up to only 4 letters
    $ret = substr( $lang, 0, 4 );
    if( ereg("^[a-z]{2,4}$", $ret) ) return $ret;
    else
    {
        echo "Invalid lang file";
        return "enus";
    }
}

$conn = db_connect($config["host"],$config["database"],$config["user"],$config["password"]) or die( db_error() );
// Load configuration
$cfg = array();

$ret = db_query( "select * from {$config["prefix"]}_config" );
if( !$ret ) {
    print "<div class=\"error\">An error has ocurred while loading configuration.</div>";
} else {
    while( $rowcfg = db_fetch_array($ret) ) {
        $cfg[$rowcfg["id"]] = unserialize(stripslashes($rowcfg["config"]));
    }
}
db_free_result($ret);

include_once( "lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
require_once("core/theme.php");

//if( !isset($config["show_map"]) ) $config["show_map"] = true;

//if( $config["show_map"] )
//{
//    $sitemap = array();
//    $sitemap[] = array(HOME_TITLE, 'index.php');
//}
//

//
// Links at main box
$config["menu"][10] = array( "title"=>$lang["HOME_TITLE"], "file"=>"index.php", "type"=>"A" );
$config["menu"][110] = array( "title"=>$lang["NEW_USER_LINK"], "file"=>"newuser.php", "type"=>"N" );
$config["menu"][120] = array( "title"=>$lang["MYACCT_TITLE"], "file"=>"myaccount.php", "type"=>"L" );
$config["menu"][130] = array( "title"=>$lang["STATS_TITLE"], "file"=>"stats.php", "type"=>"A" );

// Links at admmenu
$config["admmenu"] = array();
$config["admmenu"]["Info"] = array( "file"=>"adm_info.php", "class"=>"admin" );
$config["admmenu"]["WebAdmin"] = array( "file"=>"admin.php", "class"=>"admin" );
$config["admmenu"]["Send e-mail"] = array( "file"=>"adm_sendmail.php", "class"=>"admin" );

$config["admmenu"]["Users"] = array( "file"=>"adm_users.php", "class"=>"admin" );
$config["admmenu"]["User Access"] = array( "file"=>"adm_access.php", "class"=>"admin" );
$config["admmenu"]["Menu"] = array( "file"=>"adm_menu.php", "class"=>"admin" );

$modules = array();
foreach($cfg["modules"] as $mid=>$enabled) {
    $modules[$mid] = false;
    if ($enabled) include_once("modules/$mid/main.php");
}

// loads the user menu from database
$ret = db_query( "select * from {$config["prefix"]}_menu order by pos" );
if( !$ret ) {
    print "<div class=\"error\">An error has ocurred while loading user menu.</div>";
} else {
    while( $rmenu = db_fetch_array($ret) ) {
		$pos = $rmenu["pos"];
		$c = 0;
		while( isset($config["menu"][$pos]) ) {
			$pos++;
			// if this happens, thre is something very wrong
			if( ++$c > 100 ) {
				print "<div class=\"error\">The menu is full.</div>";
				break;
			}
		}
		$config["menu"][$pos] = array( "title"=>$rmenu["title"], "file"=>$rmenu["url"], "type"=>$rmenu["type"] );
    }
}
db_free_result($ret);

// todo: passar para login.php
// if the user comes from a site below the same url
// like www.phpdbform.com and www.phpdbform.com/test
// empty the session

if(isset($_SESSION["wt"])) {
    if( $_SESSION["wt"]["url"] != $cfg["core"]["url"] ) {
        clear_login();
    }
} else {
    clear_login();
}

// User trying to login
if(isset($_POST["submit_login"])) {
    do_login();
}
if( !$_SESSION["wt"]["logged"] ) {
    check_autologin();
}

if( isset($_GET["act"]) && $_GET["act"]=="logout") {
    clear_login();
    delete_autologin();
}

function show_date( $date, $showtime=true )
{
    global $cfg;
    switch( $cfg["core"]["date_format"] )
    {
        case "fmtEUR":  $date_str = substr($date,8,2)."/".substr($date,5,2)."/".substr($date,0,4); break;
        case "fmtUSA":  $date_str = substr($date,5,2)."/".substr($date,8,2)."/".substr($date,0,4); break;
        default:        $date_str = substr($date,0,4)."-".substr($date,5,2)."-".substr($date,8,2); break;
    }
    if( $showtime ) $date_str .= " ".substr($date,11,5);
    return $date_str;
}

function crop_string( $text, $maxlen )
{
    if( strlen($text) <= $maxlen ) return $text;
    else return( substr( $text, 0, ($maxlen-3) ) . "..." );
}

function conv_date( $date, $showtime=true )
{
	global $cfg;
	switch( $cfg["core"]["date_format"] )
	{
		case "fmtEUR":  $date_str = substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2); break;
		case "fmtUSA":  $date_str = substr($date,6,4)."/".substr($date,0,2)."/".substr($date,3,2); break;
		default:        $date_str = substr($date,0,4)."-".substr($date,5,2)."-".substr($date,8,2); break;
	}
	if( $showtime ) $date_str .= " ".substr($date,11,5);
	return $date_str;
}

//function session_dump()
//{
//  // dumps info about a session - debugging
//  $session_array = explode(";",session_encode());
//  $html = "SESSION VARIABLES DUMP<br><br>";
//  for ($x = 0; $x < count($session_array); $x++) { 
//    $html .= "     $session_array[$x] <br>";
//  }
//  $html .= " <br><br>";
//  return $html;
//}
//
//function magic_encode( $var )
//{
//    if( get_magic_quotes_gpc() ) return $var;
//    else return addslashes($var);
//}
function delmagic( $value )
{
    // this function removes backslashes ig magic_quotes_gpc is on
    if( get_magic_quotes_gpc() ) return stripslashes( $value );
    else return $value;
}

function showavatar( $avatar, $realname )
{
    global $cfg;
    if( $cfg["core"]["avatars"] && $avatar != "" )
        return "<img src=\"{$cfg["core"]["avatars_folder"]}/$avatar\" alt=\"$realname\" width=100 height=100 border=0>";
    else return "&nbsp;";
}

function check_module( $module )
{
    global $modules;
    if( !isset($modules[$module]) ) return false;
    return $modules[$module];
}
?>