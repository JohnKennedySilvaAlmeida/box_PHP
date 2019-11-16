<?php
function draw_header()
{
    global $cfg;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php draw_header_tag(); ?>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="0">
<tr><td colspan=3>

<table border=0 cellspacing="0" cellpadding="0" width="100%">
<tr><td width=250><img src="images/logo.gif" alt="" border="0"></td>
<td align=center><?php if( check_module("banners")) draw_banner(); ?></td>
</tr>
<tr><td colspan=2><?php if( $cfg["core"]["show_map"] ) draw_navigation_map(); ?></td></tr>
</table>

</td></tr>
<tr><td width=150 valign=top>
<?php
//menu
draw_menu();
draw_login_box();
draw_users_online();
draw_admin_box();
if( check_module("news") ) draw_news_pending( "left" );
if( check_module("sideboxes") ) draw_side_boxes("left");
?>
</td><td width=1000 valign=top>
<?php
}

function draw_footer()
{
?></td><td width=150 valign=top>
<?php
if( check_module("polls") ) draw_poll();
if( check_module("picofday") ) draw_picofday();
//if( check_module("news") ) draw_news_pending( "right" );
if( check_module("sideboxes") ) draw_side_boxes("right");
// please don't remove the link below and help phpWebThings!
// por favor n�o remova o link abaixo e ajude o phpWebThings!
theme_draw_rightbox_open( "Powered by" );
?>
<div align="center"><a href="http://www.phpdbform.com" target="_blank"><img src="images/webthings_button.png" border=0 alt="phpWebThings powered"></a></div>
<?php
theme_draw_rightbox_close();
?>
</td></tr>
<tr><td colspan=3 align="right"><?php draw_copyright(); ?></td></tr>
</table>
</body>
</html>
<?php
}

function theme_draw_leftbox_open( $title )
{
?>
<table width="170" border=0 cellspacing=0 cellpadding=0>
<tr>
	<td width=8 height=22><img src="themes/nt/img/nttopleft.png" width=8 height=22 alt="" border=0></td>
	<td background="themes/nt/img/nttop.png" align="center" valign="middle" height=22 class="sideboxtitle"><?php print $title; ?></td>
	<td width=12 height=22><img src="themes/nt/img/nttopright.png" width=12 height=22 alt="" border=0></td>
</tr>
<tr>
	<td background="themes/nt/img/ntleft.png"> </td>
	<td class="sideboxtext"><table width="100%" border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td class="sideboxtext">
<?php
}

function theme_draw_leftbox_close()
{
?></td>
		</tr>
	</table></td>
	<td background="themes/nt/img/ntright.png"> </td>
</tr>
<tr>
	<td width=8 height=12><img src="themes/nt/img/ntbottomleft.png" width=8 height=12 alt="" border=0></td>
	<td background="themes/nt/img/ntbottom.png"> </td>
	<td width=12 height=12><img src="themes/nt/img/ntbottomright.png" width=12 height=12 alt="" border=0></td>
</tr>
</table>
<?php
}

function theme_draw_rightbox_open( $title )
{
?>
<table width="170" border=0 cellspacing=0 cellpadding=0>
<tr>
	<td width=8 height=22><img src="themes/nt/img/nttopleft.png" width=8 height=22 alt="" border=0></td>
	<td background="themes/nt/img/nttop.png" align="center" valign="middle" height=22 class="sideboxtitle"><?php print $title; ?></td>
	<td width=12 height=22><img src="themes/nt/img/nttopright.png" width=12 height=22 alt="" border=0></td>
</tr>
<tr>
	<td background="themes/nt/img/ntleft.png"> </td>
	<td class="sideboxtext"><table width="100%" border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td class="sideboxtext">
<?php
}

function theme_draw_rightbox_close()
{
?></td>
		</tr>
	</table></td>
	<td background="themes/nt/img/ntright.png"> </td>
</tr>
<tr>
	<td width=8 height=12><img src="themes/nt/img/ntbottomleft.png" width=8 height=12 alt="" border=0></td>
	<td background="themes/nt/img/ntbottom.png"> </td>
	<td width=12 height=12><img src="themes/nt/img/ntbottomright.png" width=12 height=12 alt="" border=0></td>
</tr>
</table>
<?php
}

function theme_draw_centerbox_open( $title )
{
?>
<table width="100%" border=0 cellspacing=0 cellpadding=0>
<tr>
	<td width=8 height=22><img src="themes/nt/img/nttopleft.png" width=8 height=22 alt="" border=0></td>
	<td background="themes/nt/img/nttop.png" align="center" valign="middle" height=22 class="centerboxtitle"><?php print $title; ?></td>
	<td width=12 height=22><img src="themes/nt/img/nttopright.png" width=12 height=22 alt="" border=0></td>
</tr>
<tr>
	<td background="themes/nt/img/ntleft.png"> </td>
	<td class="centerboxtext"><table width="100%" border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td class="centerboxtext">
<?php
}

function theme_draw_centerbox_close()
{
?></td>
		</tr>
	</table></td>
	<td background="themes/nt/img/ntright.png"> </td>
</tr>
<tr>
	<td width=8 height=12><img src="themes/nt/img/ntbottomleft.png" width=8 height=12 alt="" border=0></td>
	<td background="themes/nt/img/ntbottom.png"> </td>
	<td width=12 height=12><img src="themes/nt/img/ntbottomright.png" width=12 height=12 alt="" border=0></td>
</tr>
</table>
<?php
}

function theme_draw_menu_item( $text, $link )
{
    return "<a href=\"$link\">$text</a><br>\n";
}
?>