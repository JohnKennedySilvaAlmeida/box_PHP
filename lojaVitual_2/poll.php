<?php
include_once("core/main.php");
include_once("modules/polls/functions.php");

if( !check_module("polls") ) die( "module not enabled" );

// if modules comments is enabled, include its functions here
if( check_module("comments") )
{
	include_once( "modules/comments/functions.php" );
}

$index_page = false;
$page_name = "poll";

$strerr="";
$draw_polls = process_poll( $strerr );

draw_header();

if( isset($_GET["allpolls"]) ) draw_all_polls();
else {
    if( strlen($strerr) > 0 ) print "<div class=\"error\">$strerr</div>";
    if( $draw_polls ) draw_current_poll_result();
}
draw_footer();
?>
