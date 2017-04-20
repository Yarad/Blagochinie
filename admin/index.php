<?php
include('PHPModules/Constants.php');
include('PHPModules/GlobalFunctions.php');


if (CheckSecurity() == true) header("Location: MainAdminPage.php");

//если не введен пароль, отображаем начальную страницу
if (!isset($_POST['login']) || !isset($_POST['password'])) {
    if (isset($_POST['exit'])) ExitById($_COOKIE[$id_field]);
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    exit();
}

$Login = $_POST['login'];
$Password = $_POST['password'];
$AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);

//если база данных недоступна
if ($AdminsRecordsDatabase == false) {
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    echo file_get_contents('admin_templates/DatabaseError.html');
    exit();
}

$RecordByLoginAndPassword = mysqli_query($AdminsRecordsDatabase, "SELECT * FROM `$admins_records_database` WHERE $login_field='$Login' AND `$password_field`='$Password'");

//если пароль введен неверно
if ($RecordByLoginAndPassword->num_rows == 0) {
    echo file_get_contents('admin_templates/LoginPageTemplate.html');
    echo file_get_contents('admin_templates/LoginError.html');
    exit();
}

$CurrUser = mysqli_fetch_array($RecordByLoginAndPassword);
$ThisSessionHashCode = generateCode();
mysqli_query($AdminsRecordsDatabase, "UPDATE `admins_records` SET `$hash_field_name`='" . $ThisSessionHashCode . "' WHERE $id_field='" . $CurrUser[$id_field] . "'");

setcookie($id_field, $CurrUser[$id_field]);
setcookie($hash_field_name, $ThisSessionHashCode);

mysqli_close($AdminsRecordsDatabase);
header("Location: MainAdminPage.php");


