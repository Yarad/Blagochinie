<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 17:28
 */
include_once "../PHPModules/Constants.php";
include_once "../PHPModules/GlobalFunctions.php";
include_once "../PHPModules/WorkWithImages.php";

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


$AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);
if($AdminsRecordsDatabase==false)
{
    echo file_get_contents('../admin_templates/DatabaseError.html');
    exit();
}
var_dump($_POST);
$QueryResult = mysqli_query($AdminsRecordsDatabase, "INSERT INTO `news`(`Date`, `ChurchID`, `Name`, `Annotation`) VALUES ('".$_POST['fDate']."','NULL','".$_POST['fNewsName']."','". $_POST['fNewsAnnotation']."')");
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
