<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

$modules["picofday"] = true;
include_once( "modules/picofday/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );
$config["menu"][80] = array( "title"=>$lang["PICOFDAY_TITLE"], "file"=> "picofday.php", "type"=>"A" );
$config["admmenu"]["Pictures Categories"] = array ( "file"=>"adm_picofdaycat.php", "class"=>"picofday" );
$config["admmenu"]["Pictures"] = array ( "file"=>"adm_picofday.php", "class"=>"picofday" );
$config["admmenu"]["Pictures report"] = array ( "file"=>"rep_picofday.php", "class"=>"picofday" );

$config["fileman"]["picofday"] = array( "name"=>"Pic of the Day", "folder"=>"/modules/picofday/images/" );

$config["stylecss"]["picofday"] = true;

if( !isset($cfg["picofday"]["picofpage"]) ) $cfg["picofday"]["picofpage"] = false;

function picofday_select()
{
    global $config, $cfg;
    $today = date( "Y-m-d" );
    $_SESSION["wt"]["pictureofday"] = -1;
    $_SESSION["wt"]["pictureofday_date"] = $today;

    $picture=-1;
	if( !$cfg["picofday"]["picofpage"] ) {
	    $ret = db_query( "select picture_id from {$config["prefix"]}_picofdaysel where date='$today'" );
	    if( db_num_rows($ret) > 0 ) $picture = db_result( $ret, 0, 0 );
	    db_free_result($ret);
	    if( $picture > -1 ) {
	        $_SESSION["wt"]["pictureofday"] = $picture;
	        return;
	    }
	}
	// no picture was select today...
    // select one

    $ret = db_query( "select count(*) from {$config["prefix"]}_picofday" );
    $tot_pictures = db_result( $ret, 0, 0 );
    db_free_result( $ret );
    // no pictures to display
    if( $tot_pictures == 0 ) return;
    // only one, select it
	if( !$cfg["picofday"]["picofpage"] ) {
	    if( $tot_pictures == 1 ) $row_picture = 0;
	    else {
	        mt_srand ((double) microtime() * 1000000);
	        $row_picture = mt_rand(0, $tot_pictures-1);
	    }
	    $ret = db_query( "select id from {$config["prefix"]}_picofday limit $row_picture,1" );
	    $_SESSION["wt"]["pictureofday"] = db_result( $ret, 0, 0 );
	    db_free_result( $ret );
	    db_query( "insert into {$config["prefix"]}_picofdaysel(date, picture_id) values( NOW(),'{$_SESSION["wt"]["pictureofday"]}' )" );
	    return;
	} else {
		// random pic of day, or pic of the page :)
		// store the number of rows when at picofpage mode
		$_SESSION["wt"]["pictureofday"] = $tot_pictures;
	}
}

function draw_picofday()
{
    global $config, $cfg, $lang;

    if( $_SESSION["wt"]["pictureofday"] == -1 ) return;

	if( !$cfg["picofday"]["picofpage"] ) {
	    $ret = db_query("select P.id, P.userid, U.name as username, P.small_picture, P.description from {$config["prefix"]}_picofday P left outer join {$config["prefix"]}_users U on (P.userid=U.uid) where P.id='{$_SESSION["wt"]["pictureofday"]}'");
	} else {
		// at picofpage mode
	    if( $_SESSION["wt"]["pictureofday"] == 1 ) $row_picture = 0;
	    else {
	        mt_srand ((double) microtime() * 1000000);
	        $row_picture = mt_rand(0, $_SESSION["wt"]["pictureofday"]-1);
	    }
	    $ret = db_query("select P.id, P.userid, U.name as username, P.small_picture, P.description from {$config["prefix"]}_picofday P left outer join {$config["prefix"]}_users U on (P.userid=U.uid) order by P.id limit $row_picture, 1");
	}			
    if(!$ret) {
        print db_error();
        return;
    }
    $pict = db_fetch_array($ret);
    db_free_result($ret);
    if( !$pict ) {
        //no picture
        print "Invalid picture";
        return;
    }
	theme_draw_rightbox_open( $lang["PICOFDAY_TITLE"] );
    print "<div align=\"center\" class=\"sideboxtext\"><a href=\"picofday.php?pic={$pict["id"]}\"><img src=\"modules/picofday/images/{$pict["small_picture"]}\" border=0 alt=\"{$lang["PICOFDAY_CLICK"]}\" width=130><br>{$pict["description"]}</a></div>"
		."<div align=\"center\" class=\"picofdayauthor\">{$lang["PICOFDAY_BY"]} <a href=\"user.php?uid={$pict["userid"]}\" class=\"picofdayauthorlink\">{$pict["username"]}</a></div>";
    db_query( "update {$config["prefix"]}_picofday set views=views+1 where id='{$pict["id"]}'" );
    if( !$cfg["picofday"]["picofpage"] )
		db_query( "update {$config["prefix"]}_picofdaysel set views=views+1 where date='{$_SESSION["wt"]["pictureofday_date"]}' and picture_id='{$pict["id"]}'" );
	theme_draw_rightbox_close();
}
?>