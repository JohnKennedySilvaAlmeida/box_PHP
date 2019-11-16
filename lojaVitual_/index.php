<?php
include_once("core/main.php");

if( check_module("news") )
{
	include_once( "modules/news/functions.php" );
}
if( check_module("articles") )
{
	include_once( "modules/articles/functions.php" );
}

//$index_page = true;
$page_name = $lang["HOME_TITLE"];

draw_header();

theme_draw_centerbox_open( "It's working!" );
?>
Ok, phpwebthings is working. Edit your config.php to meet your needs and index.php to alter this text!<br><br><b>Good Luck!</b><br><b>Paulo Assis</b><br><br><br>
Certo, phpwebthings está funcionando (ou quase). Edite o arquivo config.php conforme suas necessidades e altere
o arquivo index.php para alterar este texto!<br><br>Obrigado!
<?php
theme_draw_centerbox_close();

if( check_module("news")) draw_news(true);
if( check_module("articles") ) list_articles_at_index();
// todo: && $config["articles_max_at_index"]) if($modules["articles"]) 

draw_footer();
?>