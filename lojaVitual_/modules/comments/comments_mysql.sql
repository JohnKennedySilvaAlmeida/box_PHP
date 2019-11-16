CREATE TABLE `wt_comments` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `type` tinyint(3) unsigned NOT NULL default '0',
  `link` int(10) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `userid` int(10) unsigned NOT NULL default '0',
  `comment` text NOT NULL,
  PRIMARY KEY  (`cod`),
  KEY `MainInd` (`type`,`link`,`date`)
) TYPE=MyISAM;