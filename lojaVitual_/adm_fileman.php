<?php
include_once("core/main.php");
include_once("modules/fileman/functions.php");
// must check how to do here
if( !check_user_class($config["admmenu"]["File Manager"]["class"]) ) exit;
if( !check_module("fileman") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["FILEMAN_TITLE"];

draw_header();

theme_draw_centerbox_open( $lang["FILEMAN_FOLDERS"] );
reset( $config["fileman"] );
while( $lcat = each( $config["fileman"] ) ) {
	print "<a href=\"adm_fileman.php?cat={$lcat[0]}\">{$lcat[1]["name"]}</a><br>\n";
}
theme_draw_centerbox_close();

$cat = "";
$cont = false;
if( isset($_GET["cat"]) ) {
	$cat = trim(strip_tags($_GET["cat"]));
	if( isset($config["fileman"][$cat]["folder"]) ) $cont = true;
}
if( !$cont ) {
	draw_footer();
	exit();
}

$modname = $config["fileman"][$cat]["name"];
$dir = $config["fileman"][$cat]["folder"];

theme_draw_centerbox_open( $lang["FILEMAN_TITLE"]." - ".$modname );

$basepath = str_replace(basename(__FILE__),"",__FILE__); // find the base path of webthings on server
if( $dir[0] != '/' ) $dir = '/'.$dir; // add leading slash to dirname
if( $dir[strlen($dir)-1] != '/' ) $dir .= '/'; // add trailing slash to dirname
if($dir == "/") {
	// either directory is the same as base path or wrong category was selected
	echo $lang["FILEMAN_ERROR_03"];
	theme_draw_centerbox_close();
	draw_footer();
	exit();
}

if( isset($_GET["del"]) ) {
	$del = trim(strip_tags($_GET["del"]));
	$del = str_replace( array("/"," ","%",";"), "", $del );
	if( !empty($del) && file_exists($basepath.$dir.$del) ) {
		unlink($basepath.$dir.$del);
		printf( $lang["FILEMAN_DELETED"], $del );
	}
	print "<br><br><br><a href=adm_fileman.php?cat=$cat>".$lang["FILEMAN_RETURN"]."</a>";
} elseif( isset($_POST["upload_submit"]) ) {
	if( isset($_FILES["uploadedfile"]["name"]) ) {
		if( !getimagesize($_FILES["uploadedfile"]["tmp_name"]) ) {
			print $lang["FILEMAN_ERROR_04"];
		} else {
			$targetname = str_replace( array("/"," ","%",";"), "", $_FILES["uploadedfile"]["name"] );
			if( !empty($targetname) ) {
				if( $_FILES["uploadedfile"]["size"] > 0 && $_FILES["uploadedfile"]["size"] > $cfg["fileman"]["max_upload"] ) {
					print $lang["FILEMAN_ERROR_02"];
				} else {
					move_uploaded_file( $_FILES["uploadedfile"]["tmp_name"], $basepath.$dir.$targetname );
					printf( $lang["FILEMAN_UPLOADED"], htmlspecialchars($_FILES["uploadedfile"]["name"]) );
				}
			}
		}
	}
	print "<br><br><br><a href=adm_fileman.php?cat=$cat>".$lang["FILEMAN_RETURN"]."</a>";
} else {
	draw_fileman_list( $cat, $dir);
	theme_draw_centerbox_close();
	theme_draw_centerbox_open( $lang["FILEMAN_ULTITLE"] );
	draw_fileman_upload( $cat );
}
theme_draw_centerbox_close();
draw_footer();
?>