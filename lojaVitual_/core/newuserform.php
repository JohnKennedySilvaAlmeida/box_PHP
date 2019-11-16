<?
if (strstr($_SERVER["PHP_SELF"], "/core/"))  die ("You can't access this file directly...");
// try to limit the possible page to send

function create_userform( $formtype )
{
    global $userform, $lang, $config, $cfg, $lcountry;
    if ($formtype != "myaccount" && $formtype != "newuser") return;
    $userform = new phpform( "form_user", $formtype.".php" );
    $userform->add_textbox( "name", "* ".$lang["MYACCT_FORM_LOGIN"], 20, 20 );
    //if($nu_form_type=="myaccount") echo "readonly";

    $userform->add_textbox( "realname", $lang["MYACCT_FORM_REALNAME"], 20, 40 );
    $userform->add_password( "passwd1", "* ".$lang["MYACCT_FORM_PASSWD"], 20, 20 );
    $userform->add_password( "passwd2", "* ".$lang["MYACCT_FORM_PASSWD2"], 20, 20 );
    $userform->add_textbox( "email", "* ".$lang["MYACCT_FORM_EMAIL"], 40, 50 );
    $userform->add_static_listbox( "sex", $lang["MYACCT_FORM_SEX"], " ,Male,Female" );
    $qst1 = " ".$cfg["core"]["question1_values"];
    $userform->add_static_listbox( "question1", "* ".$cfg["core"]["question1_big"], $qst1 );
    $qst2 = " ".$cfg["core"]["question2_values"];
    $userform->add_static_listbox( "question2", "* ".$cfg["core"]["question2_big"], $qst2 );
    $userform->add_static_listbox( "country", "* ".$lang["MYACCT_FORM_COUNTRY"], $lcountry );
    $userform->add_textbox( "city", $lang["MYACCT_FORM_CITY"], 20, 30 );
    $userform->add_textbox( "state", $lang["MYACCT_FORM_STATE"], 4, 4 );
    $userform->add_checkbox( "receivenews", $lang["MYACCT_FORM_RCVNEWS"], "Y", "N" );
    $userform->add_checkbox( "receiverel", $lang["MYACCT_FORM_RCVREL"], "Y", "N" );
    $userform->add_textbox( "url", $lang["MYACCT_FORM_URL"], 50, 127 );
    $userform->add_textbox( "icq", "ICQ #", 20, 12 );
    $userform->add_textbox( "aim", "AIM #", 20, 12 );
    $userform->add_textarea( "comments", $lang["MYACCT_FORM_OBS"], 45, 5 );
}

function process_userform()
{
    global $userform;
    if( $userform->process() ) {
        reset( $userform->fields );
        while( $fld = each( $userform->fields ) )
        {
            $userform->fields[$fld[1]->field]->value = trim(strip_tags($fld[1]->value));
        }
        return true;
    }
    return false;
}

function draw_userform( $title )
{
    global $lang, $userform;
    theme_draw_centerbox_open( $title );
    $userform->draw_header();
?>
<table width="418" border=0 cellpadding=4 cellspacing=0 align="center">
    <tr>
        <td class="centerboxtext" colspan=2><?php echo $lang["MYACCT_TEXT"]; ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["name"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["realname"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["passwd1"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["passwd2"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["email"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["sex"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["question1"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["question2"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php $userform->fields["country"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["city"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["state"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php $userform->fields["receivenews"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php $userform->fields["receiverel"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php $userform->fields["url"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext"><?php $userform->fields["icq"]->draw(); ?></td>
        <td class="centerboxtext"><?php $userform->fields["aim"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2><?php $userform->fields["comments"]->draw(); ?></td>
    </tr>
    <tr>
        <td class="centerboxtext" colspan=2 align="right"><?php $userform->draw_submit( $lang["MYACCT_FORM_SUBMIT"] ); ?></td>
    </tr>
</table>
<?php
    $userform->draw_footer();
    theme_draw_centerbox_close();
}
?>
