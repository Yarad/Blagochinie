<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include_once 'PHPModules/LoadingFromDatabase.php';
include 'PHPModules/MainFunctions.php';
include_once 'PHPModules/Constants.php';

$HTML_File = file_get_contents("templates/MainTemplate.html");
$AllNewsInJSON = json_encode($AllNews, JSON_UNESCAPED_UNICODE);

$Title = MAIN_TITLE   . ' Расписания богослужений.' ;
$Other_Attributes = "<meta name='description' content='Расписание богослужений. Службы. Телефон.'>";
$Stylesheets_Addings = '<link rel="stylesheet" href="css/CustomObjectStyle.css">
                        <link rel="stylesheet" href="css/GalleryType.css">';
$JS_Modules_Addings = '<script type="text/javascript" src="js/WorkWithImages.js"></script>';

$JS_OnLoad_Addings = "";

$Left_Content = FormShortNewsList($AllNews);
$Main_Content = FormSmallHeaderByStr(CHURCHES_TIMETABLE_TITLE);
$Main_Content .= FormGalleriesShortInfo($AllChurches,CHURCHES_PREPHOTO_FOLDER,"CurrChurchTimetable.php");

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;