<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 17:28
 */
//include_once "../PHPModules/ImagesConstants.php";
include_once "PHPModules/GlobalFunctions.php";
include_once "PHPModules/WorkWithImages.php";
include_once "../WholeProjectConstants/DatabaseConnection.php";
include "../WholeProjectConstants/ProjectPaths.php";

if (CheckSecurity() == false) {
    echo file_get_contents('../admin_templates/AccessDenied.html');
    exit();
}


$Result = '';
if ($_COOKIE["Type"] == "Delete") {
    $Result = DeleteNewsById($_POST["fIDToDelete"]);
} elseif ($_COOKIE["Type"] == "Add")
    $Result = AddNews();
elseif ($_COOKIE["Type"] == "Edit") {
    $Result = EditNewsById($_COOKIE[NEWS_ID_COOKIE_NAME]);
}
elseif ($_COOKIE["Type"] == "UpdateTimetable") {
    $Result = UpdateTimeTableByChurchId($_COOKIE[CHURCHES_ID_COOKIE_NAME]);
}
setcookie('Type','');

$s = file_get_contents('admin_templates/EditingResult.html');
$s = str_replace("{POST}", "<h2 align='center'>POST</h2><pre>" . print_r($_POST,true) . "<br><h2 align='center'>FILES</h2>" . print_r($_FILES,true) . "</pre>", $s);
$s = str_replace('{content}', $Result, $s);
$s = str_replace("{MainMenu}",file_get_contents('admin_templates/MainMenuTemplate.html'),$s);
echo $s;

function AddNews()
{
    if (!isset($_POST['fPreparedHtmlContent'])) return WRONG_DATA;

    $Database = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    if ($Database == false) return DATABASE_IS_CLOSED;

    $QueryResult = mysqli_query($Database, "INSERT INTO `" . NEWS_DATABASE . "`(`" . DATE_FIELD . "`, `" . CHURCH_ID_FIELD . "`, `" . NEWS_NAME_FIELD . "`,`" . ANNOTATION_FIELD . "`) VALUES ('" . $_POST['fDate'] . "','NULL','" . $_POST['fNewsName'] . "','" . $_POST['fNewsAnnotation'] . "')");

    if ($QueryResult == false) return DATABASE_QUERY_MISTAKE;

    $AddedId = mysqli_insert_id($Database);
    mysqli_close($Database);

    $DateArr = explode("-", $_POST['fDate']);
//0 - год
//1 - месяц
//2 - число
    foreach ($_FILES as $CurrSetKey => $CurrSetValue) {
        $Num = explode("_", $CurrSetKey)[1];
        $CurrSetName = $_POST['fSetsOfPhotosNames_'.$Num];
        SaveSetOfImagesByDateNameAndNum($DateArr, $CurrSetName, $AddedId, $CurrSetValue);
    }
    if(count($_FILES)==0)
    {
        $NewsFolderPath = PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $AddedId . '_' . $DateArr[2] . '.' . $DateArr[1];
        mkdir($NewsFolderPath, 0777, true);
    }
    file_put_contents(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $AddedId . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . CURR_NEWS_PAGE, $_POST['fPreparedHtmlContent']);
    return ADDED_SUCCESSFULLY . "ID = $AddedId";
}

function DeleteNewsById($DeletedNewsId)
{
    $Database = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    if ($Database == false) return DATABASE_IS_CLOSED;

    $DateDBAnswer = mysqli_query($Database, "SELECT `" . DATE_FIELD . "` FROM `" . NEWS_DATABASE . "` WHERE " . ID_FIELD . "=" . $DeletedNewsId);
    $QueryResult = mysqli_query($Database, "DELETE FROM `" . NEWS_DATABASE . "` WHERE " . ID_FIELD . "=" . $DeletedNewsId);

    $DateDB = mysqli_fetch_array($DateDBAnswer)[0];
    $DateArr = explode('-', $DateDB);

    mysqli_close($Database);
    var_dump($DateArr);
    var_dump($QueryResult);
    if ((count($DateArr)==0) || ($QueryResult==false)) return DATABASE_QUERY_MISTAKE;

    //rmdir(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $DeletedNewsId . '_' . $DateArr[2] . '.' . $DateArr[1]);
    $DelRes = removeDirectory(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $DeletedNewsId . '_' . $DateArr[2] . '.' . $DateArr[1]);
    if ($DelRes == true)
        return DELETED_SUCCESSFULLY;
    else
        return DELETE_ERROR;


}

function EditNewsById($ID){
    if (!isset($_POST['fPreparedHtmlContent'])) return WRONG_DATA;

    $Database = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    if ($Database == false) return DATABASE_IS_CLOSED;

    $QueryResult = mysqli_query($Database,"UPDATE `" .NEWS_DATABASE."` SET `Date`='". $_POST['fDate'] ."',`ChurchID`='NULL',`Name`='" . $_POST['fNewsName'] . "',`Annotation`='" . $_POST['fNewsAnnotation'] ."' WHERE `".ID_FIELD."` =".$ID);
    if ($QueryResult == false) return DATABASE_QUERY_MISTAKE;

    mysqli_close($Database);

    $DateArr = explode("-", $_POST['fDate']);
//0 - год
//1 - месяц
//2 - число
    file_put_contents(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $ID . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . CURR_NEWS_PAGE, $_POST['fPreparedHtmlContent']);
    return UPDATED_SUCCESSFULLY . "ID = $ID";
}

function UpdateTimeTableByChurchId($ID){
    if (!isset($_POST['fPreparedHtmlContent'])) return WRONG_DATA;
    file_put_contents(PATH_FROM_SAVERS_TO_USER_VERSION . "churches/Timetable" . '/' . $ID .'/' . $ID .'.html', $_POST['fPreparedHtmlContent']);
    return UPDATED_SUCCESSFULLY . "ID = $ID";
}