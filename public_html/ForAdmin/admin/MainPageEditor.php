<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 12:14
 */
include 'PHPModules/GlobalFunctions.php';
include_once '../WholeProjectConstants/DatabaseConnection.php';
include_once '../WholeProjectConstants/ProjectPaths.php';

$DefaultText = '';
$DefaultDate = '';
$DefaultName = '';
$DefaultAnnotation = '';
$AddSetOfPhotosStyle = '';

if (CheckSecurity() == false) {
    echo file_get_contents('admin_templates/AccessDenied.html');
    exit();
}
$s = file_get_contents('admin_templates/MainAdminEditorTemplate.html');
if (!isset($_COOKIE['Type']))
{
    var_dump($_COOKIE);
    echo '<button >Проба</button>';
    exit;
}

if ($_COOKIE['Type'] == "Edit") {
    $Database = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    if ($Database == false) {
        echo file_get_contents('admin_templates/DatabaseError.html');
        exit();
    }

    $EditedNews_DB = mysqli_query($Database,"SELECT * FROM `" . NEWS_DATABASE ."` WHERE " . ID_FIELD . "=" . $_POST['fIDToEdit']);
    mysqli_close($Database);
    if ($EditedNews_DB == false) {
        echo file_get_contents('admin_templates/DatabaseQueryError.html');
        exit();
    }

    $EditedNews = mysqli_fetch_array($EditedNews_DB,MYSQLI_ASSOC);
    $DateArr = explode('-', $EditedNews[DATE_FIELD]);

    $DefaultName = $EditedNews[NEWS_NAME_FIELD];
    $DefaultAnnotation = $EditedNews[ANNOTATION_FIELD];
    $DefaultDate = $EditedNews[DATE_FIELD];
    $DefaultText = file_get_contents(PATH_FROM_SAVERS_TO_USER_VERSION . NEWS_FOLDER . '/' . $DateArr[0] . '/' . $EditedNews[ID_FIELD] . '_' . $DateArr[2] . '.' . $DateArr[1] . '/' . CURR_NEWS_PAGE);

    setcookie(NEWS_ID_COOKIE_NAME,$_POST['fIDToEdit']);
    $AddSetOfPhotosStyle = 'display:none';
}
$s = str_replace('{DefaultName}',$DefaultName,$s);
$s = str_replace('{AddSetOfPhotosStyle}',$AddSetOfPhotosStyle,$s);
$s = str_replace('{DefaultDate}',$DefaultDate,$s);
$s = str_replace('{DefaultAnnotation}',$DefaultAnnotation,$s);
$s = str_replace('{DefaultText}',$DefaultText,$s);
$s = str_replace("{MainMenu}",file_get_contents('admin_templates/MainMenuTemplate.html'),$s);
echo $s;