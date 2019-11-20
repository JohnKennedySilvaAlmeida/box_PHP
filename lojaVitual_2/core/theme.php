<?php
if (strstr($_SERVER["PHP_SELF"], "/core/"))  die ("You can't access this file directly...");

if( !isset($cfg["core"]["theme"]) ) $cfg["core"]["theme"] = "bg";
require( "themes/{$cfg["core"]["theme"]}/th_functions.php" );

function draw_header_tag()
{
	print "<head>\n<title>";
	draw_page_title();
	print "</title>\n";
	theme_draw_style();
	draw_header_code();
	print "</head>\n";
}

function draw_page_title()
{
    global $page_name, $cfg;
    $txt = $cfg["core"]["title"];
    if( isset($page_name) ) $txt .= " - ".$page_name;
    print $txt;
}

function draw_header_code()
{
	global $lang, $cfg;
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$lang["CHARSET"]}\">\n"
		."<meta http-equiv=\"Generator\" content=\"phpWebThings 0.6\">\n"
		."<meta name=\"Keywords\" content=\"{$cfg["core"]["keywords"]}\">\n"
		."<meta name=\"Description\" content=\"{$cfg["core"]["description"]}\">\n";
}

function draw_copyright()
{
    global $cfg, $time_start, $lang;
    echo "&nbsp;This website was created with phpWebThings.";
    if( $cfg["core"]["page_processed"] )
printf( "<br><span class=\"pgprocessed\">&nbsp;&nbsp;{$lang["PAGE_PROCESSED"]}<br><br></span>",(getmicrotime() - $time_start));
else echo "&nbsp;";
}

function theme_draw_style()
{
	global $modules, $config, $cfg;
	
    print "<link href=\"themes/{$cfg["core"]["theme"]}/style.css\" rel=\"stylesheet\" type=\"text/css\">\n";
    print "<link href=\"themes/{$cfg["core"]["theme"]}/forms.css\" rel=\"stylesheet\" type=\"text/css\">\n";
    print "<link href=\"themes/{$cfg["core"]["theme"]}/lists.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	reset($modules);
	while( $mod = each($modules) ) {
		if( $mod[1] ) {
			if( $config["stylecss"][$mod[0]] ) {
				print "<link href=\"themes/{$cfg["core"]["theme"]}/{$mod[0]}.css\" rel=\"stylesheet\" type=\"text/css\">\n";
			}
		}
	}
}
?>
