<?php
// polish file for phpwebthings - zombiek <pzabek@realnet.pl>
define( 'CHARSET', "iso-8859-2" );
//general
define( 'ACTIVATE_TITLE', "Konto zosta�o aktywowane!" );
define( 'ADD_USERS', "Dodaj u�ytkownik�w" );
define( 'REPLIES_TO', "Odpowiedzi do" );
define( 'PREVIOUS_MSG', "Poprzednia wiadomo�� w tym w�tku" );
define( 'BACK_FORUM', "Powr�t do forum" );
define( 'OPTION_NONE', "nie ma" );
define( 'GO_BACK', "Cofnij" );

// general not logged
define( 'NOT_LOGGED_ONLINE', "Niestety, musisz si� zalogowa� aby zobaczy� u�ytkownik�w online. Je�li nie posiadasz jeszcze konta, dlaczego si� nie zarejestrujesz? Rejestracja jest darmowa!" );
define( 'NOT_LOGGED_MYACCT', "Niestety, musisz si� zalogowa� aby edytowa� swoje konto. Je�li nie posiadasz jeszcze konta, dlaczego si� nie zarejestrujesz? Rejestracja jest darmowa!" );

//home
define( 'HOME_TITLE', "Strona g��wna" );

//error messages
define( 'ERROR_TITLE', "*** B��d ***" );
define( 'ERROR_01', "Nie mo�esz wys�a� wiadomo�ci bez tytu�u i/lub tre�ci" );
define( 'ERROR_02', "Musisz wprowadzi� tytu�<br>" );
define( 'ERROR_03', "Musisz wprowadzi� tre��<br>" );
define( 'ERROR_04', "Pojawi� si� b��d przy pr�bie uruchamiania komend SQL" );
define( 'ERROR_05', "B��d otwierania katalogu" );
define( 'ERROR_06', "baner nie znaleziony" );
define( 'ERROR_07', "nie ma pliku" );
define( 'ERROR_08', "Nieprawid�owy e-mail<br>" );
define( 'ERROR_09', "E-mail nie znaleziony!<br>" );

// not logged messages
//NOT_LOGGED_ONLINE
//NOT_LOGGED_MYACCT

// MyAccount / NewUser
define( 'MYACCT_TITLE', "Moje Konto" );
define( 'MYACCT_INFO', "Informacje o Moim Koncie" );
define( 'MYACCT_TEXT', "Wszystkie dane wpisane tutaj (z wyj�tkiem adresu e-mail) mog� by� widoczne dla innych zarejestrowanych u�ytkownik�w." );
define( 'MYACCT_FORM_LOGIN', "Login" );
define( 'MYACCT_FORM_REALNAME', "Imi�, Nazwisko" );
define( 'MYACCT_FORM_PASSWD_INFO', "Je�li nie chcesz zmieni� swojego has�a, pozostaw pola z has�em puste." );
define( 'MYACCT_FORM_PASSWD', "Has�o" );
define( 'MYACCT_FORM_PASSWD2', "Potwierd� has�o" );
define( 'MYACCT_FORM_EMAIL', "E-mail (konto b�dzie aktywowane poprzez e-mail)" );
define( 'MYACCT_FORM_SEX', "P�e�" );
define( 'MYACCT_FORM_OSDEV', "OS u�ywany do <i>tworzenia</i> stron" );
define( 'MYACCT_FORM_OSSRV', "OS u�ywany jako serwer" );
define( 'MYACCT_FORM_COUNTRY', "Kraj" );
define( 'MYACCT_FORM_CITY', "Miasto" );
define( 'MYACCT_FORM_STATE', "Wojew�dztwo" );
define( 'MYACCT_FORM_RCVNEWS', "Chcesz otrzymywa� njusy z tej strony na e-mail?" );
define( 'MYACCT_FORM_RCVREL', "Powiadamia� e-mail'em gdy nowy plik zostanie dodany?" );
define( 'MYACCT_FORM_URL', "Twoja strona: (z http://)" );
define( 'MYACCT_FORM_OBS', "Komentarz o Tobie:" );
define( 'MYACCT_FORM_SUBMIT', "Dodaj" );
define( 'MYACCT_NEWSPOSTED', "Wys�anych njus�w" );
define( 'MYACCT_COMMENTSPOSTED', "Wys�anych komentarzy" );
define( 'MYACCT_FAQPOSTED', "Wys�anych FAQ" );
define( 'MYACCT_DATEACTIVATED', "Konto za�o�one" );
define( 'MYACCT_LASTVISIT', "Ostatnie logowanie" );
define( 'MYACCT_NUMLOGINS', "Wszystkich wizyt" );
define( 'MYACCT_LOGGED', "Nie mo�esz si� zarejestrowa� poniewa� ju� jestes zarejestrowany." );

define( 'MYACCT_USER_BOOK', "Moja lista u�ytkownik�w" );
define( 'MYACCT_ADD_USER', "Dodaj u�ytkownika do Mojej Ksi��ki" );
define( 'MYACCT_USER_ADDED', "U�ytkownik dodany" );
define( 'MYACCT_DEL_USER', "Skasuj u�ytkownika z Mojej Ksi��ki" );
define( 'MYACCT_USER_DELETED', "U�ytkownik zosta� usuni�ty z Mojej Ksi��ki" );
define( 'MYACCT_PROFILE', "Profil u�ytkownika dla" );

define( 'MYACCT_INS_ERROR_01', "Musisz wpisa� has�o" );
define( 'MYACCT_INS_ERROR_02', "Pola z has�ami r�ni� si�" );
define( 'MYACCT_INS_ERROR_03', "Prosz� wpisa� Imi�" );
define( 'MYACCT_INS_ERROR_04', "Prosz� u�ywa� jedynie liter, cyfr i \'_,.,-\' znak�w w polu Imi�" );
define( 'MYACCT_INS_ERROR_05', "Prosz� wpisa� pa�stwo" );
define( 'MYACCT_INS_ERROR_06', "Ten e-mail jest ju� zarejestrowany!<br>Je�li chcesz skasowa� go z bazy danych,<br> wy�lij e-mail do" );
define( 'MYACCT_INS_ERROR_07', "Ten login jest ju� zarejestrowany!<br>Prosz� spr�bowa� jeszcze raz" );
define( 'MYACCT_EMAIL_CHANGED_TITLE', "E-mail zosta� zmieniony" );
define( 'MYACCT_EMAIL_CHANGED_TEXT', "Tw�j nowy e-mail zostanie zmieniony dopiero po jego aktywacji. W ci�gu kilku minut na nowy adres otrzymasz instrukcje na temat tego jak go aktywowa�: (%s). <b>Do tego czasu stary e-mail b�dzie dzia�a�.</b>" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TITLE', "Zmiana Twojego e-maila na %s" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TEXT', "Hi %s!\nZmieniasz sw�j email na stronie %s!\nAby aktywowac Twoj nowy e-mail, idz do %s\n\nPozdrawiamy,\n%s" );
define( 'MYACCT_EMAIL_CHANGED_OK', "Tw�j e-mail zosta� zmieniony!" );
define( 'MYACCT_EMAIL_CHANGED_ERROR', "U�ytkownik/sesja nieprawid�owa.");

define( 'NEWUSER_TITLE', "Nowy u�ytkownik" );
define( 'NEWUSER_MAIL_TITLE', "%s rejestracja" );
define( 'NEWUSER_MAIL_TEXT', "Czesc %s!\nDzieki za rejestracje na stronie %s!\nAby aktywowac Swoje konto, kliknij na %s\n\nPozdrawiamy,%s" );
define( 'NEWUSER_MSG_TITLE', "Ju� prawie jeste� zarejestrowany" );
define( 'NEWUSER_MSG_TEXT', "<b>Dzi�ki</b> za rejestracj� na naszej stronie!<br><br>Twoje konto nie jest jeszcze aktywne, w ci�gu kilku minut otrzymasz e-mail z informacj� jak aktywowa� konto." );
define( 'NEWUSER_MSG_TITLE2', "Dzi�ki za rejestracj�!" );
define( 'NEWUSER_MSG_TEXT2', "<b>Dzi�ki</b> za rejestracj� na naszej stronie!<br><br>Teraz mo�esz zalogowa� si� na naszej stronie." );
define( 'NEWUSER_FORM_TITLE', "Rejestracja" );
define( 'NEWUSER_ACTIVATE_ERROR', "U�ytkownik/sesja niepoprawna lub konto jest ju� zarejestrowane.");
define( 'NEWUSER_ACTIVATED', "Twoje konto zosta�o aktywowane! Teraz mo�esz wysy�a� wiadomo�ci na Forum oraz wysy�a� wiadomo�ci do innych u�ytkownik�w tej strony. Aby zobaczy� list� u�ytkownik�w i aby doda� ich do Twojej listy (mo�esz wtedy wysy�a� im wiadomo�ci), przejd� do \"Moje Konto\" i kliknij na \"Dodaj u�ytkownik�w\".<br><br>Dzi�ki za rejestracj�!");
define( 'NEW_USER_LINK', "Rejestruj" );
//Login
define( 'LOGIN_TITLE', "Login" );
define( 'LOGIN_NAME', "Login:" );
define( 'LOGIN_PASSWD', "Has�o:" );
define( 'LOGIN_BUTTON', "Zaloguj" );
define( 'LOGIN_REGISTER', "Zarejestruj si�!" );
define( 'LOGIN_LOST_PWD', "Zapomnia�e� has�a?" );
define( 'LOGIN_WELCOME', "Witaj %s" );
define( 'LOGIN_LOGOUT', "Wyloguj" );
define( 'LOGIN_AUTOLOGIN', "zapami�taj mnie" );

//Users online
define( 'USERS_ONLINE', "U�ytkownik�w Online" );
define( 'USERS_ONLINE_TEXT', "Obecnie jest:<br>%d zarejestrowanych u�ytkownik�w<br>i %d go�ci %sonline%s." );

//List users
define( 'LIST_USERS_TITLE', "Lista u�ytkownik�w" );

// Lost your password?
define( 'PASSWD_TITLE', "Przypomnienie has�a" );
define( 'PASSWD_MAIL_TITLE', "Przypomnienie has�a " );
define( 'PASSWD_MAIL_TEXT1', "Prosiles nas o wyslanie Ci Twojego hasla password z %s\n\nlogin: %s\nhaslo: %s" );
define( 'PASSWD_MAIL_TEXT2', "Ale Twoje konto nie jest aktywne, aby aktywowac konto, kliknij na link ponizej:\n" );
define( 'PASSWD_MAIL_DONE', "E-mail z Twoim loginem zosta� do Ciebie wys�any." );
define( 'PASSWD_MAIL_ERROR', "Nie mog� wys�a� e-mail'a. B��d wewn�trzny.<br>" );
define( 'PASSWD_TEXT', "<b>Zapomnia�e� has�a? Mo�emy Ci je wys�a�!</b><br>Wpisz adres e-mail i wy�lemy Ci e-mail z Twoim login'em. U�ywaj tego tylko dla przypomnienia TWOJEGO has�a." );
define( 'PASSWD_FORM_EMAIL', "Wpisz sw�j e-mail:" );
define( 'PASSWD_FORM_SUBMIT', "Przypomnij mi has�o" );

//stats
define( 'STATS_TITLE', "Statystyki" );
define( 'STATS_USERS', "Zarejestrowanych u�ytkownik�w" );
define( 'STATS_ACTIVE', "Aktywnych" );
define( 'STATS_NOTACTIVE', "Nie aktywnych" );
define( 'STATS_TOTAL', "Wszystkich" );
define( 'STATS_TOPTEN', "Top-lista pa�stw" );
define( 'STATS_DESKOS', "Desktop OS" );
define( 'STATS_SERVOS', "Serwer OS" );
define( 'STATS_LAST_WEEK', "Nowych u�ytkownik�w w tym tygodniu" );
define( 'STATS_LAST_MONTHS', "Nowi u�ytkownicy / 3 mies." );

//send e-mail
define( 'SENDMAIL_MSG_HDR', "Witaj, %s, \n\n" );
define( 'SENDMAIL_MSG_FTR', "\n\nPozdrawiamy!,\n\n%s\n\nTen e-mail zostal wyslany poniewaz zarejestrowales sie na stronie %s. Jesli nie chcesz otrzymywac od nas emaili, skontaktuj sie z %s i napisz, ze chcesz zrezygnowac z tej listy." );
define( 'SENDMAIL_MAIL_SENT', "wys�any" );
define( 'SENDMAIL_USER', "U�ytkownik" );
define( 'SENDMAIL_EMAIL', "E-mail" );
define( 'SENDMAIL_COUNTRY', "Kraj" );
define( 'SENDMAIL_SEND', "Wy�lij" );
define( 'SENDMAIL_TEXT', "Tre��" );
define( 'SENDMAIL_SUBMIT', "Wy�lij e-mail" );

?>