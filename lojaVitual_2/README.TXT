INSTALL - test version
-----------------------------

This is the test version for the upcoming new release 0.6.
Now phpWebThings follows some guidelines for development:

- Using superglobals ($_GET, $_POST, $_SESSION);
- no warnings should be displayed;
- web based configuration
- the langs now are an array instead of several defines,
	this should make easier to develop a script to check
	for missing translations;
- every module can add a style.css at main.php withou tricks;
- the menu is database driven now (but the default ones).

Because of some sessions issues, missing checks for configuration
and several others issues, I decided to stop the 0.5 release at
test7, and started 0.6 from the scratch. Then I began porting
the modules for the new standard, changing every access to 
globals into super globals, that is more secure.

This version uses the new phpdbform-0.4.2, fixing
internationalization issues, also as phpdbform uses
style for its forms and for right display at adm fields,
these classes were added to phpWebThings theme.

The theme has changed too, now it's the file main.php that
render the site, and following the example, themes are
much easier to develop now. I hope so.


INSTALLATION:
-------------

First unzip or untar the file to a directory of you choice,
create a database at your mysql and execute the script webthings_mysql.php
on it. 

If you will use all modules installed by default with phpWebThings,
execute all_tables_mysql.sql instead.

Edit wt_config.php to meet your needs:

Now only the database should be configured here.

Now, you can run your site. There is an user already inserted at
phpwebthings, it "admin" with password "123", please change it
as soon as possible. It's simple, login and go to My Account and
change the password, at the users admin you can change the name
admin too.

Please, enter at WebAdmin menu and press submit at every configuration
page to be sure that all configuration is stored at the database.

You can add menu items with the menu editor, simply click at Menu
link in the administration box and add your menus.
Check at info.php to don't overwrite the standard positions of
the phpwebthings menu. (phpWebThings has a simple check to
avoid overwrites, but don't count on this, its ulgy ;-)).
Normally phpWebThings menus are at positions incremented by 10.

All texts are stored at the lang dir, you can edit them to change
what text you want, just beware of the %s and %d used on it.

If you plan to use the avatars, set write access to all at
/var/avatars.

If you will use filemanager, some modules need their especific folders
to be write access to all:

modules/banners/images
modules/downloads/images
modules/news/images
modules/news/cat_images
modules/picofday/images

Please set write access to all only at these folders! OR strange things
can happens at your site. If you don't plan to use avatars neither
filemanager, don't set write access to any folder.

Only images are allowed to be uploaded.

If you plan to remove phpWebThings, beware that images uploaded by phpWebThings
should be deleted by phpWebThings, because the users that created these
files are the same user that runs the web server, that is genereally different
of your ftp user.
If you forget to delete these files, you'll need to ask for your server
administrator to clear your folder, or create a php script to do that.

This application may contain bugs and errors, feel free to send them to me!

I hope that you like to use phpwebthings as I like to make it!

If you wish to help us, join our team! It's necessary to know CVS,
SQL and PHP.

Paulo Assis
paulo@phpdbform.com
http://www.phpdbform.com
