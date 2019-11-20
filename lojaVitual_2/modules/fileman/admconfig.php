<?php
// This is the config file for the module
// the four lines below enable this module at the modules list

$config_var["modules"]["fileman"]["type"] = "checkbox";
$config_var["modules"]["fileman"]["desc"] = "File Manager";
$config_var["modules"]["fileman"]["default"] = true;
$config_var["modules"]["fileman"]["obs"] = "Manage images for several modules.";

// these lines are for configuration of the current module

$config_var["fileman"]["max_upload"]["type"] = "textbox";
$config_var["fileman"]["max_upload"]["desc"] = "Max number of bytes allowable for upload";
$config_var["fileman"]["max_upload"]["default"] = 1000000;
$config_var["fileman"]["max_upload"]["obs"] = "Keep his value low, and beware that php also has a file size limit.";
?>