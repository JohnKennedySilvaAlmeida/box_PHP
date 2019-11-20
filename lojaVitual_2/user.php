<?php
include_once("core/main.php");
$index_page = false;
$page_name = $lang["LIST_USERS_TITLE"];
$sitemap[] = array($lang["LIST_USERS_TITLE"], "listusers.php");
draw_header();

if( !$_SESSION["wt"]["logged"] ) {
    theme_draw_centerbox_open( $lang["USERS_ONLINE"] );
    print "<span class=\"error\">".$lang["NOT_LOGGED_ONLINE"]."</span>";
    theme_draw_centerbox_close();
    draw_footer();
    exit;
}

if( !isset($_GET["uid"]) ) {
    theme_draw_centerbox_open( $lang["USERS_ONLINE"] );
    print "<span class=\"error\">Invalid User</span>";
    theme_draw_centerbox_close();
    draw_footer();
    exit;
}

$uid = intval( $_GET["uid"] );

$ret = db_query( "select * from {$config["prefix"]}_users where uid='$uid'" );
if( $row = db_fetch_array( $ret ) )
{
    theme_draw_centerbox_open( $lang["MYACCT_PROFILE"]." ".$row["name"] );
?>
<br>
<table width=300 border=0 cellpadding=1 cellspacing=0 align="center">
<tr><td align=center class="userexttable">
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
<tr><td width="110" rowspan="4" align="center" valign="middle" class="usertoppanel">
<?php
print showavatar( $row["avatar"], $row["realname"] );
?></td>
<td class="usertoppanel"><b><?php echo $lang["MYACCT_FORM_REALNAME"]; ?></b><br><?php echo $row["realname"]; ?></td></tr>
<tr><td class="usertoppanel"><b><?php echo $lang["MYACCT_DATEACTIVATED"]; ?></b><br><?php echo show_date( $row["dateactivated"], false ); ?></td></tr>
<tr><td class="usertoppanel"><b>URL:</b><br><?php 
if( strlen($row["url"]) > 10 ) echo "<a href=\"{$row["url"]}\" target=\"_blank\">".crop_string( $row["url"], 26 )."</a>";
else echo "&nbsp;"; ?></td></tr>
<tr><td class="usertoppanel"><b><?php echo "{$row["country"]}<br>{$row["city"]}"; if( strlen($row["state"])>0 ) echo " - ".$row["state"]; ?></td></tr>
</table></td></tr>
<tr><td align=center class="userexttable">
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
<tr><td class="userbottompanel"><b><?php echo $cfg["core"]["question1_small"]; ?></b><br><?php echo $row["question1"]; ?></td>
<td class="userbottompanel"><b><?php echo $cfg["core"]["question2_small"]; ?></b><br><?php echo $row["question2"]; ?></td></tr>

<tr><td class="userbottompanel"><b>ICQ#:</b><br><?php if(!empty($row["icq"])) echo $row["icq"]; else echo "&nbsp;"; ?></td>
<td class="userbottompanel"><b>AIM#:</b><br><?php if(!empty($row["aim"])) echo $row["aim"]; else echo "&nbsp;"; ?></td></tr>

<tr><td class="userbottompanel"><b><?php echo $lang["MYACCT_FORM_SEX"]; ?></b><br><?php echo $row["sex"]; ?></td>
<td class="userbottompanel"><b><?php echo $lang["MYACCT_NEWSPOSTED"]; ?></b><br><?php echo $row["newsposted"]; ?></td></tr>

<tr><td class="userbottompanel"><b><?php echo $lang["MYACCT_COMMENTSPOSTED"]; ?></b><br><?php echo $row["commentsposted"]; ?></td>
<td class="userbottompanel"><b><?php echo $lang["MYACCT_FAQPOSTED"]; ?></b><br><?php echo $row["faqposted"]; ?></td></tr>

<tr><td class="userbottompanel"><b><?php echo $lang["MYACCT_NUMLOGINS"]; ?></b><br><?php echo $row["logins"]; ?></td>
<td class="userbottompanel"><b><?php echo $lang["MYACCT_LASTVISIT"]; ?></b><br><?php echo show_date( $row["lastvisit"], false ); ?></td></tr>
</table>
</td></tr>
</table>
<br>
<?php
$ret2 = db_query( "select * from {$config["prefix"]}_user_book where userid='{$_SESSION["wt"]["uid"]}' and cod_user='$uid'" );
if( db_num_rows( $ret2 ) == 1 ) $isatbook = true;
else $isatbook = false;
db_free_result( $ret2 );
if( !$isatbook ) echo "<div align=\"center\" class=\"centerboxtext\"><a href=\"myaccount.php?add=$uid\">".$lang["MYACCT_ADD_USER"]. "</a></div>";
else echo "<div align=\"center\" class=\"centerboxtext\"><a href=\"myaccount.php?del=$uid\">".$lang["MYACCT_DEL_USER"]. "</a></div>";
?>
<br><br>
<?php
    theme_draw_centerbox_close();
}
draw_footer();
?>