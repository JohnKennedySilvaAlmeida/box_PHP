<?php
require_once("core/main.php");
require_once("core/parser.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["FAQ"]["class"]) ) exit;

$index_page = false;
$page_name = "FAQ";

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_faq", "cod", "topic,cod", "topic,cod" );

//function add_listbox( $field, $title, $db, $table, $key, $value, $order )
$formdb->add_listbox( "topic", "Topic:", $db, "{$config["prefix"]}_faq_topics", "cod", "name", "name" );
$formdb->add_listbox( "uid", "User:", $db, "{$config["prefix"]}_users", "uid", "name", "name" );
$formdb->add_checkbox( "active", "Active?", "Y", "N" );
$formdb->add_textarea( "question_ori", "Question", 40, 10 );
$formdb->add_textarea( "answer_ori", "Answer", 40, 10 );
$formdb->add_hidden( "question" );
$formdb->add_hidden( "answer" );

function procfaq( &$form )
{
    $text = $form->fields["question_ori"]->value;
    $err = "";
    parse_tags3( $text, $err );
    if( !empty($err) ) {
        print $err;
        return false;
    }
    $form->fields["question"]->value = $text;

    $text = $form->fields["answer_ori"]->value;
    $err = "";
    parse_tags3( $text, $err );
    if( !empty($err) ) {
        print $err;
        return false;
    }
    $form->fields["answer"]->value = $text;	
    return true;
}

$formdb->onupdate = "procfaq";
$formdb->oninsert = "procfaq";

theme_draw_centerbox_open("FAQ");
$formdb->process();
?>
<table align="center" cellspacing="0" cellpadding="2" border="0">
<tr>
    <td colspan="2" class="centerboxtext"><?php $formdb->selform->draw(); ?></td>
</tr>
<?php
$formdb->draw_header();
$formdb->fields["question"]->draw();
$formdb->fields["answer"]->draw();
?>
<tr>
    <td colspan="2" class="centerboxtext"><?php $formdb->fields["topic"]->draw(); ?></td>
</tr>
<tr>
    <td class="centerboxtext"><?php $formdb->fields["uid"]->draw(); ?></td>
    <td class="centerboxtext"><?php $formdb->fields["active"]->draw(); ?></td>
</tr>
<tr>
    <td colspan="2" class="centerboxtext"><?php $formdb->fields["question_ori"]->draw(); ?></td>
</tr>
<tr>
    <td colspan="2" class="centerboxtext"><?php $formdb->fields["answer_ori"]->draw(); ?></td>
</tr>
<tr>
    <td class="centerboxtext"><?php $formdb->draw_submit( "Submit", false ); ?></td>
    <td align="right" class="centerboxtext"><?php $formdb->draw_delete_button( "Delete record" ); ?></td>
</tr>
</table>
<?php
$formdb->draw_footer();
theme_draw_centerbox_close();
draw_footer();
?>