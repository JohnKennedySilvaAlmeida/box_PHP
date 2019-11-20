CREATE TABLE `wt_forums` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(80) NOT NULL default '',
  `descr` text,
  `locked` enum('Y','N') default 'N',
  PRIMARY KEY (`cod`)
) TYPE=MyISAM;

INSERT INTO `wt_forums` VALUES("1","Main Forum","This is the main forum, you can edit it to change its title and description, and you can create several new forums too.","N");

CREATE TABLE `wt_forums_mod` (
  `forum` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `type` enum('allowed','moderator') NOT NULL default 'allowed',
  PRIMARY KEY (`forum`,`userid`,`type`)
) TYPE=MyISAM;

CREATE TABLE `wt_forum_msgs` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `forum` int(10) unsigned NOT NULL default '0',
  `msg_ref` int(10) unsigned NOT NULL default '0',
  `date` datetime default NULL,
  `date_der` datetime default NULL,
  `userid` int(10) unsigned NOT NULL default '0',
  `views` int(10) unsigned NOT NULL default '0',
  `title` varchar(80) NOT NULL default '',
  `text` text NOT NULL,
  `text_ori` text NOT NULL,
  `closed` enum('Y','N') default 'N',
  PRIMARY KEY (`cod`),
  KEY `msg_ref`(`msg_ref`),
  KEY `categorie`(`forum`)
) TYPE=MyISAM;
