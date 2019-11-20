<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["picofday"]["type"] = "checkbox";
$config_var["modules"]["picofday"]["desc"] = "Pic of the Day";
$config_var["modules"]["picofday"]["default"] = false;
$config_var["modules"]["picofday"]["obs"] = "Show a new picture at a day.";

// these lines are for configuration of the current module
$config_var["picofday"]["picofpage"]["type"] = "checkbox";
$config_var["picofday"]["picofpage"]["desc"] = "Pic of Page bahavior";
$config_var["picofday"]["picofpage"]["default"] = false;
$config_var["picofday"]["picofpage"]["obs"] = "When enabled, pic of day will select a new picture for every page, instead of one per day.";

?>
