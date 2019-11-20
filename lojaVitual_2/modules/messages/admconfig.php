<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["messages"]["type"] = "checkbox";
$config_var["modules"]["messages"]["desc"] = "User Messages";
$config_var["modules"]["messages"]["default"] = true;
$config_var["modules"]["messages"]["obs"] = "Enable private messages between users.";

// these lines are for configuration of the current module

$config_var["messages"]["max_size"]["type"] = "textbox";
$config_var["messages"]["max_size"]["desc"] = "Max size, in bytes, allowable for each user's box.";
$config_var["messages"]["max_size"]["default"] = 300000;
$config_var["messages"]["max_size"]["obs"] = "Setting this with a minimum of 10kb (10,000) is a good choice. (not implemented yet)";

$config_var["messages"]["mailmsg"]["type"] = "checkbox";
$config_var["messages"]["mailmsg"]["desc"] = "Send e-mail when a user receives a message.";
$config_var["messages"]["mailmsg"]["default"] = true;
$config_var["messages"]["mailmsg"]["obs"] = "This will send an e-mail to the recipient of the message. (not implemented yet)";
?>