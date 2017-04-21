<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 17:28
 */
//include_once "../PHPModules/ImagesConstants.php";
include_once "../PHPModules/GlobalFunctions.php";
include_once "../PHPModules/WorkWithImages.php";
include_once "../../WholeProjectConstants/DatabaseConnection.php";
include "../../WholeProjectConstants/ProjectPaths.php";

if (CheckSecurity() == false)
{
    echo file_get_contents('../admin_templates/AccessDenied.html');
    exit();
}

if(!isset($_POST['fPreparedHtmlContent']))
{
    echo file_get_contents('../admin_templates/WrongInput.html');
    exit();
}


$AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
if($AdminsRecordsDatabase==false)
{
    echo file_get_contents('../admin_templates/DatabaseError.html');
    exit();
}
var_dump($_POST);

$QueryResult = mysqli_query($AdminsRecordsDatabase, "INSERT INTO `news`(`".DATE_FIELD."`, `".CHURCH_ID_FIELD ."`, `".NEWS_NAME_FIELD."`,`".ANNOTATION_FIELD."`) VALUES ('".$_POST['fDate']."','NULL','".$_POST['fNewsName']."','". $_POST['fNewsAnnotation']."')");

if($QueryResult==false)
{
    echo file_get_contents('../admin_templates/DatabaseSaveError.html');
    exit();
}
$AddedId = mysqli_insert_id($AdminsRecordsDatabase);
mysqli_close($AdminsRecordsDatabase);

//var_dump($_POST);
//var_dump($_FILES);

$DateArr = explode("-",$_POST['fDate']);
//0 - год
//1 - месяц
//2 - число
foreach ($_FILES as $CurrSetKey => $CurrSetValue)
{
    $Num = explode("_",$CurrSetKey)[1];
    $CurrSetName = $_POST['fSetsOfPhotosNames'][$Num];
    SaveSetOfImagesByDateNameAndNum($DateArr,$CurrSetName,$AddedId,$CurrSetValue);
}
file_put_contents(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $AddedId . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . CURR_NEWS_PAGE,$_POST['fPreparedHtmlContent']);
