<?php
if (strstr($_SERVER["PHP_SELF"], "/admin/"))  die ("You can't access this file directly...");

require( "wt_config.php" );
require( "core/login.php" );
session_start();

if( !check_user_class( "admin" ) ) {
	Header( "Location: index.php" );
	exit;
}

require( "core/config_vars.php" );
if ( ($config["dbtype"] === "mysql") || ($config["dbtype"] === "pgsql") ) {
    require("core/{$config["dbtype"]}.lib.php");
} else {
    require("core/mysql.lib.php");
}


require( "phpdbform/phpdbform_form.php" );
$conn = db_connect($config["host"],$config["database"],$config["user"],$config["password"]) or die( db_error() );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>phpWebThings WebAdmin</title>
    <link href="admin/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="762" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#000000"><tr><td class="outframe">
<table width="760" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#FFFFFF">
<tr><td height="75" colspan="3" align="center" class="topbar">phpWebThings WebAdmin</td></tr>
<tr><td height="15" colspan="3" align="center">&nbsp;</td></tr>
<tr><td width=30>&nbsp;</td><td width="200" valign="top" class="leftpanel">
<?php
// list menu
reset($config_var);
while( $cfg = each($config_var) ) {
	echo "<a href=\"admin.php?page={$cfg[0]}&type=root\">{$cfg[0]}</a><br>";
//    if( $cfg[0] != "cfgmodule" ) echo "<a href=\"admin.php?page={$cfg[0]}&type=root\">{$cfg[0]}</a><br>";
//	else {
//		reset( $cfg[1] );
//		while( $mod = each($cfg[1]) ) {
//			echo "<a href=\"admin.php?page={$mod[0]}&type=module\">- {$mod[0]}</a><br>";
//		}
//	}
}
?>
</td><td width=530>
<?php
// check page
if( isset( $_GET["page"] ) ) {
    $page = strip_tags($_GET["page"]);
    if( !eregi("^[_a-z0-9-]+$", $page) ) $page = "core";
} else $page = "core";

// load config
$ret = db_query( "select * from {$config["prefix"]}_config where id='$page'" );
if( db_num_rows($ret) > 0 ) {
    $rcfg[db_result( $ret, 0, 0 )] = unserialize(stripslashes(db_result( $ret, 0, 1 )));
} else {
    $rcfg = 0;
}
db_free_result( $ret );

$form = new phpform( "admin_$page", "admin.php?page=$page" );

reset($config_var);
while( $cfg = each($config_var["$page"]) ) {

    $field = $cfg[0];
    $title = "<b>".$cfg[1]["desc"]."</b><br><i>".$cfg[1]["obs"]."</i>";
    $type = $cfg[1]["type"];

    switch( $type ) {
        case "textbox": $form->add_textbox( $field, $title, 50, 127 ); break;
        case "listbox": $form->add_static_listbox( $field, $title, $cfg[1]["values"] ); break;
        case "checkbox": $form->add_checkbox( $field, $title, true, false ); break;
    }
    $form->fields[$field]->value = $cfg[1]["default"];
    if( is_array($rcfg) ) $form->fields[$field]->value = $rcfg[$page][$field];
}

if( $form->process() ) {
    reset( $form->fields );
    $ncfg = array();
    while( $cfg = each($form->fields) ) {
        $ncfg[$cfg[1]->field] = $cfg[1]->value;
    }
    $tempcfg = serialize( $ncfg );
    if( is_array($rcfg) ) {
        $ret = db_query( "update {$config["prefix"]}_config set config='".addslashes($tempcfg)."' where id='$page'" );
    } else {
        $ret = db_query( "insert into {$config["prefix"]}_config (id, config) values ( '$page','".addslashes($tempcfg)."')" );
    }
    if( !$ret ) print db_error();
}
?>
<table width="450" border="0" cellspacing="0" cellpadding="2" align="center">
<?php
$form->draw_header();
reset($form->fields);
while( $field = each($form->fields) ) {
?>
<tr><td><?php $field[1]->draw(); print "<br><br>"; ?></td></tr>
<?php
}
?>
<tr><td><?php print "<br>"; $form->draw_submit( "Submit" ); ?></td></tr>
</table>
<?php

?>
</td></tr>
<tr><td height="15" colspan="3" align="right"><a href="index.php">Back to site</a></td></tr>
</table></td></tr></table>
</body>
</html>