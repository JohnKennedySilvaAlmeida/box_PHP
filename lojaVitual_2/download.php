<?php
include_once("core/main.php");
include_once("modules/downloads/functions.php");
if( !check_module("downloads") ) die( "module not enabled" );

$index_page = false;
$page_name = $lang["DOWNLOAD_TITLE"];
$sitemap[] = array($lang["DOWNLOAD_TITLE"], "download.php");

//if ( $config["download_mcrypt"] && !isset($iv) ) {
//	$td = mcrypt_module_open (MCRYPT_BLOWFISH, "", MCRYPT_MODE_ECB, "");
//	$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
//}

//if ( !empty($QUERY_STRING) && strchr($REQUEST_URI,"?") ) {
//	//echo "$QUERY_STRING<br>";
//	$result = decrypt($QUERY_STRING);
//	//echo "$result<br>";
//	parse_str($result);
//}

if( isset($_GET["download"]) )
{
    $download = intval($_GET["download"]);
    $ret = db_query("select url from {$config["prefix"]}_downloads where id='$download'");
    $url = db_result($ret,0,0);
    db_free_result($ret);
    if( strlen(trim($url)) <= 0 ) print ERROR_07;
    else {
        @db_query("update {$config["prefix"]}_downloads set count=count+1 where id='$download'");
        Header("Location: $url");
    }
}

draw_header();

if( isset($_POST["ratedlsubmit"]) && $cfg["downloads"]["rating"] ) {
	$rating = intval($_POST["rating"]);
	if( $rating >= 1 && $rating <= 10 ) {
		$file = intval($_POST["ratedlsubmit"]);
		$ret = db_query("update {$config["prefix"]}_downloads set rate_sum = rate_sum + $rating, rate_count = rate_count + 1 where id=$file");
	}
}

if( isset($_GET["cat"]) ) draw_download_list();
else if( isset($_GET["file"]) ) draw_download_card();
else draw_download_categories();


/*
$dw_order = "";
if( isset($HTTP_GET_VARS["ord"]) )
{
    $ord=intval($HTTP_GET_VARS["ord"]);
    switch($ord)
    {
        case 1: $dw_order = "date DESC"; break;
        case 2: $dw_order = "size DESC"; break;
        case 3: $dw_order = "count DESC"; break;
        default: $dw_order = "name";
    }
} else {
    $ord = 1;
    $dw_order = "date DESC";
}
*/
//$ret = db_query("select count(*) from {$config["prefix"]}_downloads");
//$count = db_result($ret,0,0);

//if( isset($HTTP_GET_VARS["file"]) )
//	$file = $HTTP_GET_VARS["file"];

//if( $count > $config["download_max"] ) {
//	if( isset($numpage) && !isset($file) ) {
//			DrawDownloadFileList( $dw_order, $page );
//	} else {
//		if( isset($file) ) 
//			draw_download_card( $file );
//		else
//			DrawDownloadCatList( $dw_order );
//	}
//} else {
//	if( isset($HTTP_GET_VARS["file"]) ) draw_download_card( $HTTP_GET_VARS["file"] );
//	else draw_download_list( $dw_order );
//}

draw_footer();
?>
