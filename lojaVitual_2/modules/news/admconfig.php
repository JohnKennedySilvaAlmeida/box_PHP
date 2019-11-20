<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["news"]["type"] = "checkbox";
$config_var["modules"]["news"]["desc"] = "News";
$config_var["modules"]["news"]["default"] = true;
$config_var["modules"]["news"]["obs"] = "Manage news at your site.";

// these lines are for configuration of the current module

$config_var["news"]["max_at_index"]["type"] = "textbox";
$config_var["news"]["max_at_index"]["desc"] = "Max news shown at index";
$config_var["news"]["max_at_index"]["default"] = 5;
$config_var["news"]["max_at_index"]["obs"] = "How many news items appear at the main page.";

$config_var["news"]["max_per_page"]["type"] = "textbox";
$config_var["news"]["max_per_page"]["desc"] = "Number of news items shown per page";
$config_var["news"]["max_per_page"]["default"] = 10;
$config_var["news"]["max_per_page"]["obs"] = "How many news items appear per page at the news page.";
?>