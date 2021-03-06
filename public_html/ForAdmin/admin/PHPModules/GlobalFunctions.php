<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 1:18
 */
function CheckSecurity()
{
    if(!isset($_COOKIE[ID_FIELD])) return false;

    $AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    if ($AdminsRecordsDatabase == false) return false;

    $CookieID = $_COOKIE[ID_FIELD];
    $CookieHash = $_COOKIE[HASH_FIELD_NAME];

    if ($CookieID == false) {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }

    $HashSumByID = mysqli_query($AdminsRecordsDatabase, "SELECT " . HASH_FIELD_NAME . " FROM `" . ADMINS_RECORDS_DATABASE . "` WHERE ".ID_FIELD."='$CookieID'");

    if ($HashSumByID->num_rows == 0) {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }
    $CryptedHashSum = mysqli_fetch_array($HashSumByID)[0];

    if ($CryptedHashSum == null) {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }

    if (!hash_equals($CryptedHashSum, crypt($CookieHash, $CryptedHashSum))) {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }
    mysqli_close($AdminsRecordsDatabase);
    return true;
}

function ExitById($id)
{
    $AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    $res = mysqli_query($AdminsRecordsDatabase, "UPDATE `" . ADMINS_RECORDS_DATABASE . "` SET `" . HASH_FIELD_NAME . "`=NULL WHERE " . ID_FIELD . "='$id'");
    mysqli_close($AdminsRecordsDatabase);
    setcookie(ID_FIELD, '');
    setcookie(HASH_FIELD_NAME, '');
    return $res;
}

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

function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
        foreach($objs as $obj) {
            is_dir($obj) ? removeDirectory($obj) : unlink($obj);
        }
    }
    return rmdir($dir);
}

function AddAdmin($Login, $Password)
{
    $AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATABASE_NAME);
    $WritedPassword = crypt($Password,SALT_STRING);
    //echo "INSERT INTO `admins_records`(`admin_login`, `admin_password`) VALUES ('$Login','$WritedPassword')<br>";
    mysqli_query($AdminsRecordsDatabase,"INSERT INTO `admins_records`(`admin_login`, `admin_password`) VALUES ('$Login','$WritedPassword')");
    mysqli_close($AdminsRecordsDatabase);
}