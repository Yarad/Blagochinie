<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */
include_once '../WholeProjectConstants/ProjectPaths.php';
include_once 'PHPModules/LoadingFromDatabase.php';
include 'PHPModules/MainFunctions.php';
include_once 'PHPModules/Constants.php';

if(count($_GET) == 0) {
    $CurrID = "svyatovved";
}
else
{
    $CurrID = $_GET['ID'];
}

$AllNews = GetAllNews();
$HTML_File = file_get_contents("templates/MainTemplate.html");

$Title = $AllChurches[$CurrID]["Title"]  . ' Расписание.' ;
$Other_Attributes = '<meta name="description" content="Расписание ' . $AllChurches[$CurrID]['Title'] . '"/>';
$Stylesheets_Addings = '';
$JS_Modules_Addings = '';

$JS_OnLoad_Addings = "";

$Left_Content = FormShortNewsList($AllNews);
$Main_Content = FormSmallHeaderByStr($AllChurches[$CurrID]["Title"]);

if (file_exists(CHURCHES_TIMETABLE_FOLDER . '/' . $AllChurches[$CurrID]['ID'] . '/' . $AllChurches[$CurrID]['ID'] . '.html') == true)
    $Main_Content .= FillPageByTemplate(CHURCHES_TIMETABLE_FOLDER . '/' . $AllChurches[$CurrID]['ID'],$AllChurches[$CurrID]['ID'] . '.html', file_get_contents('templates/NewsImageTemplate.html'));
else
    $Main_Content .= file_get_contents("templates/NoTimetableTemplate.html");

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;



/*
    <script>
        function ready() {
            Doc = Doc.getElementsByClassName('ImagesSection');
            LoadChurhesPreInfo(ChurchesList,Doc[0],AssignTimetable);
        }
        document.addEventListener('DOMContentLoaded',ready);
    </script>

</head>
<body>

</body>
</html>
*/