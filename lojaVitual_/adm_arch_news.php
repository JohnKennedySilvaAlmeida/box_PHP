<?
include_once("core/main.php");
// this is forced here for security reasons
if( !check_user_class($config["admmenu"]["Archive News"]["class"]) ) exit;
if( !check_module("news") ) die( "module not enabled" );

$index_page = false;
$page_name = "Archive News";

draw_header();

require_once("phpdbform/phpdbform_{$config["dbtype"]}.php");
//require_once("phpdbform/phpdbform_db.php");

//$db = new phpdbform_db( $config["database"], $config["host"], $config["user"], $config["password"] );
//$db->connect();

theme_draw_centerbox_open($page_name,"100%");

if( isset($_POST["arch_submit"]) )
{
    $stmt = "";
    if( isset($_POST["archtype"]) )
    {
        $archtype = intval( $_POST["archtype"] );
        if( $archtype == 1 ) {
            $thismonth = date( "Y-m-d", mktime (0,0,0,date("m")-1, date("d"),  date("Y")) );
            $stmt = "update {$config["prefix"]}_news set archived='Y' where date < '$thismonth'";
        } else if( $archtype == 2 ) {
            $thismonth = date( "Y-m-d", mktime (0,0,0,date("m")-2, date("d"),  date("Y")) );
            $stmt = "update {$config["prefix"]}_news set archived='Y' where date < '$thismonth'";
        } else if( $archtype == 3 ) {
            $before = trim(strip_tags($_POST["before_value"]));
            $thismonth = date( "Y-m-d", mktime (0,0,0,intval(substr($before,5,2)), intval(substr($before,8,2)), intval(substr($before,0,4)) ) );
            $stmt = "update {$config["prefix"]}_news set archived='Y' where date < '$thismonth'";
        }
        if( strlen($stmt) > 20 ) {
            db_query( $stmt );
            echo "<span class=\"info\">News archived</span>";
        }
    }
} else {
?>

<form method=post action="adm_arch_news.php">
<input type="hidden" name="arch_submit" value="1">
<table border=0 cellspacing=0 cellpadding=2>
<tr><td class="centerboxtext">
Archive news based on:<br>
<input type="radio" name="archtype" value="1" class="field_checkbox">One month ago<br>
<input type="radio" name="archtype" value="2" class="field_checkbox">Two months ago<br>
<input type="radio" name="archtype" value="3" class="field_checkbox">Before: (yyyy-mm-dd)
<input type="text" name="before_value" size="12" maxlength="10" class="field_textbox">
</td>
</tr>
</table>
<input type="Submit" name=submit value="Submit" class="button">
</form>
<?php
}
theme_draw_centerbox_close();
draw_footer();
?>