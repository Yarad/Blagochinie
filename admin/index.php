<?php
include('PHPModules/Constants.php');

if (isset($_POST['login']) && isset($_POST['password'])) {
    $Login = $_POST['login'];
    $Password = $_POST['password'];

    $AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);
    $RecordByLoginAndPassword = mysqli_query($AdminsRecordsDatabase, "SELECT * FROM `$admins_records_database` WHERE $login_field='$Login' AND `$password_field`='$Password'");

    if ($RecordByLoginAndPassword->num_rows == 0) {
        echo file_get_contents('admin_templates/LoginPageTemplate.html');
        echo "<h1>Ошибка</h1>";
    } else {
        $CurrUser = mysqli_fetch_array($RecordByLoginAndPassword);
        $ThisSessionHashCode = generateCode();
        mysqli_query($AdminsRecordsDatabase, "UPDATE `admins_records` SET `$hash_field_name`='$ThisSessionHashCode' WHERE $id_field='" . $CurrUser['$id_field'] . "'");

        setcookie($id_field, $CurrUser[$id_field]);
        setcookie($hash_field_name, $CurrUser[$hash_field_name]);

        header("Location: MainAdminPage.php");
        exit();
    }
} else
    echo file_get_contents('admin_templates/LoginPageTemplate.html');

function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {

        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}