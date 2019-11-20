<?
if (strstr($HTTP_SERVER_VARS["PHP_SELF"], "/modules/"))  die ("You can't access this file directly...");

if ($HTTP_POST_VARS['sString']) $sString = $HTTP_POST_VARS['sString'];
elseif ($HTTP_GET_VARS['sString']) $sString = $HTTP_GET_VARS['sString'];

theme_draw_box_open( $page_name, "100%" );
ForumSearch_Form();
forum_search($sString, $config["forum_search_type"]);

function forum_search($sString, $sType = 'AND') {
    global $config, $numpage, $total, $search, $order;
    if ( ($sType == "AND") OR ($sType == "OR") ) {
         $words = explode(" ", $sString);
         $clause = "(title LIKE '%$words[0]%' OR text LIKE '%$words[0]%')";
         array_shift($words); //remove the first word so that we don't have problems with the foreach-loop
         foreach($words as $word) {
           $clause .= " $sType (title LIKE '%$words[0]%' OR text LIKE '%$words[0]%')";
         }
    } else {
        $clause = "(title LIKE '%$words[0]%' OR text LIKE '%$words[0]%')";
        $words[0] = $sString;
    }

    if ( isset($order) && !empty($order) ) {
       switch( $order[0] ) {
           case 'A':
               $clause = $clause." ORDER BY title ";
               break;
           case 'B':
               $clause = $clause." ORDER BY date ";
			   break;
           case 'E':
               $clause = $clause." ORDER BY date_der ";
       }
       switch( $order[1] ) {
           case 'D':
               $clause = $clause." DESC ";
               break;
           case 'A':
               $clause = $clause." ASC ";
       }
    }

    $q = "SELECT cod, msg_ref, title, userid, text, date, forum FROM {$config["prefix"]}_forum_msgs WHERE ".$clause;
    if ($r = db_query($q)) {
        $nb = db_num_rows($r);
        echo $nb.' '.FORUM_FOUND.'<br><br>';
        ForumTopics_Header();
        while ( list($msg_cod, $msg_ref, $title, $user, $text, $date, $forum) = db_fetch_array( $r ) ) {
            $q_name = db_query("SELECT locked, allowed FROM {$config["prefix"]}_forums WHERE cod='$forum';");
            list($flocked, $allowed) = db_fetch_row($q_name);
            db_free_result($q_name);
            if ($flocked != 'Y' || forum_user_allowed($allowed)) {
                if ( $msg_ref ) $cod = $msg_ref;
                else $cod = $msg_cod;
                $n = 0;

                $q = db_query("SELECT views FROM {$config["prefix"]}_forum_msgs WHERE cod='$cod';");
                $views = db_result($q, 0, 0);
                db_free_result($q);

                $sql_rep = "SELECT COUNT(*) AS nb, max(date) FROM {$config["prefix"]}_forum_msgs WHERE msg_ref = $cod AND forum = $forum";
                $result_rep = db_query($sql_rep);
                list($nb_rep, $maxdate) = db_fetch_row($result_rep);
                db_free_result($result_rep);

                if (!isset($maxdate)) $maxdate = $date;

                $author = getNameById($user);
                $r_coeff = ($n++ % 2)+1; //gives 1 or 2 (for style 'row1' and 'row2')
                $arg = '&numpage='.$numpage.'&search='.$search.'&sString='.$sString.'&total='.$total.'#$msg_cod';
                ForumTopics_Item($cod,$arg,$forum,$title,$author,$date,$maxdate,$nb_rep,$r_coeff,$views);
            }
        }
        ForumTopics_Footer();
    } else {
        echo db_error();
    }
}
theme_draw_box_close();
?>
