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
            if (file_exists($FolderName . '/' . FOLDER_WITH_SMALLER_IMAGES))
                $result[$Iterator]['SmallPath'] = $FolderName . '/' . FOLDER_WITH_SMALLER_IMAGES . '/' . $CurrFileName;
            if (file_exists($FolderName . '/' . FOLDER_WITH_BIGGER_IMAGES))
                $result[$Iterator]['BigPath'] = $FolderName . '/' . FOLDER_WITH_BIGGER_IMAGES . '/' . $CurrFileName;
            $Iterator++;
        }
    }
    return $result;
}

function FormListOfImages(&$PreparedArrayOfImagesPaths, $template)
{
    $s = $template;
    $result = "";
    foreach ($PreparedArrayOfImagesPaths as $key => $Image) {
        $temp = $s;
        $temp = str_replace('{SmallPath}', $Image['SmallPath'], $temp);

        if (isset($Image["BigPath"]))
            $temp = str_replace('{BigPath}', $Image['BigPath'], $temp);
        else
            $temp = str_replace('{BigPath}'," ", $temp);

        //эти будут у всех стандартные. Расширяем ниже!
        if (isset($Image["Title"]))
            $temp = str_replace('{Title}', $Image["Title"], $temp);
        else
            $temp = str_replace('{Title}', " ", $temp);

        if (isset($Image["Link"]))
            $temp = str_replace('{Link}', $Image["Link"], $temp);

        $result .= $temp;
    }
    $s = file_get_contents('templates/ImagesSection.html');
    return str_replace('{Images}', $result, $s);
}

function FormGalleriesShortInfo(&$GalleryArray, $PrePhotoFolder,$CurrGalleryHandler)
{
    $s = file_get_contents('templates/GalleryAlbumTemplate.html');
    $result = "";
    foreach ($GalleryArray as $key => $Image) {
        $temp = $s;
        $temp = str_replace('{SmallPath}', $PrePhotoFolder . '/' . $Image['SmallImageName'], $temp);
        $temp = str_replace('{Title}',$Image["Title"],$temp);
        $temp = str_replace('{Link}', $CurrGalleryHandler . '?'. "ID=" . $Image["ID"], $temp);
        $result .= $temp;
    }
    $s = file_get_contents('templates/ImagesSection.html');
    return str_replace('{Images}', $result, $s);
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