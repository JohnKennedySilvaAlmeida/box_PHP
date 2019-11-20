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