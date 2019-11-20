<?php
include_once("core/main.php");
if( !check_user_class($config["admmenu"]["Polls"]["class"]) ) exit;
if( !check_module("polls") ) die( "module not enabled" );

$index_page = false;
$page_name = "Polls";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_polls", "cod", "dtstart,dtend", "dtstart,dtend" );

$formdb->add_date( "dtstart", "Start date", 12 );
$formdb->add_textbox( "dtend", "End date", 12 );
$formdb->add_textarea( "question", "Question", 40, 5 );

for($i=1;$i<=10;$i++)
{
  $formdb->add_textbox( sprintf("item%02d",$i), sprintf("Item %d",$i), 30 );
  $formdb->add_textbox( sprintf("count%02d",$i), sprintf("Count %d",$i), 5 );
}

theme_draw_centerbox_open($page_name);
$formdb->process();
?>
<table align="center" cellspacing="0" cellpadding="2" border="0">
	<tr>
	    <td colspan="2" class="centerboxtext"><?php $formdb->selform->draw(); ?></td>
	</tr>
<? $formdb->draw_header(); ?>	
	<tr>
	    <td class="centerboxtext"><?php $formdb->fields["dtstart"]->draw(); ?></td>
		<td class="centerboxtext"><?php $formdb->fields["dtend"]->draw(); ?></td>
	</tr>
	<tr>
	    <td colspan="2" class="centerboxtext"><?php $formdb->fields["question"]->draw(); ?></td>
	</tr>
	<?php
    for($i=1;$i<=10;$i++) : ?>
        <tr>
            <td class="centerboxtext"><?php $formdb->fields[sprintf("item%02d",$i)]->draw(); ?></td>
	        <td class="centerboxtext"><?php $formdb->fields[sprintf("count%02d",$i)]->draw(); ?></td>
	</tr>
	<?php endfor; ?>
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