<?php
// functions for faq

function draw_faq_form($topic)
{
	global $lang;
	if( isset($_POST["faq_question"]) )
		$faq_question = trim(htmlspecialchars(delmagic($_POST["faq_question"])));
	else $faq_question = "";
	if( isset($_POST["faq_answer"]) )
		$faq_answer = trim(htmlspecialchars(delmagic($_POST["faq_answer"])));
	else $faq_answer = "";
    theme_draw_centerbox_open( $lang["FAQ_FORM_TITLE"] );
?>
<form method="post" action="faq.php?topic=<?php print intval($_GET["topic"]); ?>">
<input type=hidden name="faq_topic" value="<?php print $topic; ?>">
<?php print $lang["FAQ_FORM_QUESTION"]; ?><br>
<textarea cols=60 rows=10 name="faq_question" wrap class="field_textbox"><?php print $faq_question; ?></textarea>
<br><br><?php print $lang["FAQ_FORM_ANSWER"]; ?><br>
<textarea cols=60 rows=10 name="faq_answer" wrap class="field_textbox"><?php print $faq_answer; ?></textarea><br><br>
<input type=submit name="submit_faq" value="<?php print $lang["FAQ_FORM_SUBMIT"]; ?>" class="button">
</form>
<?php
    theme_draw_centerbox_close();
}

function draw_faq_list_topics()
{
    global $config, $lang;

    $ret = db_query("select count(*) as qtde, f.topic, t.name from {$config["prefix"]}_faq f left outer join {$config["prefix"]}_faq_topics t on (f.topic=t.cod) where f.active='Y' group by f.topic order by name");
	if( !$ret ) {
		print $lang["ERROR_04"].": ".db_error();
		return;
	}
    theme_draw_centerbox_open( $lang["FAQ_TOPICS"] );
?>
<table width="100%" border=0 cellpadding=2 cellspacing=0>
<tr>
	<td class="row0" width="400"><?php print $lang["FAQ_HEADER_1"]; ?></td>
	<td class="row0" width="40" align="right"><?php print $lang["FAQ_HEADER_2"]; ?></td>
</tr>
<?php
    // list topics
	$i = 0;
    while( $row=db_fetch_array($ret) )
    {
		$rclass = sprintf( "row%d", ($i++%2)+1 );
        print "<tr><td class=\"$rclass\"><a href=\"faq.php?topic=".$row["topic"]."\">".$row["name"]."</a></td>"
			."<td class=\"$rclass\" align=\"right\">{$row["qtde"]}</td></tr>\n";
    }
    db_free_result($ret);
    echo "</table>\n";
    theme_draw_centerbox_close(false);
}

function draw_faq_list()
{
	global $config, $lang;

	$topic = intval($_GET["topic"]);
	$ret = db_query("select cod, question from {$config["prefix"]}_faq where topic='$topic' AND active='Y' order by topic, cod");
	if( !$ret ) {
		print $lang["ERROR_04"].": ".db_error();
		return;
	}
	theme_draw_centerbox_open( $lang["FAQ_TITLE"]." - ".$lang["FAQ_QUESTIONS"] );
	print "<ul>";
	while( $row=db_fetch_array($ret) )
	{
		print "<li><a href=\"#".sprintf("faq%d",$row["cod"])."\">".$row["question"]."</a></li>\n";
	}
	print "</ul><br>";
	print "<a href=\"faq.php\">{$lang["FAQ_GOUP"]}</a><br>";
	theme_draw_centerbox_close();
	draw_faq( $topic );
}

function draw_faq( $topic )
{
	global $config, $lang;

	$ret = db_query("select F.*,U.name from {$config["prefix"]}_faq F left outer join {$config["prefix"]}_users U on (F.uid = U.uid) where F.topic='$topic' AND F.active='Y' order by F.topic,F.cod");
	if( !$ret ) {
		print $lang["ERROR_04"].": ".db_error();
		return;
	}

	theme_draw_centerbox_open( $lang["FAQ_TITLE"]." - ".$lang["FAQ_ANSWERS"] );

	// list faq
	while( $row=db_fetch_array($ret) )
	{
		print "<a name=\"faq1\" id=\"".sprintf("faq%d",$row["cod"])."\"></a>";
		print "<table width=\"100%\" border=0 cellpadding=2 cellspacing=0>";
		print "<tr><td class=\"faqquestion\">".$row["question"]."</td></tr>\n";
		print "<tr><td class=\"faqanswer\">".$row["answer"]."</td></tr>\n";
		print "<tr><td class=\"faqpostedby\" align=right>".$lang["FAQ_POSTED_BY"]." <a href=\"user.php?uid={$row["uid"]}\" class=\"faqpostedbylink\">{$row["name"]}</a></td></tr>\n";
		print "</table><br>\n";
	}
	db_free_result($ret);
	print "<br><a href=\"faq.php\">{$lang["FAQ_GOUP"]}</a>";

    theme_draw_centerbox_close();
    print "<br>";
    if( $_SESSION["wt"]["logged"] ) draw_faq_form($topic);
    else print "<div class=\"error\" align=center class=\"centerboxtext\">".$lang["NOT_LOGGED_FAQ"]."</div>";
}
?>