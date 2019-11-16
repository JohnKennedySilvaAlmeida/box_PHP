<?php
// Paulo Assis <paulo@coral.srv.br>
// Functions for polls

//-----------------------------------------------------------------------------
// if this returns false, don't draw any poll.
// sets $strerr with the error, if any.
function process_poll( &$strerr )
{
    global $config, $cfg, $lang;

    if( !isset($_POST["pollCod"]) ) return true;
    if( !isset($_POST["qpoll"]) ) {
        $strerr = $lang["POLL_NOVALUE"];
        return false;
    }

    $qpoll = intval( $_POST["qpoll"] );
    $pollCod = intval( $_POST["pollCod"] );
    if( $qpoll < 1 || $qpoll > 10 ) {
        $strerr = "invalid value!";
        return false;
    }

    // get poll by cod
    $date = date( "Y-m-d" );
    $ret = db_query( "select * from {$config["prefix"]}_polls where cod=$pollCod and '$date' between dtstart and dtend" );
    if(!$ret) {
        $strerr = "Internal error: ".db_error();
        return false;
    }
    $poll = db_fetch_array( $ret );
    db_free_result( $ret );
    if( !$poll ) {
        $strerr = "poll not found or invalid code/date. Check if there is a valid poll for this period.";
        return false;
    }

    // check if voted
    $voted = false;
    if( isset( $_COOKIE["phpwebthings_poll"] ) ) {
        $voted = (intval($_COOKIE["phpwebthings_poll"]) == $poll["cod"]);
    }
    if( $voted ) {
        $strerr = $lang["POLL_VOTE_AGAIN"];
        return true;
    }

    //check if item is valid
    $qst = sprintf( "item%02d", $qpoll );
    if( strlen($poll[$qst]) <= 0 ) {
        $strerr = "Null value for this item";
        return false;
    }

    // set cookie
    setcookie( "phpwebthings_poll", $pollCod, time()+(86400*$cfg["polls"]["cookie_days"]) );
    //ok, vote now!
    $qst = sprintf( "count%02d", $qpoll );
    $ret = db_query( "update {$config["prefix"]}_polls set $qst=$qst+1 where cod='$pollCod'" );
    if( !$ret ) {
        $strerr = "Internal error: ".db_error();
        return false;
    }
    return true;
}

//-----------------------------------------------------------------------------
// draws the results table
function draw_poll_result( &$poll, $title="", $comments = false )
{
    global $lang;
    if( $title == "" ) $title = $lang["POLL_RESULT"];
    theme_draw_centerbox_open( $title );
    $tot = 0;
    for($i=1;$i<=10;$i++) {
        $qst = sprintf( "item%02d", $i );
        $cnt = sprintf( "count%02d", $i );
        if( strlen($poll[$qst]) > 0 ) $tot += $poll[$cnt];
    }
    $txt = "<table width=\"95%\" border=0 cellpadding=2 cellspacing=0 align=\"center\">"
      ."<tr><td class=\"pollq\" colspan=4>{$poll["question"]}</td></tr>"
      ."";
    for($i=1;$i<=10;$i++) {
        $qst = sprintf( "item%02d", $i );
        $cnt = sprintf( "count%02d", $i );
        if( strlen($poll[$qst]) > 0 ) {
          if( $tot == 0.00 ) $percent = 0.00;
          else $percent = ($poll[$cnt] / $tot) * 100.0;
          $txt .= "<tr><td class=\"polli\">{$poll[$qst]}</td>"
             ."<td class=\"polli\"><img src=\"modules/polls/poll_bar_left.png\">"
             ."<img src=\"modules/polls/poll_bar_mid.png\" height=10 width=".intval($percent*2).">"
             ."<img src=\"modules/polls/poll_bar_right.png\"></td>"
             ."<td class=\"polli\" align=\"right\">{$poll[$cnt]}</td>"
             ."<td class=\"polli\" align=\"right\">".number_format($percent,1,".",",")." %</td></tr>";
        }
    }
    $txt .= "<tr><td class=\"pollb\" colspan=2>Total...</td>"
         ."<td class=\"pollb\" align=\"right\">$tot</td>"
         ."<td class=\"pollb\" align=\"right\">100.0 %</td></tr></table>";
    print $txt;
    theme_draw_centerbox_close();
    if( $comments ) {
        echo "<div align=\"center\"><a href=\"poll.php?allpolls=1\">{$lang["POLL_ALLPOLLS"]}</a></div>";
        if( check_module("comments") ) {
            process_comments( 2, $poll["cod"]  );
            draw_comments( 2, $poll["cod"], "poll.php" );
        }
    }
}

//-----------------------------------------------------------------------------
// draws the results table
function draw_current_poll_result()
{
    global $config;
    $date = date( "Y-m-d" );

    $ret = db_query( "select * from {$config["prefix"]}_polls where '$date' between dtstart and dtend" );
    if(!$ret) {
        print db_error();
        return;
    }

    $poll = db_fetch_array($ret);
    db_free_result($ret);
    if( $poll ) {
        draw_poll_result( $poll, "", true );
    }
}

//-----------------------------------------------------------------------------
// draws the results table
function draw_all_polls()
{
    global $config;

    $ret = db_query("select * from {$config["prefix"]}_polls order by dtend desc");
    if(!$ret) {
        print db_error();
        return;
    }

    while( $poll = db_fetch_array($ret) ) {
        draw_poll_result( $poll, show_date( $poll["dtstart"], false )." - ".show_date( $poll["dtend"], false ) );
    }
    db_free_result($ret);
}
?>