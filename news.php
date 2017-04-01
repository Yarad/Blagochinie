<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include 'PHPModules/TempGlobalData.php';
include 'PHPModules/MainFunctions.php';

$AllNewsInJSON = json_encode($AllNews);

if(count($_GET) == 0) {
    $CurrNum = 0;
    $CurrDate = $AllNews[0]['Date'];
}
else
{
    $CurrNum = $_GET['Num'];
    $CurrDate =$_GET['Date'];
}

$HTML_File = file_get_contents("templates/MainTemplate.html");

$Other_Attributes = "";
$Stylesheets_Addings = ' <link rel="stylesheet" href="css/lightbox.min.css" >
                         <link rel="stylesheet" href="css/GalleryType.css" >';

$JS_Modules_Addings = '<script type="text/javascript" src="js/WorkWithImages.js"></script>
                       <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
                       <script type="text/javascript" src="js/lightbox.js"></script>
                       <script type="text/javascript" src="local_data.js"></script>';

$JS_OnLoad_Addings ="
            //var Doc = document.getElementsByClassName('ImagesSection');
            //LoadImagesByList(ImagesInfo,Doc[0], 'ImgInNews');

            //LoadLightBox();";

$Left_Content = FormShortNewsList($AllNews);

$Main_Content = FormCurrNewsTitleByNum($AllNews,$CurrNum);
$Main_Content .=


$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;