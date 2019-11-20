<?php
function draw_header()
{
    global $cfg;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php draw_header_tag(); ?>
<body topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 background="themes/modern/bg.gif">
<center>
<table cellspacing=0 cols=1 cellpadding=0 width=800 border=0>
  <tr>
    <td valign=center align=middle width=800 height=96>
      <table height=117 cellspacing=0 cols=1 cellpadding=0 width=800 border=0>
        <tr>
          <td valign=center align=middle height=10><IMG height=10 src="themes/modern/waytop.gif" width=800></td></tr>
        <tr>
          <td bgColor=#ffffff height=1><IMG height=1 src="themes/modern/dot.gif" width=1></td></tr>
        <tr>
          <td valign=center align=middle background="themes/modern/topbar.gif" height=75><?php if( check_module("banners")) draw_banner(); ?></td></tr>
        <tr>
          <td bgColor=#ffffff height=1><IMG height=1 src="themes/modern/dot.gif" width=1></td></tr>
        <tr>
          <td valign=center align=middle bgColor=#339933 height=20><IMG height=1 src="themes/modern/dot.gif" width=1></td></tr>
        <tr>
          <td valign=center align=middle height=10><IMG height=10 src="themes/modern/topspacer.gif" width=800></td></tr>
        </table></td></tr>
  <tr>
    <td valign=top align=left>
      <table cellspacing=0 cols=3 cellpadding=0 width="800" border=0>
        <tr>
          <td valign=top align=left width=150 background="themes/modern/sidebg.gif">
<?php
//menu
draw_menu();
draw_login_box();
draw_users_online();
draw_admin_box();
if( check_module("news") ) draw_news_pending( "left" );
if( check_module("sideboxes") ) draw_side_boxes("left");
?>
</td><td width="500" valign="top">
<?php
}

function draw_footer()
{
?></td><td valign=top align=left width=150 background="themes/modern/sidebg.gif"><?php
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
?></td></tr></table></td>
  <tr>
    <td valign=center align=middle>
      <table height=62 cellspacing=0 cols=1 cellpadding=0 width=800 background="themes/modern/footerbg.gif" border=0>
        <tr>
          <td valign="bottom"><?php draw_copyright(); ?></td></tr></table></td></tr></table>
</center>
</body>
</html>
<?php
}
// functions that draw the boxes

function theme_draw_leftbox_open( $title )
{
?>
<table cellspacing=0 cols=1 cellpadding=0 width=150 border=0>
<tr>
	<td valign=center align=middle background="themes/modern/boxtop.gif" height=20 NOSAVE><B><?php print $title; ?></B></td>
</tr>
<tr>
	<td valign=top align=left width=150 background="themes/modern/boxbg.gif" NOSAVE><table cellspacing=0 cols=1 cellpadding=8 width="100%" border=0>
	<tr>
		<td vAlign=top align=left>
<?php
}

function theme_draw_leftbox_close()
{
?></td>
	</tr>
	</table></td>
</tr>
<tr><td valign=center align=middle width=150 height=10><IMG height=10 src="themes/modern/boxbot.gif" width=150 NOSAVE></td>
</tr></table><br>
<?php
}

function theme_draw_rightbox_open( $title )
{
?>
<table cellspacing=0 cols=1 cellpadding=0 width=150 border=0>
<tr>
	<td valign=center align=middle background="themes/modern/boxtop.gif" height=20 NOSAVE><B><?php print $title; ?></B></td>
</tr>
<tr>
	<td valign=top align=left width=150 background="themes/modern/boxbg.gif" NOSAVE><table cellspacing=0 cols=1 cellpadding=8 width="100%" border=0>
	<tr>
		<td vAlign=top align=left>
<?php
}

function theme_draw_rightbox_close()
{
?></td>
	</tr>
	</table></td>
</tr>
<tr><td valign=center align=middle width=150 height=10><IMG height=10 src="themes/modern/boxbot.gif" width=150 NOSAVE></td>
</tr></table><br>
<?php
}

function theme_draw_centerbox_open( $title )
{
?>
<table cellspacing=0 cols=1 cellpadding=0 width="100%" border=0>
<tr>
	<td valign=center align=middle background="themes/modern/storytop.gif" height=20 class="centerboxtitle"><B><?php echo $title; ?></B></td>
</tr>
<tr>
	<td valign=top align=left bgColor=#ffffff><table cellspacing=0 cols=1 cellpadding=4 width="100%" border=0><tr><td valign=top align=left class="centerboxtext">
<?php
}

function theme_draw_centerbox_close()
{
?></td></tr></table></td>
</tr>
<tr>
	<td valign=center align=middle height=10><IMG height=10 src="themes/modern/storybot.gif" width="100%" NOSAVE></td>
</tr>
</table>
<?php
}

function theme_draw_menu_item( $text, $link )
{
    return "<a href=\"$link\">$text</a><br>\n";
}
?>
