<?php

// functions for downloads
function draw_fileman_upload( $category )
{
    global $cfg, $lang;
    echo "<FORM ENCTYPE=\"multipart/form-data\" NAME=\"uploadform\" ACTION=\"adm_fileman.php?cat=$category\" METHOD=\"POST\">\n";
    echo "<INPUT TYPE=\"hidden\" name=\"upload_submit\" value=1>";
    echo "<INPUT TYPE=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$cfg["fileman"]["max_upload"]."\">\n".$lang["FILEMAN_UPLOAD"]."<br>";
    echo "<INPUT NAME=\"uploadedfile\" TYPE=\"file\" class=\"field_filebox\"><br><INPUT TYPE=\"submit\" name=\"upload\" VALUE=\"".$lang["FILEMAN_ULBUTTON"]."\" class=\"button\"></FORM>\n";
}

function draw_fileman_list( $category, $dirname )
{
    global $cfg,$lang;

    $dir = opendir(".".$dirname) or die( $lang["ERROR_05"] );
    
    echo "<table width=\"100%\" border=0 cellpadding=2 cellspacing=0><tr><td colspan=3 align=center class=\"centerboxtext\"><b>".$lang["FILEMAN_HEADER_1"].": ".$dirname."</b></td></tr>";
    echo "<tr><td class=\"centerboxtext\"><b>".$lang["FILEMAN_HEADER_2"]."</b></td><td align=\"right\" class=\"centerboxtext\"><b>".$lang["FILEMAN_HEADER_3"]."</b></td><td class=\"centerboxtext\">&nbsp;</td></tr>";
    while( $file = readdir($dir) ) // read dir contents in a loop
    {
        if( is_file(".".$dirname.$file) ) // don't list anything but files
        {
            $filedata = stat(".".$dirname.$file); // request some info about this file
            // Print file name, file size and "Delete" link
            echo "<tr><td class=\"centerboxtext\"><a href=\"".$cfg["core"]["url"].$dirname.$file."\" target=\"_blank\">".$file."</a></td><td align=\"right\" class=\"centerboxtext\">&nbsp;".$filedata[7]."</td>";
            echo "<td class=\"centerboxtext\">&nbsp;<a href=\"adm_fileman.php?cat=$category&del=$file\">".$lang["FILEMAN_DELETE"]."</a></td></tr>\n";
        }
    }
    closedir($dir);
    echo "</table>";
}
?>