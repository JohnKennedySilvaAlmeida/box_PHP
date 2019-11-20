<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["polls"]["type"] = "checkbox";
$config_var["modules"]["polls"]["desc"] = "Polls";
$config_var["modules"]["polls"]["default"] = false;
$config_var["modules"]["polls"]["obs"] = "Creates and manages polls for the site.";

// these lines are for configuration of the current module
//$config_var["cfgmodule"]["polls"]["cookie_days"]["type"] = "textbox";
//$config_var["cfgmodule"]["polls"]["cookie_days"]["desc"] = "Cookie lifetime";
//$config_var["cfgmodule"]["polls"]["cookie_days"]["default"] = "7";
//$config_var["cfgmodule"]["polls"]["cookie_days"]["obs"] = "How many days the user that already voted should wait to vote again. When a new poll is started, this cookie will be invalid.";
$config_var["polls"]["cookie_days"]["type"] = "textbox";
$config_var["polls"]["cookie_days"]["desc"] = "Cookie lifetime";
$config_var["polls"]["cookie_days"]["default"] = "7";
$config_var["polls"]["cookie_days"]["obs"] = "How many days the user that already voted should wait to vote again. When a new poll is started, this cookie will be invalid.";

?>
