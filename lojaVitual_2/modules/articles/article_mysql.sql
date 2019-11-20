CREATE TABLE `wt_articlescat` (
  `cod` int(10) unsigned NOT NULL default '0',
  `category` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;

CREATE TABLE `wt_articles_title` (
  `article_id` int(10) unsigned NOT NULL auto_increment,
  `category` int(10) unsigned NOT NULL default '0',
  `title` varchar(80) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `userid` int(10) unsigned NOT NULL default '0',
  `views` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`article_id`),
  KEY `CatInd` (`category`,`date`)
) TYPE=MyISAM;

CREATE TABLE `wt_articles` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `article_id` int(10) unsigned NOT NULL default '0',
  `subtitle` varchar(127) default NULL,
  `page` tinyint(3) unsigned default '0',
  `text` longtext NOT NULL,
  `text_ori` longtext NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `ArticleInd` (`article_id`,`page`)
) TYPE=MyISAM;
