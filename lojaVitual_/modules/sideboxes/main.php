<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

//if this module is enabled, this will tell phpwebthings that we are here
$modules["sideboxes"]=true;
$config["admmenu"]["Side Boxes"] = array( "file"=>"adm_sideboxes.php", "class"=>"sideboxes" );

$config["stylecss"]["sideboxes"] = false;

function draw_side_boxes($side)
{
	global $index_page, $config;
	$stmt = "select * from {$config["prefix"]}_sideboxes where side='$side'";
	if(!$index_page) $stmt .= " AND onlyindex=0";
	$stmt .= " order by pos";
	$ret = db_query($stmt);
	print db_error();
	while($row=db_fetch_array($ret))
	{
		if( $side == "left" ) theme_draw_leftbox_open( $row["title"] );
		else theme_draw_rightbox_open( $row["title"] );
		if( strlen($row["file"]) > 0 && $row["file"] != "none" && $row["file"] != "index"  )
		{
			include_once( "modules/sideboxes/files/{$row["file"]}.php" );
		}
		else
		{
			echo $row["content"];
		}
		if( $side == "left" ) theme_draw_leftbox_close( $row["title"] );
		else theme_draw_rightbox_close( $row["title"] );
	}
	db_free_result($ret);
}
?>