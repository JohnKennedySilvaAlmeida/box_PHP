CREATE TABLE `wt_faq_topics` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;

CREATE TABLE `wt_faq` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `topic` int(10) unsigned NOT NULL default '0',
  `uid` int(10) unsigned NOT NULL default '0',
  `active` char(1) NOT NULL default 'N',
  `question_ori` text NOT NULL,
  `question` text NOT NULL,
  `answer_ori` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY  (`cod`),
  KEY `topic` (`topic`)
) TYPE=MyISAM;