<?php
// indonesia file for phpwebthings - Iwan Setya Putra <iwan@gotcha-inc.com>
define( 'CHARSET', "iso-8859-1" );
//general
define( 'ACTIVATE_TITLE', "Account telah aktif!" );
define( 'ADD_USERS', "Tambah User" );
define( 'REPLIES_TO', "Replies to" );
define( 'PREVIOUS_MSG', "Previous message in thread" );
define( 'BACK_FORUM', "Kembali ke forum" );
define( 'OPTION_NONE', "tidak ada" );
define( 'GO_BACK', "Kembali" );

// general not logged
define( 'NOT_LOGGED_ONLINE', "Maaf, anda harus login dahulu untuk melihat online users. Jika anda belum terdaftar, silahkan hubungi webmaster@stieken.ac.id" );
define( 'NOT_LOGGED_MYACCT', "Maaf, anda harus login dahulu untuk meng-edit account anda. Jika anda belum terdaftar, silahkan hubungi webmaster@stieken.ac.id" );

//home
define( 'HOME_TITLE', "Halaman Depan" );
define( 'PROFILE_TITLE', "Sekilas STIEKEN" );
define( 'BIODATA_TITLE', "Dosen dan Staff" );
define( 'PENPALS_TITLE', "Biodata Dosen dan Staff STIEKEN" );

//error messages
define( 'ERROR_TITLE', "*** ERROR ***" );
define( 'ERROR_01', "Anda tidak boleh posting pesan tanpa judul dan/atau teks" );
define( 'ERROR_02', "Anda perlu menetapkan judulnya<br>" );
define( 'ERROR_03', "Anda perlu menetapkan teksnya<br>" );
define( 'ERROR_04', "An error ocurred trying to execute SQL commands" );
define( 'ERROR_05', "Error opening dir" );
define( 'ERROR_06', "banner tidak ditemukan" );
define( 'ERROR_07', "file tidak ditemukan" );
define( 'ERROR_08', "Invalid e-mail<br>" );
define( 'ERROR_09', "E-mail tidak ditemukan!<br>" );

// not logged messages
//NOT_LOGGED_ONLINE
//NOT_LOGGED_MYACCT

// MyAccount / NewUser
define( 'MYACCT_TITLE', "Account-Ku" );
define( 'MYACCT_INFO', "Info Account-Ku" );
define( 'MYACCT_TEXT', "Semua data disini (kecuali e-mail) boleh jadi akan nampak bagi user lain yang terdaftar." );
define( 'MYACCT_FORM_LOGIN', "Login" );
define( 'MYACCT_FORM_REALNAME', "Nama Asli" );
define( 'MYACCT_FORM_PASSWD_INFO', "Jika tidak ingin merubah password, biarkan kolom password tetap kosong" );
define( 'MYACCT_FORM_PASSWD', "Password" );
define( 'MYACCT_FORM_PASSWD2', "Konfirmasi Password" );
define( 'MYACCT_FORM_EMAIL', "E-mail (account anda akan diaktifkan melalui e-mail)" );
define( 'MYACCT_FORM_SEX', "Jenis Kelamin" );
define( 'MYACCT_FORM_COUNTRY', "Negara" );
define( 'MYACCT_FORM_CITY', "Kota" );
define( 'MYACCT_FORM_STATE', "Propinsi" );
define( 'MYACCT_FORM_RCVNEWS', "Terima berita dari site ini di email anda?" );
define( 'MYACCT_FORM_RCVREL', "Terima e-mail ketika file baru di rilis?" );
define( 'MYACCT_FORM_URL', "Website anda: (mulai dengan http://)" );
define( 'MYACCT_FORM_OBS', "Info Tambahan tentang Anda:" );
define( 'MYACCT_FORM_SUBMIT', "Kirim" );
define( 'MYACCT_NEWSPOSTED', "Berita terkirim" );
define( 'MYACCT_COMMENTSPOSTED', "Komentar terkirim" );
define( 'MYACCT_FAQPOSTED', "FAQ terkirim" );
define( 'MYACCT_DATEACTIVATED', "Anggota sejak" );
define( 'MYACCT_LASTVISIT', "Login terakhir" );
define( 'MYACCT_NUMLOGINS', "Total pengunjung" );


define( 'MYACCT_USER_BOOK', "Daftar User-Ku" );
define( 'MYACCT_ADD_USER', "Tambah user di catatan-ku" );
define( 'MYACCT_USER_ADDED', "User tercatat" );
define( 'MYACCT_DEL_USER', "hapus user dari catatan-ku" );
define( 'MYACCT_USER_DELETED', "User telah dihapus dari catatan anda" );

define( 'MYACCT_INS_ERROR_01', "Anda harus memasukkan password" );
define( 'MYACCT_INS_ERROR_02', "Password anda berbeda" );
define( 'MYACCT_INS_ERROR_03', "Silahkan masukkan nama" );
define( 'MYACCT_INS_ERROR_04', "Harap menggunakan alphanumeric dan karakter \'_,.,-\' pada nama" );
define( 'MYACCT_INS_ERROR_05', "Masukkan Negara" );
define( 'MYACCT_INS_ERROR_06', "E-mail ini telah terdaftar!<br>Jika anda ingin menghapus e-mail ini dari database,<br> kirim e-mail ke" );
define( 'MYACCT_INS_ERROR_07', "Login ini telah terdaftar!<br>Harap pilih nama lain" );
define( 'MYACCT_INVALID_VALUE', "Invalid value for question" );
define( 'MYACCT_EMAIL_CHANGED_TITLE', "E-mail changed" );
define( 'MYACCT_EMAIL_CHANGED_TEXT', "Your new e-mail will only be changed after activating it. In a few minutes you will receive instructions of how activate it on the new e-mail you informed (%s). <b>Until there the old e-mail still works.</b>" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TITLE', "Changing your e-mail at %s" );
define( 'MYACCT_EMAIL_CHANGED_MAIL_TEXT', "Hi %s!\nYou are changing your e-mail at %s site!\nFor activating your new e-mail, go to %s\n\nBest Regards,%s" );
define( 'MYACCT_EMAIL_CHANGED_OK', "Your e-mail has been changed!" );
define( 'MYACCT_EMAIL_CHANGED_ERROR', "User/session invalid.");

define( 'NEWUSER_TITLE', "User Baru" );
define( 'NEWUSER_MAIL_TITLE', "%s registrasi" );
define( 'NEWUSER_MAIL_TEXT', "Hai %s!\nTerima kasih telah mendaftar di %s site!\nUntuk mengaktifkan account anda, silahkan ke %s\n\nSalam,<br>%s" );
define( 'NEWUSER_MSG_TITLE', "Anda hampir terdaftar" );
define( 'NEWUSER_MSG_TEXT', "<b>Terima Kasih</b> telah mendaftar di www.stieken.ac.id!<br><br>Account anda belum aktif, dalam beberapa menit anda akan menerima e-mail yang menjelaskan bagaimana cara mengaktifkan account anda." );
define( 'NEWUSER_MSG_TITLE2', "Terima Kasih telah mendaftar!" );
define( 'NEWUSER_MSG_TEXT2', "<b>Terima Kasih</b> telah mendaftar di www.stieken.ac.id!<br><br>Sekarang anda bisa login di website STIE Kesuma Negara Blitar [www.stieken.ac.id]." );
define( 'NEWUSER_FORM_TITLE', "Register" );
define( 'NEWUSER_ACTIVATE_ERROR', "User/session tidak sesuai atau account telah terdaftar.");
define( 'NEWUSER_ACTIVATED', "Account anda telah diaktifkan! Sekarang anda bisa posting pesan di forum dan kirim pesan ke user lain. Untuk melihat daftar user dan menambahkan ke daftar anda untuk mengirimi mereka pesan, silahkan ke \"Account-Ku\" dan klik bagian \"tambah user\".<br><br>Terima Kasih telah mendaftar!");
define( 'NEW_USER_LINK', "Register" );
//Login
define( 'LOGIN_TITLE', "Login" );
define( 'LOGIN_NAME', "Login:" );
define( 'LOGIN_PASSWD', "Password:" );
define( 'LOGIN_BUTTON', "Login" );
define( 'LOGIN_REGISTER', "Register', Gratis!" );
define( 'LOGIN_LOST_PWD', "Lupa password?" );
define( 'LOGIN_WELCOME', "Selamat Datang %s" );
define( 'LOGIN_LOGOUT', "Keluar" );
define( 'LOGIN_AUTOLOGIN', "ingatlah aku" );

//Users online
define( 'USERS_ONLINE', "Users Online" );
define( 'USERS_ONLINE_TEXT', "Pengunjung:<br>%d user yang terdaftar<br>dan %d tamu %sonline%s saat ini." );

//List users
define( 'LIST_USERS_TITLE', "Daftar User" );

// Lost your password?
define( 'PASSWD_TITLE', "Password Recovery" );
define( 'PASSWD_MAIL_TITLE', "Password recovery di " );
define( 'PASSWD_MAIL_TEXT1', "Anda telah meminta kami untuk mengirim kepada anda password anda untuk %s\n\nlogin: %s\npassword: %s" );
define( 'PASSWD_MAIL_TEXT2', "Tetapi account anda belum aktif, untuk emngaktifkan account anda, silahkan ke url berikut:\n" );
define( 'PASSWD_MAIL_DONE', "Sebuah E-mail telah dikirim untuk anda berisi info login anda." );
define( 'PASSWD_MAIL_ERROR', "Tidak dapat mengirim e-mail. Internal error.<br>" );
define( 'PASSWD_TEXT', "Lupa password anda? Kami dapat mengirim info password untuk anda! Silahkan isi form disertai e-mail anda dan kami akan mengirimkan info login anda ke alamat e-mail anda. Gunakan hanya untuk mendapatkan kembali password anda." );
define( 'PASSWD_FORM_EMAIL', "Masukkan e-mail anda:" );
define( 'PASSWD_FORM_SUBMIT', "Recover password" );

//stats
define( 'STATS_TITLE', "Statistik" );
define( 'STATS_USERS', "User terdaftar" );
define( 'STATS_ACTIVE', "Aktif" );
define( 'STATS_NOTACTIVE', "Tidak aktif" );
define( 'STATS_TOTAL', "Total" );
define( 'STATS_TOPTEN', "Negara Topten" );
define( 'STATS_DESKOS', "Desktop OS" );
define( 'STATS_SERVOS', "Server OS" );

//send e-mail
define( 'SENDMAIL_MSG_HDR', "Halo, %s', \n\n" );
define( 'SENDMAIL_MSG_FTR', "\n\nSampai jumpa,\n\n%s\n\nE-mail ini dikirimkan karena anda terdaftar di %s. Jika anda tidak menginginkan menerima e-mail apapun dari kami, harap kirimkan e-mail ke %s dengan pesan untuk mengeluarkan anda dari daftar kami." );
define( 'SENDMAIL_MAIL_SENT', "terkirim" );
define( 'SENDMAIL_USER', "User" );
define( 'SENDMAIL_EMAIL', "E-mail" );
define( 'SENDMAIL_COUNTRY', "Negara" );
define( 'SENDMAIL_SEND', "Kirim" );
define( 'SENDMAIL_TEXT', "Teks" );
define( 'SENDMAIL_SUBMIT', "Kirim e-mail" );

?>