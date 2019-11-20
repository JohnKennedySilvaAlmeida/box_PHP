<?php
require_once("core/main.php");
require_once("core/parser.php");
if( !check_user_class($config["admmenu"]["Articles"]["class"]) ) exit;
if( !check_module("articles") ) die( "module not enabled" );

$index_page = false;
$page_name = "Articles";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_articles", "cod", "article_id,page,subtitle", "article_id,page" );

$formdb->add_listbox( "article_id", "Article", $db, "{$config["prefix"]}_articles_title", "article_id", "title", "title" );
$formdb->add_textbox( "subtitle", "Subtitle", 60 );
$formdb->add_textbox( "page", "Page", 3 );
$formdb->add_textarea( "text_ori", "Text", 80, 15 );
$formdb->add_hidden( "text" );

function procarticle( &$form )
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

$formdb->onupdate = "procarticle";
$formdb->oninsert = "procarticle";


theme_draw_centerbox_open($page_name);
$formdb->process();
$formdb->draw();
theme_draw_centerbox_close();
draw_footer();

?>