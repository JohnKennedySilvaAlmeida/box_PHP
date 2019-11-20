<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["articles"]["type"] = "checkbox";
$config_var["modules"]["articles"]["desc"] = "Articles";
$config_var["modules"]["articles"]["default"] = true;
$config_var["modules"]["articles"]["obs"] = "Manage articles at your site.";

// these lines are for configuration of the current module

$config_var["articles"]["max_at_index"]["type"] = "textbox";
$config_var["articles"]["max_at_index"]["desc"] = "Max articles shown at index";
$config_var["articles"]["max_at_index"]["default"] = 5;
$config_var["articles"]["max_at_index"]["obs"] = "How many articles appear at the main page.";
?>