<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["Downloads"]["class"]) ) exit;
if( !check_module("downloads") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["DOWNLOAD_TITLE"];

draw_header();

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_db.php");

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$formdb = new phpdbform( $db, "{$config["prefix"]}_downloads", "id", "name", "name" );

// read drectory
$img_files = "none";
$dir = opendir("modules/downloads/images/") or die( $lang["ERROR_05"] );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") $img_files .= ",$file";
}
closedir($dir);

//function add_listbox( $field, $title, $db, $table, $key, $value, $order )
$formdb->add_listbox( "category", "Category:", $db, "{$config["prefix"]}_downloadscat", "cod", "name", "name" );
$formdb->add_textbox( "name", "Name", 30 );
$formdb->add_textbox( "url", "URL", 40 );
$formdb->add_textbox( "date", "Date", 20 );
$formdb->add_textbox( "size", "Size (bytes)", 10 );
$formdb->add_textarea( "short_description", "Short description", 40, 3 );
$formdb->add_textarea( "description", "Description", 40, 6 );
$formdb->add_static_listbox( "small_picture", "Thumbnail", $img_files );
$formdb->add_static_listbox( "big_picture", "Screenshot", $img_files );

theme_draw_centerbox_open( $lang["DOWNLOAD_TITLE"] );
$formdb->process();
?>
<table border=0 cellspacing="0" cellpadding="2">
<tr><td colspan=2 class="centerboxtext"><?php $formdb->selform->draw(); ?></td></tr>
<?php $formdb->draw_header(); ?>
<tr><td colspan=2 class="centerboxtext"><?php $formdb->fields["category"]->draw(); ?></td></tr>
<tr><td colspan=2 class="centerboxtext"><?php $formdb->fields["name"]->draw(); ?></td></tr>
<tr><td colspan=2 class="centerboxtext"><?php $formdb->fields["url"]->draw(); ?></td></tr>
<tr>
	<td width="50%" class="centerboxtext"><?php $formdb->fields["date"]->draw(); ?></td>
	<td width="50%" class="centerboxtext"><?php $formdb->fields["size"]->draw(); ?></td>
</tr>
<tr><td colspan=2 class="centerboxtext"><?php $formdb->fields["short_description"]->draw(); ?></td></tr>
<tr><td colspan=2 class="centerboxtext"><?php $formdb->fields["description"]->draw(); ?></td></tr>
<tr>
	<td width="50%" class="centerboxtext"><?php $formdb->fields["small_picture"]->draw(); ?></td>
	<td width="50%" class="centerboxtext"><?php $formdb->fields["big_picture"]->draw(); ?></td>
</tr>
<tr><td colspan=2 class="centerboxtext">&nbsp;</td></tr>
<tr>
    <td width="50%" class="centerboxtext"><?php $formdb->draw_submit( "Insert/Update", false ); ?></td>
    <td width="50%" align="right" class="centerboxtext"><?php $formdb->draw_delete_button( "Delete" ); ?></td>
</tr>
<?php $formdb->draw_footer(); ?>
</table>
<?php
theme_draw_centerbox_close();
draw_footer();
?>