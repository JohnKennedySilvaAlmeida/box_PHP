CREATE TABLE wt_linkscat (
   cod int(10) unsigned NOT NULL auto_increment,
   name varchar(80) NOT NULL,
   parent int(10) unsigned,
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

