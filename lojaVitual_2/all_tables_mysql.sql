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

CREATE TABLE wt_linkscat (
   cod int(10) unsigned NOT NULL auto_increment,
   name varchar(80) NOT NULL,
   descr text NOT NULL,
   PRIMARY KEY (cod)
) TYPE=MyISAM;

CREATE TABLE wt_links (
   id int(10) unsigned NOT NULL auto_increment,
   category int(10) unsigned DEFAULT '0' NOT NULL,
   name varchar(40) NOT NULL,
   url varchar(127) NOT NULL,
   count int(10) unsigned DEFAULT '0' NOT NULL,
   descr text NULL,
   PRIMARY KEY (id),
   KEY category (category)
) TYPE=MyISAM;

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

CREATE TABLE `wt_newscat` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `image` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;


INSERT INTO wt_newscat VALUES("1","phpdbform","box_phpdbform.jpg");
INSERT INTO wt_newscat VALUES("2","phpwebthings","earth.gif");
INSERT INTO wt_newscat VALUES("3","Linux","linux.gif");
INSERT INTO wt_newscat VALUES("4","Technology","computer.gif");

CREATE TABLE `wt_news` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `category` int(10) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(80) NOT NULL default '',
  `userid` int(10) unsigned NOT NULL default '0',
  `image` varchar(40) NOT NULL default 'none',
  `align` varchar(20)  DEFAULT 'left' NOT NULL,
  `active` char(1) NOT NULL default 'N',
  `counter` int(10) unsigned NOT NULL default '0',
  `text` text,
  `text_ori` text,
  `full_text` text,
  `full_text_ori` text,
  `archived` enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (`cod`),
  KEY `date` (`date`)
) TYPE=MyISAM;

INSERT INTO `wt_news` VALUES (1,4,'2002-11-19 01:55:00','Your new site is ready to go!',1,'taz.jpg','left','Y',10,'Ok, your new site is almost done! You are giving your users <b>a lot of tools</b> for interacting with your site and others users.<br />\r\n<br />\r\nThere is also a lot of tools for you, for managing the site and its <i>contents</i>!','Ok, your new site is almost done! You are giving your users [b]a lot of tools[/b] for interacting with your site and others users.\r\n\r\nThere is also a lot of tools for you, for managing the site and its [i]contents[/i]!','Here you can write the full story to show to the users, don\'t miss that!<br />\r\n<br />\r\nAnd of course! <b>Special tags are valid here</b> and when the news has a full text, you will know how interesting it is for your users, by seeing its counter!<br />\r\n<br />\r\nDon\'t forget to visit <a href=\"http://www.phpdbform.com\">http://www.phpdbform.com</a> for support and for sending new ideas.<br />\r\n<br />\r\n<b>Good luck on your new site!</b>','Here you can write the full story to show to the users, don\'t miss that!\r\n\r\nAnd of course! [b]Special tags are valid here[/b] and when the news has a full text, you will know how interesting it is for your users, by seeing its counter!\r\n\r\nDon\'t forget to visit [url]http://www.phpdbform.com[/url] for support and for sending new ideas.\r\n\r\n[b]Good luck on your new site![/b]','N');

CREATE TABLE `wt_picofdaycat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `description` mediumtext,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM;

INSERT INTO `wt_picofdaycat` VALUES (1,'General','Some general pictures');
INSERT INTO `wt_picofdaycat` VALUES (2,'Work','Pictures taken at work');

CREATE TABLE `wt_picofday` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `small_picture` varchar(40) NOT NULL default 'none',
  `big_picture` varchar(40) NOT NULL default 'none',
  `description` varchar(40) default NULL,
  `full_description` text,
  `views` int(10) unsigned NOT NULL default '0',
  `clicks` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `ClickInd` (`clicks`)
) TYPE=MyISAM;

INSERT INTO `wt_picofday` VALUES (1,1,1,'anothercat_s.jpg','anothercat_b.jpg','A cat','',86,12);
INSERT INTO `wt_picofday` VALUES (2,1,1,'flower_s.jpg','flower_b.jpg','flower','Trying to take a picture without shaking too much.',230,51);
INSERT INTO `wt_picofday` VALUES (3,1,1,'mycat_s.jpg','mycat_b.jpg','This is my cat','The cat was in the middle of the picture, but it run away at the shot.',424,2);
INSERT INTO `wt_picofday` VALUES (4,2,1,'mydesk_s.jpg','mydesk_b.jpg','My desk at office','This is my desk at my office. Well organized, right?',588,5);
INSERT INTO `wt_picofday` VALUES (5,2,1,'keyboard_s.jpg','keyboard_b.jpg','Point of view','',7,1);

CREATE TABLE `wt_picofdaysel` (
  `date` date NOT NULL default '0000-00-00',
  `picture_id` int(10) unsigned NOT NULL default '0',
  `views` int(10) unsigned NOT NULL default '0',
  `clicks` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`date`),
  KEY `picture_id` (`picture_id`)
) TYPE=MyISAM;

CREATE TABLE `wt_polls` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `dtstart` date NOT NULL default '0000-00-00',
  `dtend` date NOT NULL default '0000-00-00',
  `question` text NOT NULL,
  `item01` varchar(40) NOT NULL default '',
  `item02` varchar(40) NOT NULL default '',
  `item03` varchar(40) default NULL,
  `item04` varchar(40) default NULL,
  `item05` varchar(40) default NULL,
  `item06` varchar(40) default NULL,
  `item07` varchar(40) default NULL,
  `item08` varchar(40) default NULL,
  `item09` varchar(40) default NULL,
  `item10` varchar(40) default NULL,
  `count01` int(10) unsigned NOT NULL default '0',
  `count02` int(10) unsigned NOT NULL default '0',
  `count03` int(10) unsigned default '0',
  `count04` int(10) unsigned default '0',
  `count05` int(10) unsigned default '0',
  `count06` int(10) unsigned default '0',
  `count07` int(10) unsigned default NULL,
  `count08` int(10) unsigned default NULL,
  `count09` int(10) unsigned default NULL,
  `count10` int(10) unsigned default NULL,
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `dtstInd` (`dtstart`)
) TYPE=MyISAM;

CREATE TABLE `wt_sideboxes` (
  `cod` int(10) unsigned NOT NULL auto_increment,
  `pos` int(10) unsigned NOT NULL default '0',
  `side` varchar(5) NOT NULL default '',
  `onlyindex` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(80) NOT NULL default '',
  `content` text NOT NULL,
  `file` varchar(40) NOT NULL default 'none',
  PRIMARY KEY  (`cod`)
) TYPE=MyISAM;

INSERT INTO wt_sideboxes VALUES("2","1","left","0","Left box","You can add several boxes on the left","none");
INSERT INTO wt_sideboxes VALUES("3","1","right","0","More boxes","You can put a lot more on the right too!","");
INSERT INTO wt_sideboxes VALUES("6","10","right","1","Only at home","This box shows only at home-page!","");
INSERT INTO wt_sideboxes VALUES("1","99","right","0","Made with","<a href=\"http://www.phpdbform.com\">phpWebThings</a>","");
INSERT INTO wt_sideboxes VALUES("7","98","left","0","php code","","test");

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
