<?php
include "ForAdmin/WholeProjectConstants/DatabaseConnection.php";
function GetAllNews()
{
    $DatabaseConnect = mysqli_connect(HOST,USER,PASSWORD,DATABASE_NAME);
    $AllNews_DB = mysqli_query($DatabaseConnect,"SELECT * FROM `" . NEWS_DATABASE ."` ORDER BY `".NEWS_DATABASE."`.`" . ID_FIELD . "` DESC");

    $AllNews = [];
    while ($row = mysqli_fetch_assoc($AllNews_DB)) {
        $AllNews[$row[ID_FIELD]] = $row;
        $AllNews[$row[ID_FIELD]][DATE_FIELD] = ConvertDate($AllNews[$row[ID_FIELD]][DATE_FIELD]);
    }
    mysqli_close($DatabaseConnect);
    return $AllNews;
}

function GetAllChurches()
{
    $DatabaseConnect = mysqli_connect(HOST,USER,PASSWORD,DATABASE_NAME);
    $AllChurches_DB = mysqli_query($DatabaseConnect,"SELECT * FROM `" . CHURCHES_TABLE ."` ORDER BY `".CHURCHES_TABLE."`.`" . ID_FIELD . "` DESC");

    $AllChurches = [];
    while ($row = mysqli_fetch_assoc($AllChurches_DB)) {
        $AllChurches[$row[ID_FIELD]] = $row;
    }
    mysqli_close($DatabaseConnect);
    return $AllChurches;
}

function GetAllAlbums()
{
    //не стал менять churches на albums
    $DatabaseConnect = mysqli_connect(HOST,USER,PASSWORD,DATABASE_NAME);
    $AllChurches_DB = mysqli_query($DatabaseConnect,"SELECT * FROM `" . ALBUMS_TABLE ."` ORDER BY `".ALBUMS_TABLE."`.`" . ID_FIELD . "` DESC");

    $AllChurches = [];
    while ($row = mysqli_fetch_assoc($AllChurches_DB)) {
        $AllChurches[$row[ID_FIELD]] = $row;
    }
    mysqli_close($DatabaseConnect);
    return $AllChurches;
}

function ConvertDate($Date)
{
    $temp = explode('-',$Date);
    return $temp[2].'.'.$temp[1].'.'.$temp[0];
}

function GetFeedBackInfo()
{
    $DatabaseConnect = mysqli_connect(HOST,USER,PASSWORD,DATABASE_NAME);
    $AllRecords_DB = mysqli_query($DatabaseConnect,"SELECT * FROM `" . FEEDBACK_DATABASE ."` ORDER BY `".FEEDBACK_DATABASE."`.`" . ID_FIELD . "` DESC");

    $AllRecords = [];
    while ($row = mysqli_fetch_assoc($AllRecords_DB)) {
        $AllRecords[$row[ID_FIELD]] = $row;
    }
    mysqli_close($DatabaseConnect);
    return $AllRecords;
}