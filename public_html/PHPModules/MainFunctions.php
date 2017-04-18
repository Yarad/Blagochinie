<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 14:55
 */
require "Constants.php";
include "WorkWithImages.php";

//генерирует упрощенный список новостей из массива. Тип хранения еще
//не определен. Нужно разобраться с БД и уже подключать через неё
function FormShortNewsList(&$InputNewsArray)
{
    $HrefUrl = "news.php";
    $s = FormSmallHeaderByStr(SHORT_NEWS_TITLE);
    $s2 = file_get_contents('templates/ShortNewsTemplate.html');

    for ($i = 0; ($i < SHORT_NEWS_AMOUNT) && ($i < count($InputNewsArray)); $i++) {
        $PostReq = $HrefUrl . '?' . 'Date=' . $InputNewsArray[count($InputNewsArray)-$i-1]["Date"] . '&' . 'Num=' . (count($InputNewsArray)-$i-1);
        $temp = str_replace('{Link}', $PostReq, $s2);
        $temp = str_replace('{Text}', $InputNewsArray[count($InputNewsArray)-$i-1]["Date"] . '<br> ' . $InputNewsArray[count($InputNewsArray)-$i-1]["Name"], $temp);
        $s .= $temp;
    }
    return $s;
}

function FormCurrNewsContentByNum(&$AllNews, $Num)
{
    $Time = strtotime($AllNews[$Num]['Date']);
    $Year = strftime("%Y", $Time);
    $DateFormatted = strftime("%d.%m", $Time);
    $FolderPath = NEWS_FOLDER . '/' . $Year . '/' . $Num . '_' . $DateFormatted;

    $NewsTemplate = FormBigNewsHeaderByStr($AllNews[$Num]['Date'] . ' ' . $AllNews[$Num]['Name']);
    $NewsTemplate .= FillPageByTemplate($FolderPath, CURR_NEWS_PAGE, file_get_contents('templates/NewsImageTemplate.html'));
    return $NewsTemplate;
}

function FillPageByTemplate($FolderPath, $TemplatePageName, $OneImageTemplate)
{
    $TemplatePage = file_get_contents($FolderPath . '/' . $TemplatePageName);

    preg_match_all(REGULAR_EXPRESSION_FOR_IMAGES_PLACES, $TemplatePage, $ImagesPlaces);
    $ImagesPlaces = MultiArrInPlainArr($ImagesPlaces);

    foreach ($ImagesPlaces as $key => $ImagesPlace) {
        $BigAndSmallImagesPathsArray = GetImagesPathsFromFolder($FolderPath . '/' . substr($ImagesPlace, 1, strlen($ImagesPlace) - 2));
        $Temp = FormListOfImages($BigAndSmallImagesPathsArray, $OneImageTemplate);
        $TemplatePage = str_replace($ImagesPlace, $Temp, $TemplatePage);
    }
    return $TemplatePage;
}

function MultiArrInPlainArr(&$MultiArray)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($MultiArray));

    $result = array();
    foreach ($iterator as $key => $value) {
        $result[] = $value; // тут возвращаете как вам хочется
    }
    return $result;
}

function FormSmallHeaderByStr($text)
{
    return str_replace('{Header}', $text, file_get_contents('templates/SmallHeadersTemplate.html'));
}

function FormBigNewsHeaderByStr($text)
{
    return str_replace('{Header}', $text, file_get_contents('templates/APieceOfNewsHeader.html'));
}