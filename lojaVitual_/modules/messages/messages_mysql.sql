CREATE TABLE `wt_user_msgs` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `folder` enum('inbox','sent') NOT NULL default 'inbox',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_from` int(10) unsigned NOT NULL default '0',
  `title` varchar(80) NOT NULL default '',
  `msg_read` tinyint(3) unsigned NOT NULL default '0',
  `text` text NOT NULL,
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;