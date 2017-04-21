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
    if (mysqli_fetch_array($HashSumByID)[0] != $CookieHash) {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }
    mysqli_close($AdminsRecordsDatabase);
    return true;
}

function ExitById($id)
{
    $AdminsRecordsDatabase = mysqli_connect(HOST, USER, PASSWORD, DATANASE_NAME);
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