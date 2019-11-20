/* new tables, only create them */

CREATE TABLE `wt_config` (
  `id` varchar(20) NOT NULL default '',
  `config` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

INSERT INTO wt_config VALUES("core", "a:22:{s:5:\"title\";s:12:\"phpWebThings\";s:3:\"url\";s:17:\"http://localhost/\";s:8:\"keywords\";s:22:\"php,mysql,phpwebthings\";s:11:\"description\";s:56:\"phpWebThings is an application to create a cool web site\";s:10:\"name_admin\";s:9:\"Webmaster\";s:10:\"mail_admin\";s:16:\"nobody@localhost\";s:4:\"lang\";s:4:\"enus\";s:5:\"theme\";s:2:\"bg\";s:8:\"show_map\";b:0;s:11:\"date_format\";s:6:\"fmtSQL\";s:16:\"email_activation\";b:1;s:13:\"mail_new_user\";b:1;s:14:\"page_processed\";b:1;s:7:\"avatars\";b:1;s:14:\"avatars_folder\";s:12:\"var/avatars/\";s:15:\"question1_small\";s:10:\"Desktop 0S\";s:13:\"question1_big\";s:31:\"OS used to <i>develop</i> sites\";s:16:\"question1_values\";s:41:\"Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other\";s:15:\"question2_small\";s:9:\"Server OS\";s:13:\"question2_big\";s:28:\"OS used as <i>web server</i>\";s:16:\"question2_values\";s:41:\"Linux,Windows,MAC/OS,OS/2,BeOS,Unix,Other\";s:13:\"sendmail_qtde\";s:3:\"300\";}");
INSERT INTO wt_config VALUES("modules", "a:14:{s:8:\"articles\";b:0;s:7:\"banners\";b:0;s:8:\"comments\";b:0;s:7:\"contact\";b:0;s:9:\"downloads\";b:0;s:4:\"faqs\";b:0;s:7:\"fileman\";b:0;s:5:\"forum\";b:0;s:5:\"links\";b:0;s:8:\"messages\";b:0;s:4:\"news\";b:0;s:8:\"picofday\";b:0;s:5:\"polls\";b:0;s:9:\"sideboxes\";b:0;}");

CREATE TABLE `wt_menu` (
  `pos` smallint(5) unsigned NOT NULL default '0',
  `title` varchar(30) NOT NULL default '',
  `url` varchar(127) NOT NULL default '',
  `type` enum('A','L','N') NOT NULL default 'A',
  PRIMARY KEY (`pos`)
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

CREATE TABLE `wt_picofdaycat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `description` mediumtext,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM;

INSERT INTO `wt_picofdaycat` VALUES (1,'General','Some general pictures');

CREATE TABLE `wt_forums_mod` (
  `forum` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `type` enum('allowed','moderator') NOT NULL default 'allowed',
  PRIMARY KEY (`forum`,`userid`,`type`)
) TYPE=MyISAM;

/* tables not changed */
/*
wt_online
wt_picofdaysel
wt_comments
wt_user_book
*/

/* modules not ported yet */
/*
wt_html_cat
wt_html
wt_words
wt_documents_categories
wt_documents
*/


/* convert these */

alter table `wt_link_cat` 
	rename `wt_linkscsat`,
	change category name varchar(80) NOT NULL;

alter table wt_links
	modify url varchar(127) NOT NULL,
	modify descr text NULL;

alter table wt_faq_topics
	change topic name varchar(80) NOT NULL default '';

alter table wt_faq
	add question_ori text NOT NULL after `active`,
	add answer_ori text NOT NULL after question;

alter table `wt_cat_dl` 
	rename `wt_downloadscat`,
	change category name varchar(80) NOT NULL default '';

alter table `wt_downloads` 
	modify `url` varchar(255) NOT NULL default '',
	add `rate_sum` int(10) unsigned NOT NULL default '0' after `count`,
	add `rate_count` int(10) unsigned NOT NULL default '0' after `rate_sum`;

rename table `wt_cat_news` to `wt_newscat`;

alter table wt_news
	add `text_ori` text after `text`,
	add `full_text_ori` text after `full_text`;
	
alter table `wt_banners`
	add `active` enum('Y','N') NOT NULL default 'N' after `name`,
	add `url_image` varchar(127) NOT NULL default '' after `image`,
	modify `url` varchar(127) NOT NULL default '';
update `wt_banners` set `active`='Y';

alter table `wt_picofday`
	add `category` int(10) unsigned NOT NULL default '0' after `id`;
update `wt_picofday` set category=1;

rename table `wt_boxes` to `wt_sideboxes`;

alter table `wt_polls`
	add `dtstart` date NOT NULL default '0000-00-00' after `cod`,
	add `dtend` date NOT NULL default '0000-00-00' after `dtstart`,
	drop `year`,
	drop `month`,
	drop `lastip`;

alter table `wt_user_access`
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`userid`,`module`),
	drop `id`,
	DROP INDEX `userid`;

alter table `wt_user_msgs`
	add `folder` enum('inbox','sent') NOT NULL default 'inbox' after `userid`;

rename table `wt_articles_cat` to `wt_articlescat`;

alter table `wt_articles_title`
	modify `date` date NOT NULL default '0000-00-00';

alter table `wt_articles`
	modify `text` longtext NOT NULL,
	add `text_ori` longtext NOT NULL after `text`;

alter table `wt_forums`
	drop allowed;

alter table `wt_forum_msgs`
	add `text_ori` text NOT NULL after `text`,
	drop `smileys`;

alter table `wt_users`
	modify `password` varchar(32) NOT NULL default '',
	modify `session` varchar(32) NOT NULL default '',
	add `topicsposted` int(10) unsigned NOT NULL default '0' after `faqposted`,
	modify `newemailsess` varchar(32) default NULL,
	add `avatar` varchar(20) default NULL after `newemailsess`;
update wt_users set `password` = MD5(`password`);
	
/* these aren't used anymore */
rename table wt_fileman_cat to delme_wt_fileman_cat;
