<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.03.2017
 * Time: 2:38
 */

include 'PHPModules/LoadingFromDatabase.php';
include 'PHPModules/MainFunctions.php';
include 'ForAdmin/WholeProjectConstants/ProjectPaths.php';

$AllNews = GetAllNews();
$FeedBackInfo = GetFeedBackInfo();

$HTML_File = file_get_contents("templates/MainTemplate.html");

$Title = 'Обратная связь';
$Other_Attributes = "<meta name = 'description' content='Обратная связь со священниками Осиповичского района' />";

$Stylesheets_Addings = '<link rel="stylesheet" href="css/feedback.css">';

$JS_Modules_Addings = '<script type="text/javascript" src="js/feedback.js"></script>';

$JS_OnLoad_Addings = "";

$Left_Content = FormShortNewsList($AllNews);

if(isset($_POST['Reciever']))
{
    $Result = SendMessageById($FeedBackInfo,$_POST['Reciever'],$_POST['SenderName'],'Письмо с сайта Осиповичского благочиния',$_POST['Message'],$_POST['SenderAddress']);
    if($Result==true)
        $Main_Content = FormSmallHeaderByStr("Письмо отправлено.");
    else
        $Main_Content = FormSmallHeaderByStr("ОШИБКА! ПИСЬМО НЕ ОТПРАВЛЕНО!") . '<p style="text-align:center;">(Выберите того, кому хотите написать, и заполните сообщение снизу страницы)</p>' . FormFeedbackRecords($FeedBackInfo);
}
else
    $Main_Content = FormSmallHeaderByStr("Обратная связь") . '<p style="text-align:center;">(Выберите того, кому хотите написать, и заполните сообщение снизу страницы)</p>' . FormFeedbackRecords($FeedBackInfo);

$HTML_File = str_replace("{Title}", $Title, $HTML_File);
$HTML_File = str_replace("{Other_Attributes}", $Other_Attributes, $HTML_File);
$HTML_File = str_replace("{Stylesheets_Addings}", $Stylesheets_Addings, $HTML_File);
$HTML_File = str_replace("{JS_Modules_Addings}", $JS_Modules_Addings, $HTML_File);
$HTML_File = str_replace("{JS_OnLoad_Addings}", $JS_OnLoad_Addings, $HTML_File);

$HTML_File = str_replace("{Left_Content}", $Left_Content, $HTML_File);
$HTML_File = str_replace("{MainContent}", $Main_Content, $HTML_File);


echo $HTML_File;

function SendMessageById(&$AllRecievers, $id, $Name, $Subject, $Text, $Answer)
{
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: blagoosip <blagoosip.ru>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    foreach ($AllRecievers as $CurrReciever)
        if ($CurrReciever['id'] == $id) {
            $FinalMessage = file_get_contents('templates/MailMessageTemplate.html');
            $FinalMessage = str_replace('{Name}', $Name, $FinalMessage);
            $FinalMessage = str_replace('{Text}', $Text, $FinalMessage);
			$FinalMessage = str_replace('{Answer}', $Answer, $FinalMessage);
			

            return mail($CurrReciever['email'], $Subject, $FinalMessage,$headers);
        }
    return false;
}