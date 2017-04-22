<?php
include('PHPModules/GlobalFunctions.php');
include('../WholeProjectConstants/DatabaseConnection.php');

if (isset($_POST['exit'])) ExitById($_COOKIE[ID_FIELD]);
if (CheckSecurity() == true) header("Location: MainAdminPage.php");

//если не введен пароль или нажато "выход", отображаем начальную страницу
if (!isset($_POST['login']) || !isset($_POST['password'])) {
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    exit();
}


$Login = $_POST['login'];
$Password = $_POST['password'];
$AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);

//если база данных недоступна
if ($AdminsRecordsDatabase == false) {
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    echo file_get_contents('admin_templates/DatabaseError.html');
    exit();
}

$RecordByLoginAndPassword = mysqli_query($AdminsRecordsDatabase, "SELECT * FROM `" . ADMINS_RECORDS_DATABASE ."` WHERE " . LOGIN_FIELD ."='$Login' AND `" . PASSWORD_FIELD ."`='$Password'");

//если пароль введен неверно
if ($RecordByLoginAndPassword->num_rows == 0) {
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    echo file_get_contents('admin_templates/LoginError.html');
    exit();
}

$CurrUser = mysqli_fetch_array($RecordByLoginAndPassword);
$ThisSessionHashCode = generateCode();
mysqli_query($AdminsRecordsDatabase, "UPDATE `" . ADMINS_RECORDS_DATABASE . "` SET `" . HASH_FIELD_NAME ."`='" . $ThisSessionHashCode . "' WHERE " . ID_FIELD ."='" . $CurrUser[ID_FIELD] . "'");

setcookie(ID_FIELD, $CurrUser[ID_FIELD]);
setcookie(HASH_FIELD_NAME, $ThisSessionHashCode);

mysqli_close($AdminsRecordsDatabase);
header("Location: MainAdminPage.php");


