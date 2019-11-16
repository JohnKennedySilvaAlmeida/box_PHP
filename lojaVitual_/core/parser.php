<?php
// Copyright 2002 - Coral Informática Ltda
// processors for each tag
function pr_bold( &$text )
{
    $temp = "<b>".substr( $text, 3, strlen($text)-7 )."</b>";
    $text = $temp;
}

function pr_italic( &$text )
{
    $temp = "<i>".substr( $text, 3, strlen($text)-7 )."</i>";
    $text = $temp;
}

function pr_underline( &$text )
{
    $temp = "<u>".substr( $text, 3, strlen($text)-7 )."</u>";
    $text = $temp;
}

function pr_url( &$text )
{
    // Accepts [url]http://www.php.net[/url] or [url=http://www.php.net]phpSite[/utl]
    // check if there is a property
    if( $text[4] == "=" ) {
        // look for the closing end
        $pos = strpos( $text, "]" );
        if( $pos === false || $pos == strlen($text)-1 ) {
            $text = "**error**";
            return;
        }
        $url = substr( $text, 5, $pos-5 );
        $text = substr( $text, $pos+1, strlen($text)-($pos+2)-5 );
    } else if( $text[4] == "]" ) {
        $text = substr( $text, 5, strlen($text)-11 );
        $url = $text;
    } else {
        $text = "****error****";
        return;
    }
    if( substr( $url, 0, 7 ) != "http://" ) {
        $text = "****error****";
        return;
    }
    $temp = "<a href=\"$url\">$text</a>";
    $text = $temp;
}

function pr_quote( &$text )
{
    // remove the tags
    $text = substr( $text, 7, strlen($text)-15 );
    $temp = "<div>".$text."</div>";
    $text = $temp;
}

function pr_code( &$text )
{
    // remove the tags
    $text = substr( $text, 6, strlen($text)-13 );
    $temp = "<div align=\"left\" style=\"background-color: #FFCC99; font-family: 'Courier New', Courier, monospace; color: #000099; width: 90%;\">".$text."</div>";
    $text = $temp;
}

function pr_img( &$text )
{
    // Accepts [img]target to img[/img] or [img=Alternate text]target to img[/img]
    // check if there is a property
    if( $text[4] == "=" ) {
        // look for the closing end
        $pos = strpos( $text, "]" );
        if( $pos === false || $pos == strlen($text)-1 ) {
            $text = "**error**";
            return;
        }
        $alt = substr( $text, 5, $pos-5 );
        $url = substr( $text, $pos+1, strlen($text)-($pos+2)-5 );
    } else if( $text[4] == "]" ) {
        $url = substr( $text, 5, strlen($text)-11 );
        $alt = "";
    } else {
        $text = "****error****";
        return;
    }
    // checar se final é .jpg ou .gif ou .png ?
    $text = "<img src=\"$url\" alt=\"$alt\" border=0>";
}

// this array contains the processors for each tag:
$processors = array();
$processors["b"]["function"] = "pr_bold";
$processors["b"]["open_tag"] = "[b]";
$processors["b"]["close_tag"] = "[/b]";

$processors["i"]["function"] = "pr_italic";
$processors["i"]["open_tag"] = "[i]";
$processors["i"]["close_tag"] = "[/i]";

$processors["u"]["function"] = "pr_underline";
$processors["u"]["open_tag"] = "[u]";
$processors["u"]["close_tag"] = "[/u]";

$processors["url"]["function"] = "pr_url";
$processors["url"]["open_tag"] = "[url";
$processors["url"]["close_tag"] = "[/url]";

$processors["quote"]["function"] = "pr_quote";
$processors["quote"]["open_tag"] = "[quote]";
$processors["quote"]["close_tag"] = "[/quote]";

$processors["code"]["function"] = "pr_code";
$processors["code"]["open_tag"] = "[code]";
$processors["code"]["close_tag"] = "[/code]";

$processors["img"]["function"] = "pr_img";
$processors["img"]["open_tag"] = "[img";
$processors["img"]["close_tag"] = "[/img]";

function parse_tags3( &$text, &$err )
{
    global $processors;
    $end = false;
    $offset = 0;
	$safe = 0;
    $err = "";
	// this parser stores the tags in a one-dimension array
	// pos -> type, level, start, end
    $obj = array();
    $lvl = 0;
	$text = htmlspecialchars($text);
    while( !$end ) {
		if( $safe++ > 1000 ) return -1;
        $pos = strpos( $text, "[", $offset );
        if( $pos === false ) {
            $end = true;
            continue;
        }
        $offset = $pos+1;
        // Check if this isn't  a closing tag first
        if( $text[$pos+1] != "/" ) {
			// look for witch tag is this
            $type = "";
            reset( $processors );
            while( $k = each($processors) ) {
                $tag_size = strlen( $k[1]["open_tag"] );
                if( substr( $text, $pos, $tag_size ) == $k[1]["open_tag"] ) {
                    $type = $k[0];
                    break;
                }
            }
            if( $type != "" ) {
                //$dbg .= "level: $lvl - start --- type: $type pos: $pos<br>";
				// starting tags always opens a new tag
				$obj[] = array( 
					"type"  => $type,
					"level" => $lvl,
					"start" => $pos,
					"end"   => -1
				);
                $lvl++;
            }
        } else {
			// it is a closing tag
            // look what close tag is
            $type = "";
            reset( $processors );
            while( $k = each($processors) ) {
                $tag_size = strlen( $k[1]["close_tag"] );
                if( substr( $text, $pos, $tag_size ) == $k[1]["close_tag"] ) {
                    $type = $k[0];
                    break;
                }
            }
            if( $type != "" ) {
                if( $lvl == 0 ) {
                    $err = "<b>error:</b> premature end of tag<br>";
                    return -1;
                }
                $lvl--;
                //$dbg .= "level: $lvl - end --- type: $type pos: $pos<br>";
				// search for a tag at the same leve that is opened
				$found = false;
				reset( $obj );
				while( $k = each($obj) ) {
					if( $k[1]["type"] != $type ) continue;
					if( $k[1]["end"] != -1 ) continue;
					if( $k[1]["level"] != $lvl ) continue;
					$obj[$k[0]]["end"] = $pos 
						+ strlen($processors[$type]["close_tag"]);
					$found = true;
					break;
				}
				if( !$found ) {
					$err .= "<b>error:</b> opening tag not found for tag type $type<br>";
					return -1;
				}
				if( $lvl == 0 ) {
					// we closed a tag at level 0
					// let's convert it
			        $temp = substr( $text, $obj[0]["start"],
						$obj[0]["end"] - $obj[0]["start"] );
        			//$dbg .= $temp;
			        $processors[$obj[0]["type"]]["function"]( $temp );
			        //$dbg .= "<div>".htmlspecialchars($temp)."</div><br>";
//					echo "Start: {$obj[0]["start"]} End: {$obj[0]["end"]}<br>";
			        $text = substr_replace( $text, $temp, $obj[0]["start"],
						$obj[0]["end"] - $obj[0]["start"] );
					// reset the parser
					$offset = 0;
					$lvl = 0;
					$obj = array();
				}
            }
        }
    }
    $text = nl2br($text);
}
?>
