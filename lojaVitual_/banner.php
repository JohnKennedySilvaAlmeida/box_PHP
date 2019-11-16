<?php
$index_page = false;
$page_name = "banner";
include_once("core/main.php");
if( !check_module("banners") ) die( "module not enabled" );

if( isset($_GET["id"]) )
{
    $id = intval($_GET["id"]);
    $ret = db_query("select url from {$config["prefix"]}_banners where cod='$id'");
    $url = db_result($ret,0,0);
    db_free_result($ret);
    if( empty(trim($url)) ) print $lang["ERROR_06"];
    else {
        @db_query("update {$config["prefix"]}_banners set clicks=clicks+1 where cod='$id'");
		if( $cfg["banners"]["log"] ) {
			db_query("insert delayed {$config["prefix"]}_banners_rawlog ( banner, type, date, session ) values "
				.sprintf( "( '%d', '%s', NOW(), '%s' )",
					$id,
					"click",
					session_id()
				)
			);
		}
        Header("Location: $url");
    }
}
?>