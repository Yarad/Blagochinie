<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.04.2017
 * Time: 0:25
 */

function GetImagesPathsFromFolder($FolderName)
{
    $SmallerImagesArray = scandir($FolderName . '/' . FOLDER_WITH_BIGGER_IMAGES);
    $Iterator = 0;
    foreach ($SmallerImagesArray as $Key => $CurrFileName) {
        if (($CurrFileName == ".") || ($CurrFileName == ".."))
            continue;

        if (exif_imagetype($FolderName . '/' . FOLDER_WITH_BIGGER_IMAGES . '/' . $CurrFileName)) {
            $result[$Iterator]['SmallPath'] = $FolderName . '/' . FOLDER_WITH_SMALLER_IMAGES . '/' . $CurrFileName;
            $result[$Iterator]['BigPath'] = $FolderName . '/' . FOLDER_WITH_BIGGER_IMAGES . '/' . $CurrFileName;
            $Iterator++;
        }
    }
    return $result;
}

function FormListOfImages(&$PreparedArrayOfImagesPaths)
{
    $s = file_get_contents('templates/NewsImageTemplate.html');
    $result = "";
    foreach ($PreparedArrayOfImagesPaths as $key => $Image) {
        $temp = $s;
        $temp = str_replace('{SmallImage}', $Image['SmallPath'], $temp);
        $temp = str_replace('{BigImage}', $Image['BigPath'], $temp);
        $temp = str_replace('{Title}', " ", $temp);
        $result .= $temp;
    }
    $s = file_get_contents('templates/ImagesSection.html');
    return str_replace('{Images}',$result,$s);
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
        $newheight = $newheight;
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

function FormGalleryByArray()
{
    
}

/*function ShowListOfNews(&$PreparedArrayOfImages)
{
    $s = file_get_contents('templates/NewsImageTemplate.html');
    $result = "";
    foreach ($PreparedArrayOfImages as $key => $Image) {
        $temp = $s;
        imagejpeg($PreparedArrayOfImages[$key]['Small']);
        imagejpeg($PreparedArrayOfImages[$key]['Big'], NULL);
        //str_replace('{SmallImage}',imagejpeg($PreparedArrayOfImages[$key]['Small']),$temp);
        //str_replace('{BigImage}',imagejpeg($PreparedArrayOfImages[$key]['Big']),$temp);
        //str_replace('{Title}'," ",$temp);
        $result .= $temp;
    }
}*/


//в результате ресурс
/*
function GetImagesFromFolder($FolderName)
{
    $PlainImagesArray = scandir($FolderName);
    foreach ($PlainImagesArray as $Key => $CurrFileName) {
        if (($CurrFileName == ".") || ($CurrFileName == ".."))
            continue;

        if (exif_imagetype($FolderName . '/' . $CurrFileName)) {
            $result[]['small'] = GetResizedImage($FolderName . '/' . $CurrFileName, NEWS_SMALL_PICTURES_MAXWIDTH, NEWS_SMALL_PICTURES_MAXHEIGHT);
            $result[]['big'] = GetResizedImage($FolderName . '/' . $CurrFileName, NEWS_BIG_PICTURES_MAXWIDTH, NEWS_BIG_PICTURES_MAXHEIGHT);
        }
    }
    return $result;
}
*/