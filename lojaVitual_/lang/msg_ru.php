<?php
// Russian WIN1251 file for phpwebthings - Oleg Kourapov <ok@2sheds.ru>
define( 'CHARSET', "windows-1251" );
//general
define( 'ACTIVATE_TITLE', "Регистрация завершена!" );
define( 'ADD_USERS', "Добавить посетителей" );
define( 'REPLIES_TO', "В ответ на" );
define( 'PREVIOUS_MSG', "Предыдущее сообщение" );
define( 'BACK_FORUM', "Вернуться к доске объявлений" );
define( 'OPTION_NONE', "нет" );
define( 'GO_BACK', "Вернуться" );

// general not logged
define( 'NOT_LOGGED_ONLINE', "Только зарегистрированные посетители могут просмотреть список находящихся на сайте посетителей. Присоединяйтесь!" );
define( 'NOT_LOGGED_MYACCT', "Вам нужно ввести логин для изменения настроек. Если вы еще не зарегистированы - присоединяйтесь!" );

//home
define( 'HOME_TITLE', "Главная страница" );

//error messages
define( 'ERROR_TITLE', "*** ОШИБКА ***" );
define( 'ERROR_01', "Не забудьте ввести заголовок и/или текст сообщения" );
define( 'ERROR_02', "Не забудьте про заголовок!<br>" );
define( 'ERROR_03', "Не забудьте ввести текст!<br>" );
define( 'ERROR_04', "Ошибка сервера базы данных" );
define( 'ERROR_05', "Ошибка доступа к данным" );
define( 'ERROR_06', "баннер не найден" );
define( 'ERROR_07', "файл не найден" );
define( 'ERROR_08', "Неправильный адрес e-mail<br>" );
define( 'ERROR_09', "Адрес e-mail не найден!<br>" );

// not logged messages
//NOT_LOGGED_ONLINE
//NOT_LOGGED_MYACCT

// MyAccount / NewUser
define( 'MYACCT_TITLE', "Настройки" );
define( 'MYACCT_INFO', "Сведения" );
define( 'MYACCT_TEXT', "Вся эта информация (кроме адреса e-mail) может быть доступна другим зарегистрированным пользователям сайта." );
define( 'MYACCT_FORM_LOGIN', "Логин" );
define( 'MYACCT_FORM_REALNAME', "Полное имя" );
define( 'MYACCT_FORM_PASSWD_INFO', "Если вы не хотите менять свой пароль, оставьте соответствующие поля пустыми" );
define( 'MYACCT_FORM_PASSWD', "Пароль" );
define( 'MYACCT_FORM_PASSWD2', "Введите пароль еще раз для проверки" );
define( 'MYACCT_FORM_EMAIL', "E-mail (по этому адресу будут высланы инструкции для окончания регистрации)" );
define( 'MYACCT_FORM_SEX', "Пол" );
define( 'MYACCT_FORM_OSDEV', "Операционная система (десктоп)" );
define( 'MYACCT_FORM_OSSRV', "Операционная система (сервер)" );
define( 'MYACCT_FORM_COUNTRY', "Страна" );
define( 'MYACCT_FORM_CITY', "Город" );
define( 'MYACCT_FORM_STATE', "Область/Район" );
define( 'MYACCT_FORM_RCVNEWS', "Получать новости нашего сайта по e-mail?" );
define( 'MYACCT_FORM_RCVREL', "Получать извещения о новых файлах по e-mail?" );
define( 'MYACCT_FORM_URL', "Ваш сайт: (не забудьте http://)" );
define( 'MYACCT_FORM_OBS', "Дополнительная информация:" );
define( 'MYACCT_FORM_SUBMIT', "Отправить" );
define( 'MYACCT_NEWSPOSTED', "Новость отправлена" );
define( 'MYACCT_COMMENTSPOSTED', "Комментарии отправлены" );
define( 'MYACCT_FAQPOSTED', "ЧаВО отправлены" );
define( 'MYACCT_DATEACTIVATED', "Дата регистрации" );
define( 'MYACCT_LASTVISIT', "Последнее посещение" );
define( 'MYACCT_NUMLOGINS', "Количество посещений" );
define( 'MYACCT_LOGGED', "Вы уже зарегистрировались на нашем сайте!" );

define( 'MYACCT_USER_BOOK', "Адресная книга" );
define( 'MYACCT_ADD_USER', "добавить посетителя" );
define( 'MYACCT_USER_ADDED', "Посетитель добавлен в адресную книгу" );
define( 'MYACCT_DEL_USER', "удалить посетителя" );
define( 'MYACCT_USER_DELETED', "Посетитель удален из адресной книги" );
define( 'MYACCT_PROFILE', "Данные о посетителе" );

define( 'MYACCT_INS_ERROR_01', "Необходимо ввести пароль" );
define( 'MYACCT_INS_ERROR_02', "Пароль и значение, введенное для проверки, не совпадают" );
define( 'MYACCT_INS_ERROR_03', "Необходимо указать имя" );
define( 'MYACCT_INS_ERROR_04', "Имя может состоять только из латинских букв, цифр и символов \'_,.,-\'" );
define( 'MYACCT_INS_ERROR_05', "Необходимо указать страну" );
define( 'MYACCT_INS_ERROR_06', "Пользователь с таким адресом e-mail уже зарегистрирован!<br>Если вы уже проходили регистрацию, а теперь хотите удалить свои данные,<br> отправьте e-mail по адресу" );
define( 'MYACCT_INS_ERROR_07', "Этот логин уже занят!<br>Выберите, пожалуйста, другой" );
define( 'MYACCT_EMAIL_CHANGED_TITLE', "E-mail changed" );
define( 'MYACCT_EMAIL_CHANGED_TEXT', "Your new e-mail will only be changed after activating it. In a few minutes you will receive instructions of how activate it on the new e-mail you informed (%s). <b>Until there the old e-mail still works.</b>" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TITLE', "Changing your e-mail at %s" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TEXT', "Hi %s!\nYou are changing your e-mail at %s site!\nFor activating your new e-mail, go to %s\n\nBest Regards,%s" );
define( 'MYACCT_EMAIL_CHANGED_OK', "Your e-mail has been changed!" );
define( 'MYACCT_EMAIL_CHANGED_ERROR', "User/session invalid.");

define( 'NEWUSER_TITLE', "Новый посетитель" );
define( 'NEWUSER_MAIL_TITLE', "%s регистрация" );
define( 'NEWUSER_MAIL_TEXT', "Здравствуйте, %s!\Благодарим за интерес к сайту %s!\nДля подтверждения регистрации нажмите на эту ссылку %s\n\nС наилучшими пожеланиями, %s" );
define( 'NEWUSER_MSG_TITLE', "Регистрация почти завершена" );
define( 'NEWUSER_MSG_TEXT', "Благодарим за проявленный интерес!<br><br>На указанный адрес e-mail были высланы инструкции по окончанию процедуры регистрации." );
define( 'NEWUSER_MSG_TITLE2', "Благодарим за регистрацию!" );
define( 'NEWUSER_MSG_TEXT2', "Благодарим за регистрацию!<br><br>Теперь вы получили полный доступ ко всем функциям нашего сайта, скорее введите свой логин и пароль, чтобы все их опробовать!" );
define( 'NEWUSER_FORM_TITLE', "Регистрация" );
define( 'NEWUSER_ACTIVATE_ERROR', "Неверный логин или посетитель с таким именем уже зарегистрирован.");
define( 'NEWUSER_ACTIVATED', "Доступ открыт! Теперь вы сможете участвовать в дискуссиях на нашем форуме, пользоваться персональной адресной книгой, оставлять сообщения другим посетителям сайта, и многое другое! Для того, чтобы просмотреть список зарегистрированных посетителей, а также добавить их в свой список знакомых, зайдите на страницу \"Настройки\".");
define( 'NEW_USER_LINK', "Регистрация" );
//Login
define( 'LOGIN_TITLE', "Вход" );
define( 'LOGIN_NAME', "Логин:" );
define( 'LOGIN_PASSWD', "Пароль:" );
define( 'LOGIN_BUTTON', "Ок" );
define( 'LOGIN_REGISTER', "Регистрация" );
define( 'LOGIN_LOST_PWD', "Забыли пароль?" );
define( 'LOGIN_WELCOME', "Добро пожаловать, %s" );
define( 'LOGIN_LOGOUT', "Выйти" );
define( 'LOGIN_AUTOLOGIN', "запомнить пароль" );

//Users online
define( 'USERS_ONLINE', "Посетители" );
define( 'USERS_ONLINE_TEXT', "Сейчас на сайте: <br>%d постоянных<br>посетителей<br>и %d гостей.<br> %sОбщий список%s" );

//List users
define( 'LIST_USERS_TITLE', "Список посетителей" );

// Lost your password?
define( 'PASSWD_TITLE', "Восстановление пароля" );
define( 'PASSWD_MAIL_TITLE', "Восстановление пароля: " );
define( 'PASSWD_MAIL_TEXT1', "Вы запросили пароль для доступа к сайту %s\n\nлогин: %s\nпароль: %s" );
define( 'PASSWD_MAIL_TEXT2', "Но вы еще не подтвердили регистрацию, для этого откройте в вашем браузере эту страницу:\n" );
define( 'PASSWD_MAIL_DONE', "Вам было отправлено электронное письмо с необходимой информацией. Проверьте ваш почтовый ящик." );
define( 'PASSWD_MAIL_ERROR', "Не удалось отправить письмо. Внутренняя ошибка сервера.<br>" );
define( 'PASSWD_TEXT', "Забыли свой пароль? Не беспокойтесь, мы вышлем вам его по e-mail! Просто заполните эту форму и вы получите сообщение с инструкциями по восстановлению." );
define( 'PASSWD_FORM_EMAIL', "Введите свой e-mail:" );
define( 'PASSWD_FORM_SUBMIT', "Отправить" );

//stats
define( 'STATS_TITLE', "Статистика" );
define( 'STATS_USERS', "Зарегистрировано" );
define( 'STATS_ACTIVE', "Подано заявок" );
define( 'STATS_NOTACTIVE', "Отказались от регистрации" );
define( 'STATS_TOTAL', "Итого" );
define( 'STATS_TOPTEN', "Страна" );
define( 'STATS_DESKOS', "ОС (десктоп)" );
define( 'STATS_SERVOS', "ОС (сервер)" );
define( 'STATS_LAST_WEEK', "Регистраций за неделю" );
define( 'STATS_LAST_MONTHS', "Регистраций за 3 месяца" );

//send e-mail
define( 'SENDMAIL_MSG_HDR', "Приветствуем вас, %s', \n\n" );
define( 'SENDMAIL_MSG_FTR', "\n\nДо встречи на нашем сайте,\n\n%s\n\nВы получили это письмо потому, что вы зарегистрировались на сайте %s. Если вы не хотите получать письма с нашего сайта, отправьте письмо по адресу %s." );
define( 'SENDMAIL_MAIL_SENT', "отправлено" );
define( 'SENDMAIL_USER', "Посетитель" );
define( 'SENDMAIL_EMAIL', "E-mail" );
define( 'SENDMAIL_COUNTRY', "Страна" );
define( 'SENDMAIL_SEND', "Отправить" );
define( 'SENDMAIL_TEXT', "Текст" );
define( 'SENDMAIL_SUBMIT', "Отправить" );

?>