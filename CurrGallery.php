<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include_once 'PHPModules/TempGlobalData.php';
include 'PHPModules/MainFunctions.php';
include_once 'PHPModules/Constants.php';

if(count($_GET) == 0) {
    $CurrID = "1_MainAlbum";
}
else
{
    $CurrID = $_GET['ID'];
}

$HTML_File = file_get_contents("templates/MainTemplate.html");

$Title = MAIN_TITLE  . '. Фото. ' . $AllAlbums[$CurrID]["Title"];
$Other_Attributes = "";
$Stylesheets_Addings = '<link rel="stylesheet" href="css/CustomObjectStyle.css" />
                        <link rel="stylesheet" href="css/lightbox.min.css" />
                        <link rel="stylesheet" href="css/GalleryType.css" />';

$JS_Modules_Addings = '<script type="text/javascript" src="js/WorkWithImages.js"></script>
                       <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
                       <script type="text/javascript" src="js/lightbox.js"></script>';

$JS_OnLoad_Addings = "LoadLightBox();
                      CheckGalleryForMobile(document.getElementsByClassName('ImagesSection')[0]);";

$Left_Content = FormShortNewsList($AllNews);
$Main_Content = FormSmallHeaderByStr($AllAlbums[$CurrID]["Title"]);
$Main_Content .= FillPageByTemplate(GALLERY_FOLDER . '/' . $CurrID,$CurrID . '.html', file_get_contents('templates/GalleryImageTemplate.html'));

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;