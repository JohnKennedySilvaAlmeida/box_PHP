<?php
$config_var["core"]["title"]["type"] = "textbox";
$config_var["core"]["title"]["desc"] = "Site title";
$config_var["core"]["title"]["default"] = "phpWebThings";
$config_var["core"]["title"]["obs"] = "The title that appears as the browser title";

$config_var["core"]["url"]["type"] = "textbox";
$config_var["core"]["url"]["desc"] = "Site url";
$config_var["core"]["url"]["default"] = "http://localhost/";
$config_var["core"]["url"]["obs"] = "The complete url where your site is, don't forget the trainling slash. This value will be used for e-mail activation, login validation and so on.";

$config_var["core"]["keywords"]["type"] = "textbox";
$config_var["core"]["keywords"]["desc"] = "Keywords";
$config_var["core"]["keywords"]["default"] = "php,mysql,phpwebthings";
$config_var["core"]["keywords"]["obs"] = "Some keywords to add to the meta tags at your site, and make some spiders happy.";

$config_var["core"]["description"]["type"] = "textbox";
$config_var["core"]["description"]["desc"] = "Description";
$config_var["core"]["description"]["default"] = "phpWebThings is an application to create a cool web site";
$config_var["core"]["description"]["obs"] = "A short description to appear at sites-search.";

$config_var["core"]["name_admin"]["type"] = "textbox";
$config_var["core"]["name_admin"]["desc"] = "Admin name";
$config_var["core"]["name_admin"]["default"] = "Webmaster";
$config_var["core"]["name_admin"]["obs"] = "The name that appears at the e-mail activation, sendemail admin function and some other places.";

$config_var["core"]["mail_admin"]["type"] = "textbox";
$config_var["core"]["mail_admin"]["desc"] = "Admin e-mail";
$config_var["core"]["mail_admin"]["default"] = "nobody@localhost";
$config_var["core"]["mail_admin"]["obs"] = "Admin e-mail, that will be used for all e-mails sent from this site.";

$config_var["core"]["lang"]["type"] = "listbox";
$config_var["core"]["lang"]["desc"] = "Site language";
$config_var["core"]["lang"]["default"] = "enus";
$config_var["core"]["lang"]["obs"] = "Choose the language for this site.";

// read drectory
$langs = "";
$dir = opendir("lang/") or die( $lang["ERROR_05"] );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") {
		if( ereg( "^msg_([a-z]+)\.php$", $file, $regs ) ) {
			if( !empty($langs) ) $langs .= ",";
			$langs .= $regs[1];
		}
	}
}
closedir($dir);
$config_var["core"]["lang"]["values"] = $langs;

$config_var["core"]["theme"]["type"] = "listbox";
$config_var["core"]["theme"]["desc"] = "Site theme";
$config_var["core"]["theme"]["default"] = "simple";
$config_var["core"]["theme"]["obs"] = "Choose the theme for this site.";
// read drectory
$themes = "";
$dir = opendir("themes/") or die( $lang["ERROR_05"] );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!=".." && $file != "CVS") {
		if( is_dir( "themes/".$file ) ) {
			if( file_exists( "themes/".$file."/main.php" ) ) {
				if( !empty($themes) ) $themes .= ",";
				$themes .= $file;
			}
		}
	}
}
closedir($dir);
$config_var["core"]["theme"]["values"] = $themes;

$config_var["core"]["show_map"]["type"] = "checkbox";
$config_var["core"]["show_map"]["desc"] = "Show map?";
$config_var["core"]["show_map"]["default"] = false;
$config_var["core"]["show_map"]["obs"] = "Should phpwebthings show the user where he is (ex: 'Home &gt; Forum &gt; Forum Name &gt; Topic')";

$config_var["core"]["date_format"]["type"] = "listbox";
$config_var["core"]["date_format"]["desc"] = "Date format";
$config_var["core"]["date_format"]["default"] = "fmtEUR";
$config_var["core"]["date_format"]["obs"] = "How should dates be formatted. (fmtSQL: yyyy-mm-dd, fmtEUR: dd/mm/yyyy, fmtUSA: mm/dd/yyyy).";
$config_var["core"]["date_format"]["values"] = "fmtSQL,fmtEUR,fmtUSA";

$config_var["core"]["email_activation"]["type"] = "checkbox";
$config_var["core"]["email_activation"]["desc"] = "E-mail activation?";
$config_var["core"]["email_activation"]["default"] = true;
$config_var["core"]["email_activation"]["obs"] = "Should the user activate his account in the e-mail?";

$config_var["core"]["mail_new_user"]["type"] = "checkbox";
$config_var["core"]["mail_new_user"]["desc"] = "Mail admin on new user?";
$config_var["core"]["mail_new_user"]["default"] = true;
$config_var["core"]["mail_new_user"]["obs"] = "Mail admin when a new user activate his account?";

$config_var["core"]["page_processed"]["type"] = "checkbox";
$config_var["core"]["page_processed"]["desc"] = "Page processed";
$config_var["core"]["page_processed"]["default"] = true;
$config_var["core"]["page_processed"]["obs"] = "Do you want to show the time spent for every page?";

$config_var["core"]["avatars"]["type"] = "checkbox";
$config_var["core"]["avatars"]["desc"] = "Avatars";
$config_var["core"]["avatars"]["default"] = true;
$config_var["core"]["avatars"]["obs"] = "Use avatars?";

$config_var["core"]["avatars_folder"]["type"] = "textbox";
$config_var["core"]["avatars_folder"]["desc"] = "Avatars folder";
$config_var["core"]["avatars_folder"]["default"] = "var/avatars/";
$config_var["core"]["avatars_folder"]["obs"] = "Where phpWebThings should store avatars images? phpWebThings should have access to write on this folder.";

$config_var["core"]["question1_small"]["type"] = "textbox";
$config_var["core"]["question1_small"]["desc"] = "Question1 - small";
$config_var["core"]["question1_small"]["default"] = "Desktop 0S";
$config_var["core"]["question1_small"]["obs"] = "Custom question to ask users when registering.";

$config_var["core"]["question1_big"]["type"] = "textbox";
$config_var["core"]["question1_big"]["desc"] = "Question1 - big";
$config_var["core"]["question1_big"]["default"] = "OS used to <i>develop</i> sites";
$config_var["core"]["question1_big"]["obs"] = "Custom question to ask users when registering.";

$config_var["core"]["question1_values"]["type"] = "textbox";
$config_var["core"]["question1_values"]["desc"] = "Question1 - Values";
$config_var["core"]["question1_values"]["default"] = "Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other";
$config_var["core"]["question1_values"]["obs"] = "Values for this question.";

$config_var["core"]["question2_small"]["type"] = "textbox";
$config_var["core"]["question2_small"]["desc"] = "Question2 - small";
$config_var["core"]["question2_small"]["default"] = "Server OS";
$config_var["core"]["question2_small"]["obs"] = "Custom question to ask users when registering.";

$config_var["core"]["question2_big"]["type"] = "textbox";
$config_var["core"]["question2_big"]["desc"] = "Question2 - big";
$config_var["core"]["question2_big"]["default"] = "OS used as <i>web server</i>";
$config_var["core"]["question2_big"]["obs"] = "Custom question to ask users when registering.";

$config_var["core"]["question2_values"]["type"] = "textbox";
$config_var["core"]["question2_values"]["desc"] = "Question2 - Values";
$config_var["core"]["question2_values"]["default"] = "Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other";
$config_var["core"]["question2_values"]["obs"] = "Values for this question.";

$config_var["core"]["sendmail_qtde"]["type"] = "textbox";
$config_var["core"]["sendmail_qtde"]["desc"] = "Sendmail - batch send";
$config_var["core"]["sendmail_qtde"]["default"] = 300;
$config_var["core"]["sendmail_qtde"]["obs"] = "How many e-mails send at each time. Keep this low if you're getting timeouts when sending e-mail using the sendmail adm script.";

// load modules configurations
$dir = opendir("modules/") or die( "No modules dir" );
while( ($file = readdir($dir))!==false )
{
    if($file!="." && $file!="..") {
        if( is_dir("modules/$file") ) {
            if( file_exists("modules/$file/admconfig.php") ) {
                include("modules/$file/admconfig.php");
            }
        }
    }
}
closedir($dir);
?>