<?php
function draw_header()
{
    global $cfg;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php draw_header_tag(); ?>
<body>
<table width="762" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#000000"><tr><td>
<table width="760" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr><td colspan=3>

<table border=0 cellspacing="0" cellpadding="0" width="100%">
<tr><td width=1  height="75" bgcolor="#000000"><img src="themes/bg/img/shim.gif" width="1" height="75" alt="" border="0"></td><td width="759" height="75" align="center" background="themes/bg/img/topbar.png"><?php if( check_module("banners")) draw_banner(); ?></td></tr>
<tr><td height="30" bgcolor="#FFFFFF" colspan=2 style="border-bottom : 1px solid #333333;"><img src="themes/bg/img/shim.gif" width="1" height="30" alt="" border="0"></td>
</tr>
<tr><td colspan=2><?php if( $cfg["core"]["show_map"] ) draw_navigation_map(); ?></td></tr>
</table>
</td></tr>

<tr><td width="160" height="400" valign="top" bgcolor="#FAFAFA"><?php
draw_menu();
draw_login_box();
draw_users_online();
draw_admin_box();
if( check_module("news") ) draw_news_pending( "left" );
if( check_module("sideboxes") ) draw_side_boxes("left");
?></td>
<td width="440" valign=top>
<?php
}

function draw_footer()
{
?></td>
<td width="160" valign="top" bgcolor="#FAFAFA"><?php
if( check_module("polls") ) draw_poll();
if( check_module("picofday") ) draw_picofday();
//if( check_module("news") ) draw_news_pending( "right" );
if( check_module("sideboxes") ) draw_side_boxes("right");
// please don't remove the link below and help phpWebThings!
// por favor não remova o link abaixo e ajude o phpWebThings!
theme_draw_rightbox_open( "Powered by" );
?>
<div align="center"><a href="http://www.phpdbform.com" target="_blank"><img src="images/webthings_button.png" border=0 alt="phpWebThings powered"></a></div>
<?php
theme_draw_rightbox_close();
?>
</td></tr>
<tr><td height="30" colspan="3" align="center" valign="bottom" style="border-top : 1px solid #333333;" bgcolor="#FFFFFF"><?php draw_copyright(); ?></td></tr>
</table>
</td></tr></table>
</body>
</html>
<?php
}
// functions that draw the boxes

function theme_draw_leftbox_open( $title )
{
?>
<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr>
    <td class="sideboxtitle" align="left" colspan=2>&nbsp;<?php echo $title; ?></td>
</tr>
<tr>
    <td class="sideboxtext" width="4"><img src="themes/bg/img/shim.gif" width="2" height="1" alt="" border="0"></td>
    <td class="sideboxtext">
<?php
}

function theme_draw_leftbox_close()
{
?>
</td>
</tr>
</table><br>
<?php
}

function theme_draw_rightbox_open( $title )
{
?>
<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr>
    <td class="sideboxtitle" align="right" colspan=2><?php echo $title; ?>&nbsp;</td>
</tr>
<tr>
    <td class="sideboxtext">
<?php
}

function theme_draw_rightbox_close()
{
?>
</td>
</tr>
</table><br>
<?php
}

function theme_draw_centerbox_open( $title )
{
?>
<table width="95%" border="0" cellspacing="0" cellpadding="2" align="center">
<tr>
    <td class="centerboxtitle" align=center><?php echo $title; ?></td>
</tr>
<tr>
    <td class="centerboxtext">
<?php
}

function theme_draw_centerbox_close()
{
?>
</td>
</tr>
</table><br>
<?php
}

function theme_draw_menu_item( $text, $link )
{
    return "<a href=\"$link\"><img src=\"themes/bg/img/abullet.png\" width=12 height=10 alt=\"\" border=0>&nbsp;$text</a><br>\n";
}
?>
