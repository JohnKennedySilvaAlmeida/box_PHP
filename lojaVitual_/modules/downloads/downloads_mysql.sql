CREATE TABLE `wt_downloadscat` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(80) NOT NULL default '',
  `descr` text NOT NULL,
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;

CREATE TABLE `wt_downloads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category` int(10) unsigned NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `size` int(10) unsigned NOT NULL default '0',
  `count` int(10) unsigned NOT NULL default '0',
  `rate_sum` int(10) unsigned NOT NULL default '0',
  `rate_count` int(10) unsigned NOT NULL default '0',
  `short_description` tinytext NOT NULL,
  `description` text NOT NULL,
  `small_picture` varchar(40) NOT NULL default 'none',
  `big_picture` varchar(40) NOT NULL default 'none',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) TYPE=MyISAM;