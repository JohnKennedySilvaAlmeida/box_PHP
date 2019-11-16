<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["banners"]["type"] = "checkbox";
$config_var["modules"]["banners"]["desc"] = "Banners";
$config_var["modules"]["banners"]["default"] = true;
$config_var["modules"]["banners"]["obs"] = "Manage banners at your site.";

// these lines are for configuration of the current module

$config_var["banners"]["log"]["type"] = "checkbox";
$config_var["banners"]["log"]["desc"] = "Generates log for each impression";
$config_var["banners"]["log"]["default"] = false;
$config_var["banners"]["log"]["obs"] = "This will with detailed log for your banners. If set to false, the banner module still increment views and clicks for each banner. Turning this on may generate a lot of data on your database.";
?>