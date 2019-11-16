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