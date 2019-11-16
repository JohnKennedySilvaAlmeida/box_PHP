<?php
include_once("core/main.php");

$index_page = false;
$page_name = $lang["STATS_TITLE"];
//$sitemap[] = array(STATS_TITLE, "stats.php");

draw_header();
theme_draw_centerbox_open( $lang["STATS_TITLE"] );
?>
<table width="100%" border=0 cellspacing=0 cellpadding=0>
<tr>
    <td align="center" valign="top" class="centerboxtext"><br>
<?php
    // Registered users
    $ret = db_query( "select count(uid) from {$config["prefix"]}_users" );
    $tot_users = db_result( $ret, 0, 0 );
    db_free_result($ret);
    $ret = db_query( "select count(uid) from {$config["prefix"]}_users where active='Y'" );
    $tot_active = db_result( $ret, 0, 0 );
    db_free_result($ret);
?>
<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $lang["STATS_USERS"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
    <table width="100%" border=0 cellspacing=0 cellpadding=0>
        <tr><td class="plainboxtext"><?php echo $lang["STATS_ACTIVE"]; ?></td>
            <td align="right" class="plainboxtext"><?php echo $tot_active; ?></td>
        </tr>
        <tr><td class="plainboxtext"><?php echo $lang["STATS_NOTACTIVE"]; ?></td>
            <td align="right" class="plainboxtext"><?php echo ($tot_users-$tot_active); ?></td></tr>
        <tr><td class="plainboxtext"><b><?php echo $lang["STATS_TOTAL"]; ?></b></td>
            <td align="right" class="plainboxtext"><b><?php echo $tot_users; ?></b></td>
        </tr>
    </table>
    </td>
</tr>
</table>
</td><td align="center" valign="top" class="centerboxtext"><br>

<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $lang["STATS_TOPTEN"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
<?php
    //country
    switch ( $config["dbtype"] ) {
    	case 'mysql':
    		$ret = db_query( "select country,count(uid) as tot from {$config["prefix"]}_users where active='Y' group by country order by tot DESC limit 0,10" );
    		break;
    	case 'pgsql':
    		$ret = db_query( "select country,count(uid) as tot from {$config["prefix"]}_users where active='Y' group by country order by tot DESC limit 10,0" );
    }

    echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
    while( $row = db_fetch_array($ret) )
    {
      echo "<tr><td class=\"plainboxtext\">{$row["country"]}</td>"
          ."<td align=\"right\" class=\"plainboxtext\">{$row["tot"]}</td></tr>";
    }
    echo "</table>";
    db_free_result($ret);
?>
    </td>
</tr>
</table>

</td></tr><tr><td align="center" valign="top" class="centerboxtext"><br>

<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $cfg["core"]["question1_small"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
<?php
    //questions
    $ret = db_query("SELECT question1, count(uid) AS tot FROM {$config["prefix"]}_users WHERE active='Y' GROUP BY question1 ORDER BY tot DESC" );
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    while( $row = db_fetch_row($ret) )
    {
        echo "<tr><td class=\"plainboxtext\">{$row[0]}</td>"
          ."<td align=\"right\" class=\"plainboxtext\">{$row[1]}</td></tr>";
    }
    echo "</table>";
    db_free_result($ret);
?>
    </td>
</tr>
</table>
</td><td align="center" valign="top" class="centerboxtext"><br>

<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $cfg["core"]["question2_small"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
<?php
    $ret = db_query("SELECT question2, count(uid) AS tot FROM {$config["prefix"]}_users WHERE active='Y' GROUP BY question2 ORDER BY tot DESC" );
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    while( $row = db_fetch_row($ret) ) {
      echo "<tr><td class=\"plainboxtext\">{$row[0]}</td>"
          ."<td align=\"right\" class=\"plainboxtext\">{$row[1]}</td></tr>";
    }
    echo "</table>";
    db_free_result($ret);
?>
    </td>
</tr>
</table>
</td></tr><tr><td align="center" valign="top" class="centerboxtext"><br>


<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $lang["STATS_LAST_WEEK"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
<?php
    // last 7 days registered
    $utoday = time();
    $today = date( "Y-m-d", $utoday );
    $lastweek = date( "Y-m-d", mktime (0,0,0,date("m",$utoday), date("d",$utoday)-7,  date("Y",$utoday)) );
    $total = 0;

    switch($config["dbtype"]) {
        case 'mysql':
            $ret = db_query( "select DATE_FORMAT(dateregistered,'%Y-%m-%d') as date, count(uid)as qtde from {$config["prefix"]}_users where dateregistered between '$lastweek' and '$today' group by date order by dateregistered desc" ); break;
        case 'pgsql':
            $ret = db_query( "select to_char(dateregistered,'YYYY-MM-DD') as date, count(uid)as qtde from {$config["prefix"]}_users where dateregistered between '$lastweek' and '$today' group by dateregistered order by dateregistered desc" ); break;
    }

    echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
    while( $row = db_fetch_array($ret) )
    {
        echo "<tr><td class=\"plainboxtext\">".show_date($row["date"])."</td>"
            ."<td align=\"right\" class=\"plainboxtext\">{$row["qtde"]}</td></tr>";
        $total += $row["qtde"];
    }
    echo "<tr><td class=\"plainboxtext\"><b>".$lang["STATS_TOTAL"]."</b></td>"
        ."<td align=\"right\" class=\"plainboxtext\"><b>{$total}</b></td></tr>";
    echo "</table>";
    db_free_result($ret);
?>
    </td>
</tr>
</table>
</td><td align="center" valign="top" class="centerboxtext"><br>

<table width=160 border=0 cellspacing=0 cellpadding=2>
<tr><td class="plainboxtitle" align="center"><?php echo $lang["STATS_LAST_MONTHS"]; ?></td></tr>
<tr>
    <td class="plainboxtext">
<?php
    // last 3 months registered
    $utoday = time();
    $today = date( "Y-m-d", $utoday );
    $last3month = date( "Y-m-d", mktime (0,0,0,date("m",$utoday)-2, 1,  date("Y",$utoday)) );
    $total = 0;

    switch($config["dbtype"]) {
        case 'mysql':
            $ret = db_query( "select MONTHNAME(dateregistered) as date, count(uid) as qtde from {$config["prefix"]}_users where dateregistered between '$last3month' and '$today' group by date order by dateregistered desc" ); break;
        case 'pgsql':
            $ret = db_query( "select to_char(dateregistered,'Mon') as date, count(uid) as qtde from {$config["prefix"]}_users where dateregistered between '$last3month' and '$today' group by date order by date desc" ); break;
    }

    echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
    while( $row = db_fetch_array($ret) )
    {
        echo "<tr><td class=\"plainboxtext\">{$row["date"]}</td>"
            ."<td align=\"right\" class=\"plainboxtext\">{$row["qtde"]}</td></tr>";
        $total += $row["qtde"];
    }
    echo "<tr><td class=\"plainboxtext\"><b>".$lang["STATS_TOTAL"]."</b></td>"
        ."<td align=\"right\" class=\"plainboxtext\"><b>{$total}</b></td></tr>";
    echo "</table>";
    db_free_result($ret);
?>
    </td>
</tr>
</table>
</td></tr></table>
<?php
theme_draw_centerbox_close();
draw_footer();
?>
