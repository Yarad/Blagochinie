<?php
/*$AllNews = array(
    array
    (
        "Date" => "07.01.2017",
        "Name" => "РОЖДЕСТВЕНСКИЙ УТРЕННИК В СВЯТО-ВВЕДЕНском храме",
        "Annotation" => "Ну какой ещё зимний праздник русская душа принимает ближе к сердцу, чем Рождество Христово? Когда как не в эти дни сердце наполняется тихой радостью ... особенно в сочельник, когда ты с трепетом ждёшь первой звезды.",
    ),
    array
    (
        "Date" => "07.01.2017",
        "Name" => "ПОСЕЩЕНИЕ ДЕТСКОГО ДОМА В Д.ЯСЕНЬ НА РОЖДЕСТВО",
        "Annotation" => "Сегодня, в день Рождества Христова, иерей Василий (Белоус) посетил детский дом в д.Ясень, чтобы разделить радость праздника с малышами.",
    ),
    array
    (
        "Date" => "28.01.2017",
        "Name" => "ОБЛАСТНАЯ ЗИМНЯЯ СПАРТАКИАДА ПРОШЛА В ОСИПОВИЧАХ",
        "Annotation" => "Около 800 человек в составе 28 команд приняли участие в IХ областной зимней спартакиаде, которая проходила в Осиповичах в прошлые выходные. Гости нашего города посетили и Святовведенский храм",
    ),
    array(
        "Date" => "03.02.2017",
        "Name" => "ВСТРЕЧА ПРОШЛОГО С НАСТОЯЩИМ ",
        "Annotation" => "В Осиповичском краеведческом музее прошла презентация книги поэта Станислава Лушкевича, посвященная истории храмов Осиповичского района",
    ),
    array
    (
        "Date" => "16.04.2017",
        "Name" => "<font color=\"red\">Пасха 2017. Свято-Введенский храм. Фотоотчет.</font>",
        "Annotation" => "Год! Целый год мы ждали этого православного Дня Победы.Весь мир ликует от одной мысли: <font color=\"red\">ХРИСТОС ВОСКРЕС!</font>",
    )
);*/
include "../WholeProjectConstants/DatabaseConnection.php";

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

function ConvertDate($Date)
{
    $temp = explode('-',$Date);
    return $temp[2].'.'.$temp[1].'.'.$temp[0];
}

//договоренность: *.html называется так же, как и папка
$AllChurches = array(
    "svyatovved" =>
        array(
            "Title" => "Свято-Введенский храм.",
            "ID" => "svyatovved",
            "SmallImageName" => "svyatovved.jpg"
        ),
    "krestovozdvig" =>
        array(
            "Title" => "Кресто-Воздвиженский храм.",
            "ID" => "krestovozdvig",
            "SmallImageName" => "krestovozdvig.jpg"
        )
);

$AllAlbums = array(
    "1_MainAlbum" =>
        array(
            "Title" => "Разное",
            "ID" => "1_MainAlbum",
            "SmallImageName" => "1_MainAlbum.jpg"
        ),
    "2_2015_YablochniySpas" =>
        array(
            "Title" => "Яблочный Спас 2015. Осиповичи, Татарка, Ясень",
            "ID" => "2_2015_YablochniySpas",
            "SmallImageName" => "2_2015_YablochniySpas.jpg"
        ),
    "3_2016_maslenitsa" =>
        array(
            "Title" => "Масленица 2016",
            "ID" => "3_2016_maslenitsa",
            "SmallImageName" => "3_2016_maslenitsa.jpg"
        ),
    "4_2016_Vvedenie" =>
        array(
            "Title" => "Введение 2016",
            "ID" => "4_2016_Vvedenie",
            "SmallImageName" => "4_2016_Vvedenie.jpg"
        ),
    "5_2017_Pasha" =>
        array(
            "Title" => "Пасха 2017. Свято-введенский храм",
            "ID" => "5_2017_Pasha",
            "SmallImageName" => "5_2017_Pasha.jpg"
        ),
);