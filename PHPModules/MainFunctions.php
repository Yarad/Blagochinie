<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 14:55
 */
require "Constants.php";

//генерирует упрощенный список новостей из массива. Тип хранения еще
//не определен. Нужно разобраться с БД и уже подключать через неё
function FormShortNewsList(&$InputNewsArray)
{
    $HrefUrl = "news.php";
    $s = '<h3 class="APieceOfNewsTitle" align="center">Новости</h3>';

    for ($i = 0; ($i < SHORT_NEWS_AMOUNT) && ($i < count($InputNewsArray)); $i++) {
        $PostReq = $HrefUrl . '?' . 'Date=' . $InputNewsArray[$i]["Date"] . '&' . 'Num=' . $i;
        $s .= '<a class = "News" href="' . $PostReq . '">
            <p class="ShortNewsForm Caps">' .
            $InputNewsArray[$i]["Date"] . '<br> ' . $InputNewsArray[$i]["Name"] .
            '</p></a>';
    }
    return $s;
}
function FormCurrNewsTitleByNum(&$AllNews, $Num)
{
    return '<h3 class="APieceOfNewsTitle Caps" id="NewsTitle">' . $AllNews[$Num]['Date'] . ' ' . $AllNews[$Num]['Name'] . '</h3>';
}
function FormCurrNewsContentByNum(&$AllNews, $Num)
{
    $Time = strtotime($AllNews[$Num]['Date']);
    $Year = strftime("%Y",$Time);
    $DateFormatted = strftime("%d.%m",$Time);

    $s = file_get_contents(NEWS_FOLDER . '/' . $Year . '/' . $Num . '_' . $DateFormatted . '/' . CURR_NEWS_PAGE);
    //здесь нужно закончить. нечто вроде поиска выражений для замены на images
}
//парсит строку, выделяя из нее то, что мне нужно