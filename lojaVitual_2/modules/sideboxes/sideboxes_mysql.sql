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