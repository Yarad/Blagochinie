<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.04.2017
 * Time: 13:49
 */
include('PHPModules/GlobalFunctions.php');
include('../WholeProjectConstants/DatabaseConnection.php');


if (CheckSecurity() == false) {
    echo file_get_contents('admin_templates/AccessDenied.html');
    exit();
}

$s = file_get_contents('admin_templates/DatabaseTest.html');
$s = str_replace('{MainMenu}', file_get_contents('admin_templates/MainMenuTemplate.html'), $s);
$Result = "";
$JSOnLoadAddings = "";

if (isset($_POST['fSQLRequest'])) {

    $Testing = [];
    for ($i = 1; $i <= $_POST['fMaxRequestsAmount']; $i++)
        $Testing[$i] = GetTransactionTimeByQuery($_POST['fSQLRequest'], $i);

    $Result = "";
    for ($i = 1; $i <= $_POST['fMaxRequestsAmount']; $i++)
        $Result .= $i . ' req - ' . $Testing[$i] * 1000 . 'ms<br>';
    $TestingInJSON = json_encode(array_values($Testing), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    $JSOnLoadAddings = "FormGraphicByIdArrAndHeight('ResultBlock','ResultSchemeDialY','ResultSchemeDialX',$TestingInJSON,500)";
}

$s = str_replace("{JSOnLoadAddings}", $JSOnLoadAddings, $s);
echo $s;


function GetTransactionTimeByQuery($Query, $Amount)
{
    $DatabaseConnect = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);

    $StartTime = microtime(true);
    for ($i = 0; $i < $Amount; $i++)
        $TempResult = mysqli_query($DatabaseConnect, $Query);
    $EndTime = microtime(true);
    return $EndTime - $StartTime;
}