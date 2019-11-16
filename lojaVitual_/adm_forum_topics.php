<?php
include_once("core/main.php");
require_once("core/parser.php");
if( !check_user_class($config["admmenu"]["Forum Topics"]["class"]) ) exit;

$index_page = false;
$page_name = "Forum Topics/Messages";
$showselect = true;
draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, $config["prefix"]."_forum_msgs", "cod" );//, "cod,title", "cod" );

$formdb->add_listbox( "forum", "Forum", $db, $config["prefix"]."_forums", "cod", "title", "cod" );
$formdb->add_textbox( "msg_ref", "Reference-Message", 4 );
$formdb->add_textbox( "date", "Date", 25 );
$formdb->add_textbox( "date_der", "Last change", 25 );
$formdb->add_textbox( "userid", "User-Id", 4 );
$formdb->add_textbox( "title", "Title", 60 );
$formdb->add_textarea( "text_ori", "Text", 60, 5 );
$formdb->add_hidden( "text" );
$formdb->add_checkbox( "closed", "Discussion closed", "Y", "N" );

function procforum( &$form )
{
    $text = $form->fields["text_ori"]->value;
    $err = "";
    parse_tags3( $text, $err );
    if( !empty($err) ) {
        print $err;
        return false;
    }
    $form->fields["text"]->value = $text;
    return true;
}

$formdb->onupdate = "procforum";
$formdb->oninsert = "procforum";

theme_draw_centerbox_open($page_name);
if( isset($_GET["adm_sel"]) )
{
    $formdb->keyvalue = array( intval($_GET["adm_sel"]) );
}
$formdb->process();
?>
<table align="center" cellspacing="0" cellpadding="2" border="0">
<? $formdb->draw_header(); ?>
	<tr>
	    <td colspan=2 class="centerboxtext"><?php $formdb->fields["forum"]->draw(); ?></td>
	</tr>
	<tr>
	    <td class="centerboxtext"><?php $formdb->fields["date"]->draw(); ?></td>
	    <td class="centerboxtext"><?php $formdb->fields["date_der"]->draw(); ?></td>
	</tr>
	<tr>
	    <td class="centerboxtext"><?php $formdb->fields["msg_ref"]->draw(); ?></td>
		<td class="centerboxtext"><?php $formdb->fields["userid"]->draw(); ?></td>
	</tr>
	<tr>
	    <td colspan="2" class="centerboxtext"><?php $formdb->fields["title"]->draw(); ?></td>
	</tr>
	<tr>
	    <td colspan="2" class="centerboxtext"><?php $formdb->fields["text_ori"]->draw(); ?></td>
	</tr>
	<?php if ($formdb->fields["msg_ref"]->value == 0) : ?>
	<tr>
	    <td colspan="2" class="centerboxtext"><?php $formdb->fields["closed"]->draw(); ?></td>
	</tr>
	<?php endif; ?>
	<tr>
	    <td class="centerboxtext"><?php $formdb->draw_submit( "Submit", false ); ?></td>
	    <td align="right" class="centerboxtext"><?php $formdb->draw_delete_button( "Delete record" ); ?></td>
	</tr>
<? $formdb->draw_footer(); ?>
</table>
<?php
theme_draw_centerbox_close();
draw_footer();
?>