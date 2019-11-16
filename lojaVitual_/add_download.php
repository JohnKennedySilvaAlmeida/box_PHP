<?php
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["Add Downloads"]["class"]) ) exit;
if( !check_module("downloads") ) die( "module not enabled" );

if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
} else {
    require_once("phpdbform/phpdbform_mysql.php");
}
require_once("phpdbform/phpdbform_form.php");

$index_page = false;
$page_name = "Adding download";

draw_header();

$files = "none";

// read drectory
$dir = opendir(".".$cfg["downloads"]["dir"]."/") or die(ERROR_05);
while( ($file = readdir($dir))!==false )
{
	if($file!="." && $file!=".." && $file!="CVS" && $file!="index.html") $files .= ",".$file;
}
closedir($dir);

$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
$db->connect();
$form = new phpform( "form1" );

$form->add_listbox( "category", "Category:", $db, "{$config["prefix"]}_downloadscat", "cod", "name", "cod" );
$form->add_static_listbox( "file", "File:", $files );

theme_draw_centerbox_open("Downloads","100%");

echo "<div class=\"info\">Use this script to quicly add files to your download. The files comes from ".$cfg["downloads"]["dir"]."/"."</div>";
$processed = $form->process();
if( !$processed ) $form->draw();
else {
	if( $form->fields["file"]->value != "none" ) {
		$file = ".".$cfg["downloads"]["dir"]."/".$form->fields["file"]->value;
		$file_size = filesize( $file );
		$file_time = date( "Y-m-d", filemtime( $file ) );
		$url_file = $cfg["core"]["url"].$cfg["downloads"]["dir"];
		if( $url_file[strlen($url_file)-1] != "/" ) $url_file .= "/";
		$url_file .= $form->fields["file"]->value;

		$stmt = "insert into {$config["prefix"]}_downloads (category,name,url,date,size) values( "
			.intval($form->fields["category"]->value) . ", '".$form->fields["file"]->value."', '"
			.$url_file."', '".$file_time."', ".$file_size.")";
		$ret = db_query($stmt);
		if(!$ret) $error .= $lang["ERROR_04"]."<br>".db_error();
		else {
			echo "This file was added:<br>";
			echo "Category: ".$form->fields["category"]->value."<br>";
			echo "URL: ".$url_file."<br>";
			echo "Name: ".$form->fields["file"]->value."<br>";
			echo "Size: ".$file_size."<br>";
			echo "Time: ".$file_time."<br>";
		}
	}
}

theme_draw_centerbox_close();
draw_footer();
?>