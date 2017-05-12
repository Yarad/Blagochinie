<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include 'PHPModules/LoadingFromDatabase.php';
include 'PHPModules/MainFunctions.php';
include 'ForAdmin/WholeProjectConstants/ProjectPaths.php';

$AllNews = GetAllNews();
$FeedBackInfo = GetFeedBackInfo();

$HTML_File = file_get_contents("templates/MainTemplate.html");

$Title = 'Обратная связь';
$Other_Attributes = "<meta name = 'description' content='Обратная связь со священниками Осиповичского района' />";

$Stylesheets_Addings = '<link rel="stylesheet" href="css/feedback.css">';

$JS_Modules_Addings = '';

$JS_OnLoad_Addings = "";

$Left_Content = FormShortNewsList($AllNews);

$Main_Content = FormSmallHeaderByStr("Обратная связь") . '<p align="center">(Выберите того, кому хотите написать, и заполните сообщение снизу страницы)</p>' . FormFeedbackRecords($FeedBackInfo);

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;