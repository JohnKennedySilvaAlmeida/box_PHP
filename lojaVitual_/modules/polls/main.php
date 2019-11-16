<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

//if this module is enabled, this will tell phpwebthings that we are here
$modules["polls"]=true;
$config["admmenu"]["Polls"]["file"] = "adm_polls.php";
$config["admmenu"]["Polls"]["class"] = "polls";

$config["stylecss"]["polls"] = true;

if( !isset($cfg["polls"]["cookie_days"]) ) $cfg["polls"]["cookie_days"] = 7;

//include lang
include_once( "modules/polls/lang/msg_".check_lang($cfg["core"]["lang"]).".php" );

//Draws polls
function draw_poll()
{
    global $config, $lang;
    $date = date( "Y-m-d" );

    $ret = db_query("select * from {$config["prefix"]}_polls where '$date' between dtstart and dtend");
    if(!$ret) {
        print db_error();
        return;
    }

    $poll = db_fetch_array($ret);
    db_free_result($ret);
    if( !$poll ) return;
    
    // check cookie for poll
    $voted = false;
    if( isset( $_COOKIE["phpwebthings_poll"] ) ) {
        $voted = (intval($_COOKIE["phpwebthings_poll"]) == $poll["cod"]);
    }

    theme_draw_rightbox_open( $lang["POLL_TITLE"] );
    if( !$voted ) {
?>
<table width="100%" border=0 cellpadding=2 cellspacing=0>
<tr><td class="sideboxtext" colspan=2><?php echo $poll["question"]; ?></td></tr>
<form method="post" action="poll.php">
<input type="hidden" name="pollCod" value="<?php echo $poll["cod"]; ?>">
<tr><td class="sideboxtext" colspan=2>
<?php
    for($i=1;$i<=10;$i++) {
        $qst = sprintf( "item%02d", $i );
        if( strlen($poll[$qst]) > 0 ) {
            print "<input type=\"radio\" name=\"qpoll\" value=\"$i\" class=\"field_checkbox\">{$poll[$qst]}<br>\n";
        }
    }
?>
</td>
</tr>
<tr><td class="sideboxtext"><input type="submit" name="pollSubmit" value="<?php echo $lang["POLL_VOTE_BUTTON"]; ?>" class="button"></td>
<td class="sideboxtext" align="right"><a href="poll.php"><?php echo $lang["POLL_RESULTS_LINK"]; ?></a></td>
</tr>
</form>
</table>
<?php
    } else {
?>
<table width="100%" border=0 cellpadding=2 cellspacing=0>
<tr><td class="sideboxtext" colspan=2><?php echo $poll["question"]; ?></td></tr>
<?php
    for($i=1;$i<=10;$i++) {
        $qst = sprintf( "item%02d", $i );
        $qsc = sprintf( "count%02d", $i );
        if( strlen($poll[$qst]) > 0 ) {
            print "<tr><td class=\"sideboxtext\">{$poll[$qst]}</td>"
                ."<td class=\"sideboxtext\" align=\"right\" width=12>{$poll[$qsc]}</td></tr>\n";
        }
    }
?>
<tr><td class="sideboxtext" colspan=2 align="center"><a href="poll.php"><?php echo $lang["POLL_RESULTS_LINK"]; ?></a></td>
</tr>
</form>
</table>
<?php
    }
    theme_draw_rightbox_close();
}
?>