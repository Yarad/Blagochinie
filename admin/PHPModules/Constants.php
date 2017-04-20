<?php
$host = 'localhost'; // адрес сервера
$database_name = 'blagoosip';
$table_admins_records = 'admins_records'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль

$admins_records_database = 'admins_records';
$login_field = 'admin_login';
$password_field = 'admin_password';
$id_field = 'id';
$hash_field_name = "curr_session_hash";

$path_from_savers_to_user_version = "../../public_html/";

//папки
define('CHURCHES_TIMETABLE_FOLDER', 'churches/Timetable');
define('CHURCHES_INFO_FOLDER', 'churches/Info');
define('CHURCHES_PREPHOTO_FOLDER','churches/PrePhoto');
define('GALLERY_FOLDER','Gallery');
define('GALLERY_PREPHOTO_FOLDER','Gallery/PrePhoto');

define('FOLDER_WITH_LOCAL_IMAGES', 'images');
define('NEWS_FOLDER', 'news');
define('FOLDER_WITH_SMALLER_IMAGES', 'small');
define('FOLDER_WITH_BIGGER_IMAGES', 'big');

//значения
define('NEWS_SMALL_PICTURES_MAXWIDTH', 700);
define('NEWS_SMALL_PICTURES_MAXHEIGHT', 700);

define('NEWS_BIG_PICTURES_MAXWIDTH', 1200);
define('NEWS_BIG_PICTURES_MAXHEIGHT', 1200);