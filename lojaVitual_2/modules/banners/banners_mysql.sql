CREATE TABLE `wt_banners` (
  `cod` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `active` enum('Y','N') NOT NULL default 'N',
  `image` varchar(40) NOT NULL default '',
  `url_image` varchar(127) NOT NULL default '',
  `url` varchar(127) NOT NULL default '',
  `code` text,
  `views` int(10) unsigned NOT NULL default '0',
  `clicks` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cod`),
  KEY `activeInd` (`active`)
) TYPE=MyISAM;

CREATE TABLE `wt_banners_rawlog` (
  `banner` tinyint(3) unsigned NOT NULL default '0',
  `type` enum('view','click') NOT NULL default 'view',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `session` varchar(32) NOT NULL default '',
  KEY `bannerInd` (`banner`,`type`,`date`)
) TYPE=MyISAM;

CREATE TABLE `wt_banners_log` (
  `banner` tinyint(3) unsigned NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `views` int(10) unsigned NOT NULL default '0',
  `clicks` int(10) unsigned NOT NULL default '0',
  `sessions` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`banner`,`date`)
) TYPE=MyISAM; 