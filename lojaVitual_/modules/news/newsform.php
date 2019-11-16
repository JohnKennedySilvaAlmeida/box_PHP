<?php
if (strstr($_SERVER["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");
$readonly = check_user_class("news")?"":"readonly";
$disabled = check_user_class("news")?"":"disabled";
?>
<form method="post" action="adm_news2.php">
<input type="hidden" name="nw_action" value="<?php echo $nw_action; ?>">
<input type="hidden" name="nw_cod" value="<?php echo $nw_cod; ?>">
<input type="hidden" name="form_submit" value="ok">
<table width="200" border=0 cellpadding=2 cellspacing=0 align="center">
    <tr>
        <td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_TITLE"]; ?><br><input type="text" name="nw_title" size=60 maxlength=80 value="<? echo htmlspecialchars($nw_title); ?>" class="field_textbox"></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_UID"]; ?><br><select name="nw_userid"  <?php echo $disabled; ?> class="field_selectbox">
<?php
$ret=db_query( "select uid, name, realname from {$config["prefix"]}_users order by name" );
while( $row = db_fetch_array($ret) )
{
    $selected = ($row["uid"]==$nw_userid)?"selected":"";
    echo "\t\t\t<option value=\"{$row["uid"]}\" $selected>{$row["name"]} - {$row["realname"]}</option>\n";
}
db_free_result($ret);
?>
        </select></td>
	</tr>
	<tr>
        <td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_DATE"]; ?><br><input type="text" name="nw_date" size=20 maxlength=20 value="<? echo htmlspecialchars($nw_date); ?>" <?php echo $readonly; ?> class="field_textbox">
</td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php echo $lang["NEWS_FIELD_IMAGE"]; ?><br><select name="nw_image" class="field_selectbox">
            <option value="none"><?php echo $lang["OPTION_NONE"]; ?></option>
<?php
$dir = opendir("modules/news/images/") or die($lang["ERROR_05"]);
while( ($file = readdir($dir))!==false )
{
    $selected = ($file==$nw_imge)?"selected":"";
    if($file!="." && $file!=".." && $file!="CVS") echo "\t\t\t<option value=\"$file\" $selected>$file</option>\n";
}
closedir($dir);
?>
        </select></td>
        <td class="centerboxtext"><?php echo $lang["NEWS_FIELD_ALIGN"]; ?><br><select name="nw_align" class="field_selectbox">
<?php
$aligns = array( "left", "right", "top", "middle", "bottom" );
while( $align = each($aligns) ) {
    $selected = ($align[1]==$nw_align)?"selected":"";
    echo "\t\t\t<option value=\"{$align[1]}\" $selected>{$align[1]}</option>\n";
}
//closedir($dir);
?>
        </select></td>
    </tr>        
    <tr>    
        <td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_CAT"]; ?><br><select name="nw_cat" class="field_selectbox">
<?php
$ret=db_query( "select cod,name from {$config["prefix"]}_newscat order by name" );
while( $row = db_fetch_array($ret) )
{
    $selected = ($row["cod"]==$nw_cat)?"selected":"";
    echo "\t\t\t<option value=\"{$row["cod"]}\" $selected>{$row["name"]}</option>\n";
}
db_free_result($ret);
?>
        </select></td>
    </tr>
    <tr>
<?php $checked = ($nw_active=='Y')?"checked":""; ?>
        <td class="centerboxtext"><input type="checkbox" name="nw_active" value="Y" <?php echo $checked; ?>  <?php echo $disabled; ?> class="field_checkbox">&nbsp;<?php echo $lang["NEWS_FIELD_ACTIVE"]; ?></td>
<?php $checked = ($nw_archived=='Y')?"checked":""; ?>
        <td class="centerboxtext"><input type="checkbox" name="nw_archived" value="Y" <?php echo $checked; ?>  <?php echo $disabled; ?> class="field_checkbox">&nbsp;<?php echo $lang["NEWS_FIELD_ARCHIVED"]; ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_TEXT"]; ?><br><textarea cols=60 rows=10 name="nw_text" wrap class="field_textbox"><? echo htmlspecialchars($nw_text); ?></textarea></td>
    </tr>
    <tr><td class="centerboxtext" colspan=2><?php echo $lang["NEWS_FIELD_FULL_TEXT"]; ?><br><textarea cols=60 rows=10 name="nw_full_text" wrap class="field_textbox"><? echo htmlspecialchars($nw_full_text); ?></textarea></td>
    </tr>
    <tr><td class="centerboxtext"><input type=submit name="submit_news" value="<?php echo $lang["NEWS_SUBMIT_TITLE"]; ?>" class="button"></td><td class="centerboxtext" align="right"><?php if( isset($_GET["edit"]) ) { ?><input type=submit name="delete_news" value="<?php echo $lang["NEWS_DELETE_TITLE"]; ?>" class="button"</b><?php } else print "&nbsp;";?></td>
    </tr>
</table>
</form>