<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include 'PHPModules/LoadingFromDatabase.php';
include 'PHPModules/MainFunctions.php';
include "../WholeProjectConstants/DatabaseConnection.php";


$HTML_File = file_get_contents("templates/MainTemplate.html");
$AllNews = GetAllNews();
$AllNewsInJSON = json_encode($AllNews,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
$Title = MAIN_TITLE;
$Other_Attributes = '<meta name="yandex-verification" content="a8dbe64e572bc87a" />
					 <meta name="description" content="Осиповичское благочиние. Белорусская православная церковь. Новости Осиповичи. Расписание богослужений." />';
$Stylesheets_Addings = '<link rel="stylesheet" href="css/CustomObjectStyle.css">';
$JS_Modules_Addings = "";
$JS_OnLoad_Addings = "LoadNews($AllNewsInJSON,'MainContentID');";

$Left_Content = file_get_contents("templates/ClerkAdvertisment.html");
$Main_Content = "";

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;