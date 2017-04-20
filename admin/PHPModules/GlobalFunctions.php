<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 1:18
 */
function CheckSecurity()
{
    include('Constants.php');
    $AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);
    if ($AdminsRecordsDatabase == false) return false;

    $CookieID = $_COOKIE[$id_field];
    $CookieHash = $_COOKIE[$hash_field_name];

    if ($CookieID == false)
    {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }

    $HashSumByID = mysqli_query($AdminsRecordsDatabase, "SELECT $hash_field_name FROM `$admins_records_database` WHERE $id_field='$CookieID'");

    if ($HashSumByID->num_rows == 0)
    {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }
    if (mysqli_fetch_array($HashSumByID)[0] != $CookieHash)
    {
        mysqli_close($AdminsRecordsDatabase);
        return false;
    }
    mysqli_close($AdminsRecordsDatabase);
    return true;
}

function ExitById($id)
{
    include('Constants.php');
    $AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);
    $res = mysqli_query($AdminsRecordsDatabase, "UPDATE `admins_records` SET `$hash_field_name`=NULL WHERE $id_field='$id'");
    mysqli_close($AdminsRecordsDatabase);
    setcookie($id_field,'');
    setcookie($hash_field_name,'');
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