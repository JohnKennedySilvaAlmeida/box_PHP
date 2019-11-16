CREATE TABLE `wt_config` (
  `id` varchar(20) NOT NULL default '',
  `config` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO wt_config VALUES("core", "a:22:{s:5:\"title\";s:12:\"phpWebThings\";s:3:\"url\";s:17:\"http://localhost/\";s:8:\"keywords\";s:22:\"php,mysql,phpwebthings\";s:11:\"description\";s:56:\"phpWebThings is an application to create a cool web site\";s:10:\"name_admin\";s:9:\"Webmaster\";s:10:\"mail_admin\";s:16:\"nobody@localhost\";s:4:\"lang\";s:4:\"enus\";s:5:\"theme\";s:2:\"bg\";s:8:\"show_map\";b:0;s:11:\"date_format\";s:6:\"fmtSQL\";s:16:\"email_activation\";b:1;s:13:\"mail_new_user\";b:1;s:14:\"page_processed\";b:1;s:7:\"avatars\";b:1;s:14:\"avatars_folder\";s:12:\"var/avatars/\";s:15:\"question1_small\";s:10:\"Desktop 0S\";s:13:\"question1_big\";s:31:\"OS used to <i>develop</i> sites\";s:16:\"question1_values\";s:41:\"Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other\";s:15:\"question2_small\";s:9:\"Server OS\";s:13:\"question2_big\";s:28:\"OS used as <i>web server</i>\";s:16:\"question2_values\";s:41:\"Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other\";s:13:\"sendmail_qtde\";s:3:\"300\";}");
INSERT INTO wt_config VALUES("modules", "a:14:{s:8:\"articles\";b:0;s:7:\"banners\";b:0;s:8:\"comments\";b:0;s:7:\"contact\";b:0;s:9:\"downloads\";b:0;s:4:\"faqs\";b:0;s:7:\"fileman\";b:0;s:5:\"forum\";b:0;s:5:\"links\";b:0;s:8:\"messages\";b:0;s:4:\"news\";b:0;s:8:\"picofday\";b:0;s:5:\"polls\";b:0;s:9:\"sideboxes\";b:0;}");

CREATE TABLE `wt_online` (
  `id` varchar(40) NOT NULL default '',
  `time` bigint(20) default NULL,
  `uid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `wt_users` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `class` enum('normal','admin') NOT NULL default 'normal',
  `realname` varchar(40) default NULL,
  `email` varchar(50) NOT NULL default '',
  `question1` varchar(20) NOT NULL default '',
  `question2` varchar(20) NOT NULL default '',
  `url` varchar(127) default NULL,
  `receivenews` enum('Y','N') NOT NULL default 'N',
  `receiverel` enum('Y','N') NOT NULL default 'N',
  `country` varchar(30) NOT NULL default '',
  `city` varchar(30) default NULL,
  `state` varchar(4) default NULL,
  `icq` varchar(12) default NULL,
  `aim` varchar(12) default NULL,
  `sex` enum('Male','Female') default NULL,
  `session` varchar(32) NOT NULL default '',
  `active` enum('Y','N') NOT NULL default 'N',
  `comments` mediumtext,
  `newsposted` int(10) unsigned NOT NULL default '0',
  `commentsposted` int(10) unsigned NOT NULL default '0',
  `faqposted` int(10) unsigned NOT NULL default '0',
  `topicsposted` int(10) unsigned NOT NULL default '0',
  `dateregistered` datetime NOT NULL default '0000-00-00 00:00:00',
  `dateactivated` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisit` datetime NOT NULL default '0000-00-00 00:00:00',
  `logins` int(10) unsigned NOT NULL default '0',
  `newemail` varchar(50) default NULL,
  `newemailsess` varchar(32) default NULL,
  `avatar` varchar(20) default NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `name` (`name`),
  KEY `listInd` (`country`,`name`)
) TYPE=MyISAM;

# Login: admin - Password: 123
INSERT INTO wt_users VALUES("1", "admin", "202cb962ac59075b964b07152d234b70", "admin", "Admin", "nobody@localhost.net", "Linux", "Linux", "", "N", "N", "Brazil", "", "", "", "", "Male", "b5c29a55c049824fd14d9430f3f6f5ce", "Y", "", "0", "0", "0", "0", "2002-10-16 01:21:56", "0000-00-00 00:00:00", "0000-00-00 00:00:00", "0", NULL, NULL, NULL);

CREATE TABLE `wt_user_access` (
  `userid` int(10) unsigned NOT NULL default '0',
  `module` char(20) NOT NULL default '',
  PRIMARY KEY  (`userid`,`module`)
) TYPE=MyISAM;

CREATE TABLE `wt_user_book` (
  `userid` int(10) unsigned NOT NULL default '0',
  `cod_user` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`userid`,`cod_user`)
) TYPE=MyISAM;

CREATE TABLE `wt_menu` (
  `pos` smallint(5) unsigned NOT NULL default '0',
  `title` varchar(30) NOT NULL default '',
  `url` varchar(127) NOT NULL default '',
  `type` enum('A','L','N') NOT NULL default 'A',
  PRIMARY KEY (`pos`)
) TYPE=MyISAM;