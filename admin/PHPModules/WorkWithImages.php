<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.04.2017
 * Time: 11:50
 */
//GetResizedImage('D://temp.tmp', 700, 700);

function SaveSetOfImagesByDateNameAndNum($DateArr, $SetName, $ID, $SetOfImages)
{
    //var_dump($SetOfImages);
    include "Constants.php";

    //big-small*/
    $BigImagesPath = $path_from_savers_to_user_version . $NEWS_FOLDER . '/' . $DateArr[0] . '/' . $ID . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . $SetName . '/' . $FOLDER_WITH_BIGGER_IMAGES . '/';
    $SmallImagesPath = $path_from_savers_to_user_version . $NEWS_FOLDER . '/' . $DateArr[0] . '/' . $ID . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . $SetName . '/' . $FOLDER_WITH_SMALLER_IMAGES . '/';
    mkdir($BigImagesPath,0777,true);
    mkdir($SmallImagesPath,0777,true);

    chmod($BigImagesPath,0777);
    var_dump(is_writable($BigImagesPath));
    foreach ($SetOfImages['tmp_name'] as $FileName) {
        $CurrImageBig = GetResizedImage($FileName, $NEWS_BIG_PICTURES_MAXWIDTH, $NEWS_BIG_PICTURES_MAXHEIGHT);
        $CurrImageSmall = GetResizedImage($FileName, $NEWS_SMALL_PICTURES_MAXWIDTH, $NEWS_SMALL_PICTURES_MAXHEIGHT);

        $i=1;
        $ImageType = exif_imagetype($FileName);
        switch ($ImageType) {
            case IMAGETYPE_JPEG: imagejpeg($CurrImageBig,$BigImagesPath . $i . $jpg_format); imagejpeg($CurrImageSmall,$SmallImagesPath . $i . $jpg_format); break;
            case IMAGETYPE_PNG: imagepng($CurrImageBig,$BigImagesPath . $i . $png_format); imagejpeg($CurrImageSmall,$SmallImagesPath . $i . $png_format);  break;
            case IMAGETYPE_GIF: imagegif($CurrImageBig,$BigImagesPath . $i . $gif_format); imagejpeg($CurrImageSmall,$SmallImagesPath . $i . $gif_format);  break;
            default: echo '';
        }
        $i++;
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
    $ImageType = exif_imagetype($SourceImagePath);
    switch ($ImageType) {
        case IMAGETYPE_JPEG: $source = imagecreatefromjpeg($SourceImagePath); break;
        case IMAGETYPE_PNG: $source = imagecreatefrompng($SourceImagePath); break;
        case IMAGETYPE_GIF: $source = imagecreatefromgif($SourceImagePath);break;
        default: return null;
    }

    if (($newheight == $height) && ($newwidth == $width))
        return $source;
    $thumb = imagecreatetruecolor($newwidth, $newheight);
// изменение размера
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $thumb;
}