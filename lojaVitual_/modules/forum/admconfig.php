<?php
// This is the config file for the module
// the four lines below enable this module at the modules list
$config_var["modules"]["forum"]["type"] = "checkbox";
$config_var["modules"]["forum"]["desc"] = "Forums";
$config_var["modules"]["forum"]["default"] = true;
$config_var["modules"]["forum"]["obs"] = "Manage forums at your site.";

// these lines are for configuration of the current module

$config_var["forum"]["nbmess"]["type"] = "textbox";
$config_var["forum"]["nbmess"]["desc"] = "Number of messages per page";
$config_var["forum"]["nbmess"]["default"] = 8;
$config_var["forum"]["nbmess"]["obs"] = "A number between 8 and 20 is a good choice.";

$config_var["forum"]["search_type"]["type"] = "listbox";
$config_var["forum"]["search_type"]["desc"] = "Search type for the forum";
$config_var["forum"]["search_type"]["default"] = "AND";
$config_var["forum"]["search_type"]["obs"] = "EXACT lists a few hits, AND is a good choice, OR lists every message that has any of the words typed at the search box.";
$config_var["forum"]["search_type"]["values"] = "AND,OR,EXACT";

$config_var["forum"]["allow_anonymous"]["type"] = "checkbox";
$config_var["forum"]["allow_anonymous"]["desc"] = "Allow anonymous posts";
$config_var["forum"]["allow_anonymous"]["default"] = false;
$config_var["forum"]["allow_anonymous"]["obs"] = "It's better to let only registered users to post at the forums.";

$config_var["forum"]["anonymous"]["type"] = "textbox";
$config_var["forum"]["anonymous"]["desc"] = "How should we call anonymous users";
$config_var["forum"]["anonymous"]["default"] = "Anonymous";
$config_var["forum"]["anonymous"]["obs"] = "What's the name for the anonymous user? Guest, Anonymous?";

$config_var["forum"]["newest_first"]["type"] = "checkbox";
$config_var["forum"]["newest_first"]["desc"] = "List the newest message first";
$config_var["forum"]["newest_first"]["default"] = true;
$config_var["forum"]["newest_first"]["obs"] = "If unchecked, the messages are listed from the first one posted to the last one.";

$config_var["forum"]["show_locked_forums"]["type"] = "checkbox";
$config_var["forum"]["show_locked_forums"]["desc"] = "Show locked forums?";
$config_var["forum"]["show_locked_forums"]["default"] = true;
$config_var["forum"]["show_locked_forums"]["obs"] = "Do you want to show locked forums?";
?>