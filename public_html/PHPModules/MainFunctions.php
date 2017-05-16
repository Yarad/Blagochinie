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

    $Amount = 0;
    //for ($i = 0; ($i < SHORT_NEWS_AMOUNT) && ($i < count($InputNewsArray)); $i++) {
    foreach ($InputNewsArray as $id => $CurrNews) {
        $PostReq = $HrefUrl . '?' . 'Date=' . $CurrNews["Date"] . '&' . 'Num=' . $id;
        $temp = str_replace('{Link}', $PostReq, $s2);
        $temp = str_replace('{Text}', $CurrNews["Date"] . '<br> ' . $CurrNews["Name"], $temp);
        $s .= $temp;
        $Amount++;
        if ($Amount == SHORT_NEWS_AMOUNT) break;
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

function FormFeedbackRecords(&$AllRecords)
{
    $Result = file_get_contents('templates/FeedbackBlockTemplate.html');
    $Recievers = '';
    $tempName='';
    $Files = glob("feedback/images/*");
    $OneRecordTemplate = file_get_contents('templates/FeedbackRecordTemplate.html');
    foreach ($AllRecords as $CurrRecord) {
        foreach ($Files as $CurrFileName)
            if (explode('.', $CurrFileName)[0] == "feedback/images/" . $CurrRecord['id']) {
                $tempName = $CurrFileName;
                break;
            }
        $temp = str_replace('{ImagePath}', $tempName, $OneRecordTemplate);
        $temp = str_replace('{Text}', $CurrRecord['caption'], $temp);
        $temp = str_replace('{PersonDescription}', $CurrRecord['person_description'], $temp);
        $temp = str_replace('{Id}', $CurrRecord['id'], $temp);
        $Recievers .= $temp;
    }
    $Result = str_replace('{Recievers}',$Recievers,$Result);
    return $Result;
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