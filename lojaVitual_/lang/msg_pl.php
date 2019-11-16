<?php
// polish file for phpwebthings - zombiek <pzabek@realnet.pl>
define( 'CHARSET', "iso-8859-2" );
//general
define( 'ACTIVATE_TITLE', "Konto zosta³o aktywowane!" );
define( 'ADD_USERS', "Dodaj u¿ytkowników" );
define( 'REPLIES_TO', "Odpowiedzi do" );
define( 'PREVIOUS_MSG', "Poprzednia wiadomo¶æ w tym w±tku" );
define( 'BACK_FORUM', "Powrót do forum" );
define( 'OPTION_NONE', "nie ma" );
define( 'GO_BACK', "Cofnij" );

// general not logged
define( 'NOT_LOGGED_ONLINE', "Niestety, musisz siê zalogowaæ aby zobaczyæ u¿ytkowników online. Je¶li nie posiadasz jeszcze konta, dlaczego siê nie zarejestrujesz? Rejestracja jest darmowa!" );
define( 'NOT_LOGGED_MYACCT', "Niestety, musisz siê zalogowaæ aby edytowaæ swoje konto. Je¶li nie posiadasz jeszcze konta, dlaczego siê nie zarejestrujesz? Rejestracja jest darmowa!" );

//home
define( 'HOME_TITLE', "Strona g³ówna" );

//error messages
define( 'ERROR_TITLE', "*** B³±d ***" );
define( 'ERROR_01', "Nie mo¿esz wys³aæ wiadomo¶ci bez tytu³u i/lub tre¶ci" );
define( 'ERROR_02', "Musisz wprowadziæ tytu³<br>" );
define( 'ERROR_03', "Musisz wprowadziæ tre¶æ<br>" );
define( 'ERROR_04', "Pojawi³ siê b³±d przy próbie uruchamiania komend SQL" );
define( 'ERROR_05', "B³±d otwierania katalogu" );
define( 'ERROR_06', "baner nie znaleziony" );
define( 'ERROR_07', "nie ma pliku" );
define( 'ERROR_08', "Nieprawid³owy e-mail<br>" );
define( 'ERROR_09', "E-mail nie znaleziony!<br>" );

// not logged messages
//NOT_LOGGED_ONLINE
//NOT_LOGGED_MYACCT

// MyAccount / NewUser
define( 'MYACCT_TITLE', "Moje Konto" );
define( 'MYACCT_INFO', "Informacje o Moim Koncie" );
define( 'MYACCT_TEXT', "Wszystkie dane wpisane tutaj (z wyj±tkiem adresu e-mail) mog± byæ widoczne dla innych zarejestrowanych u¿ytkowników." );
define( 'MYACCT_FORM_LOGIN', "Login" );
define( 'MYACCT_FORM_REALNAME', "Imiê, Nazwisko" );
define( 'MYACCT_FORM_PASSWD_INFO', "Je¶li nie chcesz zmieniæ swojego has³a, pozostaw pola z has³em puste." );
define( 'MYACCT_FORM_PASSWD', "Has³o" );
define( 'MYACCT_FORM_PASSWD2', "Potwierd¼ has³o" );
define( 'MYACCT_FORM_EMAIL', "E-mail (konto bêdzie aktywowane poprzez e-mail)" );
define( 'MYACCT_FORM_SEX', "P³eæ" );
define( 'MYACCT_FORM_OSDEV', "OS u¿ywany do <i>tworzenia</i> stron" );
define( 'MYACCT_FORM_OSSRV', "OS u¿ywany jako serwer" );
define( 'MYACCT_FORM_COUNTRY', "Kraj" );
define( 'MYACCT_FORM_CITY', "Miasto" );
define( 'MYACCT_FORM_STATE', "Województwo" );
define( 'MYACCT_FORM_RCVNEWS', "Chcesz otrzymywaæ njusy z tej strony na e-mail?" );
define( 'MYACCT_FORM_RCVREL', "Powiadamiaæ e-mail'em gdy nowy plik zostanie dodany?" );
define( 'MYACCT_FORM_URL', "Twoja strona: (z http://)" );
define( 'MYACCT_FORM_OBS', "Komentarz o Tobie:" );
define( 'MYACCT_FORM_SUBMIT', "Dodaj" );
define( 'MYACCT_NEWSPOSTED', "Wys³anych njusów" );
define( 'MYACCT_COMMENTSPOSTED', "Wys³anych komentarzy" );
define( 'MYACCT_FAQPOSTED', "Wys³anych FAQ" );
define( 'MYACCT_DATEACTIVATED', "Konto za³o¿one" );
define( 'MYACCT_LASTVISIT', "Ostatnie logowanie" );
define( 'MYACCT_NUMLOGINS', "Wszystkich wizyt" );
define( 'MYACCT_LOGGED', "Nie mo¿esz siê zarejestrowaæ poniewa¿ ju¿ jestes zarejestrowany." );

define( 'MYACCT_USER_BOOK', "Moja lista u¿ytkowników" );
define( 'MYACCT_ADD_USER', "Dodaj u¿ytkownika do Mojej Ksi±¿ki" );
define( 'MYACCT_USER_ADDED', "U¿ytkownik dodany" );
define( 'MYACCT_DEL_USER', "Skasuj u¿ytkownika z Mojej Ksi±¿ki" );
define( 'MYACCT_USER_DELETED', "U¿ytkownik zosta³ usuniêty z Mojej Ksi±¿ki" );
define( 'MYACCT_PROFILE', "Profil u¿ytkownika dla" );

define( 'MYACCT_INS_ERROR_01', "Musisz wpisaæ has³o" );
define( 'MYACCT_INS_ERROR_02', "Pola z has³ami ró¿ni± siê" );
define( 'MYACCT_INS_ERROR_03', "Proszê wpisaæ Imiê" );
define( 'MYACCT_INS_ERROR_04', "Proszê u¿ywaæ jedynie liter, cyfr i \'_,.,-\' znaków w polu Imiê" );
define( 'MYACCT_INS_ERROR_05', "Proszê wpisaæ pañstwo" );
define( 'MYACCT_INS_ERROR_06', "Ten e-mail jest ju¿ zarejestrowany!<br>Je¶li chcesz skasowaæ go z bazy danych,<br> wy¶lij e-mail do" );
define( 'MYACCT_INS_ERROR_07', "Ten login jest ju¿ zarejestrowany!<br>Proszê spróbowaæ jeszcze raz" );
define( 'MYACCT_EMAIL_CHANGED_TITLE', "E-mail zosta³ zmieniony" );
define( 'MYACCT_EMAIL_CHANGED_TEXT', "Twój nowy e-mail zostanie zmieniony dopiero po jego aktywacji. W ci±gu kilku minut na nowy adres otrzymasz instrukcje na temat tego jak go aktywowaæ: (%s). <b>Do tego czasu stary e-mail bêdzie dzia³a³.</b>" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TITLE', "Zmiana Twojego e-maila na %s" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TEXT', "Hi %s!\nZmieniasz swój email na stronie %s!\nAby aktywowac Twoj nowy e-mail, idz do %s\n\nPozdrawiamy,\n%s" );
define( 'MYACCT_EMAIL_CHANGED_OK', "Twój e-mail zosta³ zmieniony!" );
define( 'MYACCT_EMAIL_CHANGED_ERROR', "U¿ytkownik/sesja nieprawid³owa.");

define( 'NEWUSER_TITLE', "Nowy u¿ytkownik" );
define( 'NEWUSER_MAIL_TITLE', "%s rejestracja" );
define( 'NEWUSER_MAIL_TEXT', "Czesc %s!\nDzieki za rejestracje na stronie %s!\nAby aktywowac Swoje konto, kliknij na %s\n\nPozdrawiamy,%s" );
define( 'NEWUSER_MSG_TITLE', "Ju¿ prawie jeste¶ zarejestrowany" );
define( 'NEWUSER_MSG_TEXT', "<b>Dziêki</b> za rejestracjê na naszej stronie!<br><br>Twoje konto nie jest jeszcze aktywne, w ci±gu kilku minut otrzymasz e-mail z informacj± jak aktywowaæ konto." );
define( 'NEWUSER_MSG_TITLE2', "Dziêki za rejestracjê!" );
define( 'NEWUSER_MSG_TEXT2', "<b>Dziêki</b> za rejestracjê na naszej stronie!<br><br>Teraz mo¿esz zalogowaæ siê na naszej stronie." );
define( 'NEWUSER_FORM_TITLE', "Rejestracja" );
define( 'NEWUSER_ACTIVATE_ERROR', "U¿ytkownik/sesja niepoprawna lub konto jest ju¿ zarejestrowane.");
define( 'NEWUSER_ACTIVATED', "Twoje konto zosta³o aktywowane! Teraz mo¿esz wysy³aæ wiadomoœci na Forum oraz wysy³aæ wiadomo¶ci do innych u¿ytkowników tej strony. Aby zobaczyæ listê u¿ytkowników i aby dodaæ ich do Twojej listy (mo¿esz wtedy wysy³aæ im wiadomo¶ci), przejd¼ do \"Moje Konto\" i kliknij na \"Dodaj u¿ytkowników\".<br><br>Dziêki za rejestracjê!");
define( 'NEW_USER_LINK', "Rejestruj" );
//Login
define( 'LOGIN_TITLE', "Login" );
define( 'LOGIN_NAME', "Login:" );
define( 'LOGIN_PASSWD', "Has³o:" );
define( 'LOGIN_BUTTON', "Zaloguj" );
define( 'LOGIN_REGISTER', "Zarejestruj siê!" );
define( 'LOGIN_LOST_PWD', "Zapomnia³e¶ has³a?" );
define( 'LOGIN_WELCOME', "Witaj %s" );
define( 'LOGIN_LOGOUT', "Wyloguj" );
define( 'LOGIN_AUTOLOGIN', "zapamiêtaj mnie" );

//Users online
define( 'USERS_ONLINE', "U¿ytkowników Online" );
define( 'USERS_ONLINE_TEXT', "Obecnie jest:<br>%d zarejestrowanych u¿ytkowników<br>i %d go¶ci %sonline%s." );

//List users
define( 'LIST_USERS_TITLE', "Lista u¿ytkowników" );

// Lost your password?
define( 'PASSWD_TITLE', "Przypomnienie has³a" );
define( 'PASSWD_MAIL_TITLE', "Przypomnienie has³a " );
define( 'PASSWD_MAIL_TEXT1', "Prosiles nas o wyslanie Ci Twojego hasla password z %s\n\nlogin: %s\nhaslo: %s" );
define( 'PASSWD_MAIL_TEXT2', "Ale Twoje konto nie jest aktywne, aby aktywowac konto, kliknij na link ponizej:\n" );
define( 'PASSWD_MAIL_DONE', "E-mail z Twoim loginem zosta³ do Ciebie wys³any." );
define( 'PASSWD_MAIL_ERROR', "Nie mogê wys³aæ e-mail'a. B³±d wewnêtrzny.<br>" );
define( 'PASSWD_TEXT', "<b>Zapomnia³e¶ has³a? Mo¿emy Ci je wys³aæ!</b><br>Wpisz adres e-mail i wy¶lemy Ci e-mail z Twoim login'em. U¿ywaj tego tylko dla przypomnienia TWOJEGO has³a." );
define( 'PASSWD_FORM_EMAIL', "Wpisz swój e-mail:" );
define( 'PASSWD_FORM_SUBMIT', "Przypomnij mi has³o" );

//stats
define( 'STATS_TITLE', "Statystyki" );
define( 'STATS_USERS', "Zarejestrowanych u¿ytkowników" );
define( 'STATS_ACTIVE', "Aktywnych" );
define( 'STATS_NOTACTIVE', "Nie aktywnych" );
define( 'STATS_TOTAL', "Wszystkich" );
define( 'STATS_TOPTEN', "Top-lista pañstw" );
define( 'STATS_DESKOS', "Desktop OS" );
define( 'STATS_SERVOS', "Serwer OS" );
define( 'STATS_LAST_WEEK', "Nowych u¿ytkowników w tym tygodniu" );
define( 'STATS_LAST_MONTHS', "Nowi u¿ytkownicy / 3 mies." );

//send e-mail
define( 'SENDMAIL_MSG_HDR', "Witaj, %s, \n\n" );
define( 'SENDMAIL_MSG_FTR', "\n\nPozdrawiamy!,\n\n%s\n\nTen e-mail zostal wyslany poniewaz zarejestrowales sie na stronie %s. Jesli nie chcesz otrzymywac od nas emaili, skontaktuj sie z %s i napisz, ze chcesz zrezygnowac z tej listy." );
define( 'SENDMAIL_MAIL_SENT', "wys³any" );
define( 'SENDMAIL_USER', "U¿ytkownik" );
define( 'SENDMAIL_EMAIL', "E-mail" );
define( 'SENDMAIL_COUNTRY', "Kraj" );
define( 'SENDMAIL_SEND', "Wy¶lij" );
define( 'SENDMAIL_TEXT', "Tre¶æ" );
define( 'SENDMAIL_SUBMIT', "Wy¶lij e-mail" );

?>