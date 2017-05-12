<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.04.2017
 * Time: 11:09
 */
define('HOST', 'localhost'); // адрес сервера
define('DATABASE_NAME' ,'blagoosip');
define('TABLE_ADMINS_RECORDS' , 'admins_records'); // имя базы данных
define('USER' , 'root'); // имя пользователя
define('PASSWORD' , 'root'); // пароль

////////////////////////////////////////////////////////////////////
define('ADMINS_RECORDS_DATABASE' , 'admins_records');

define('LOGIN_FIELD' , 'admin_login');
define('PASSWORD_FIELD' , 'admin_password');
define('ID_FIELD' , 'id');
define('HASH_FIELD_NAME' , "curr_session_hash");
define('SALT_STRING','Silentium');
///////////////////////////////////////////////////////////

define('NEWS_ID_COOKIE_NAME','EditingNewsId');
define('NEWS_DATABASE' , 'news');
define('DATE_FIELD','Date');
define('CHURCH_ID_FIELD','ChurchID');
define('NEWS_NAME_FIELD','Name');
define('ANNOTATION_FIELD','Annotation');

///////////////////////////////////////////////////////////////
define('DATABASE_IS_CLOSED',"Нет доступа к базе данных");
define('DATABASE_QUERY_MISTAKE',"Ошибка запроса к базе данных: что-то не так с новостью");
define('DELETED_SUCCESSFULLY',"Успешно удалено");
define('DELETE_ERROR',"Ошибка удаления");
define('ADDED_SUCCESSFULLY',"Успешно добавлено.");
define('UPDATED_SUCCESSFULLY',"Успешно обновлено.");
define('WRONG_DATA',"Данные введены неверно");