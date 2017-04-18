<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2017
 * Time: 1:18
 */
include('PHPModules/GlobalFunctions.php');


function CheckSecurity()
{
    require('Constants.php');
    $AdminsRecordsDatabase = mysqli_connect($host, $user, $password, $database_name);
    $RecordByLoginAndPassword = mysqli_query($AdminsRecordsDatabase, "SELECT $hash_field_name FROM `$admins_records_database` WHERE $id_field='$Login'");

    return true;
}