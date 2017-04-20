<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.04.2017
 * Time: 11:50
 */
include_once "Constants.php";

function SaveSetOfImagesByDateAndName($Date, $Name, $SetOfImages)
{
    var_dump($Date);
    var_dump($Name);
    var_dump($SetOfImages);
    foreach ($SetOfImages['tmp_name'] as $FileName) {
        $CurrImageBig = GetResizedImage($FileName,NEWS_BIG_PICTURES_MAXWIDTH,NEWS_BIG_PICTURES_MAXHEIGHT);
        $CurrImageSmall = GetResizedImage($FileName,NEWS_SMALL_PICTURES_MAXWIDTH,NEWS_SMALL_PICTURES_MAXHEIGHT);
        var_dump($CurrImageSmall);
        echo "----------------------";
    }
}

function GetResizedImage($SourceImagePath, $maxwidth, $maxheight)
{
// получение нового размера
    list($width, $height) = getimagesize($SourceImagePath);
    $resolution = $width / $height;

    $newwidth = $width;
    $newheight = $height;

    if ($newwidth > $maxwidth) {
        $newwidth = $maxwidth;
        $newheight = $newwidth / $resolution;
    }

    if ($newheight > $maxheight) {
        $newheight = $maxheight;
        $newwidth = $newheight * $resolution;
    }

// загрузка
    $source = imagecreatefromjpeg($SourceImagePath);
    if (($newheight == $height) && ($newwidth == $width))
        return $source;

    $thumb = imagecreatetruecolor($newwidth, $newheight);
// изменение размера
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $thumb;
}