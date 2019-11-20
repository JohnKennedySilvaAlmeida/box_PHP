<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["downloads"]["type"] = "checkbox";
$config_var["modules"]["downloads"]["desc"] = "Downloads";
$config_var["modules"]["downloads"]["default"] = true;
$config_var["modules"]["downloads"]["obs"] = "Downloads manager.";

// these lines are for configuration of the current module

$config_var["downloads"]["dir"]["type"] = "textbox";
$config_var["downloads"]["dir"]["desc"] = "Files for add download";
$config_var["downloads"]["dir"]["default"] = "/files/";
$config_var["downloads"]["dir"]["obs"] = "Where download's module can get the files for the add download feature. Only files at the same server are allowable, also, the file must be acessed by the server using the same base url. Aways start the dir with a slash '/'.";

$config_var["downloads"]["rating"]["type"] = "checkbox";
$config_var["downloads"]["rating"]["desc"] = "Enable user ratings?";
$config_var["downloads"]["rating"]["default"] = true;
$config_var["downloads"]["rating"]["obs"] = "Gives the users ability to rate the downloads.";
?>