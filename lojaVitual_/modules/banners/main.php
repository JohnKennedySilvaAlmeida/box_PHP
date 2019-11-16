<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

//if this module is enabled, this will tell phpwebthings that we are here
$modules["banners"]=true;

$config["admmenu"]["Edit banners"] = array( "file"=>"adm_banner.php", "class"=>"banner" );
$config["admmenu"]["Banner Report"] = array( "file"=>"rep_banner.php", "class"=>"banner_report" );

$config["fileman"]["banners"] = array( "name"=>"Banners", "folder"=>"/modules/banners/images/" );

$config["stylecss"]["banners"] = false;

if( !isset($cfg["banners"]["log"]) ) $cfg["banners"]["log"] = false;

function draw_banner()
{
	global $config, $cfg;
	if( ($tot_banners = count_banners()) <= 0 )
	{
		print "&nbsp;";
		return;
	}
	if($tot_banners==1) $row_banner=0;
	else {
		mt_srand ((double) microtime() * 1000000);
		$row_banner = mt_rand(0, $tot_banners-1);
	}
	$ret = db_query( "select * from {$config["prefix"]}_banners where active='Y' limit $row_banner,1" );
	if( !$ret ) print "<span class=\"error\">Error showing banner:".db_error()."</span>";
	else {
		$banner = db_fetch_array($ret);
		db_free_result($ret);
		if( !empty($banner["code"]) )
		{
			print $banner["code"];
		} else if( !empty($banner["url_image"]) ) {
			print "<a href=\"banner.php?id=".$banner["cod"]."\" target=\"_blank\">"
			."<img src=\"".$banner["url_image"]."\" border=0></a>";
		} else {
			print "<a href=\"banner.php?id=".$banner["cod"]."\" target=\"_blank\">"
			."<img src=\"modules/banners/images/".$banner["image"]."\" border=0></a>";
		}
		db_query("update {$config["prefix"]}_banners set views=views + 1 where cod='{$banner["cod"]}'");
		if( $cfg["banners"]["log"] ) {
			db_query("insert delayed {$config["prefix"]}_banners_rawlog ( banner, type, date, session ) values "
				.sprintf( "( '%d', '%s', NOW(), '%s' )",
					$banner["cod"],
					"view",
					session_id()
				)
			);
		}
	}
}

function count_banners()
{
	global $lang, $config;
	$ret = db_query( "select count(*) from {$config["prefix"]}_banners where active='Y'" );
	if(!$ret)
	{
		print $lang["ERROR_06"]."<br>".db_error();
		return 0;
	}
	$num = db_result( $ret, 0, 0 );
	db_free_result( $ret );
	return $num;
}
?>