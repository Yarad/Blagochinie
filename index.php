<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include 'PHPModules/TempGlobalData.php';
include 'PHPModules/MainFunctions.php';

$HTML_File = file_get_contents("templates/MainTemplate.html");
$AllNewsInJSON = json_encode($AllNews , JSON_UNESCAPED_UNICODE);

$Other_Attributes = "";
$Stylesheets_Addings = '<link rel="stylesheet" href="css/CustomObjectStyle.css">';
$JS_Modules_Addings = "";
$JS_OnLoad_Addings = "LoadNews($AllNewsInJSON,'MainContentID');";

$Left_Content = file_get_contents("templates/ClerkAdvertisment.html");
$Main_Content = "";

$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;