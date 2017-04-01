<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Везде-->
    <meta name="viewport" content="width=device-width; initial-scale=1">

    <link rel="stylesheet" href="../css/MainPageStyle.css">
    <link rel="stylesheet" href="../css/News.css">

    <script type="text/javascript" src="../js/Constants.js"></script>
    <script type="text/javascript" src="../js/MainTemplates.js"></script>
    <script type="text/javascript" src="../js/MainFunctions.js"></script>
    <script type="text/javascript" src="../js/global_data.js"></script>
    <!--Везде-->

    <link rel="stylesheet" href="../css/CustomObjectStyle.css">
    <link rel="stylesheet" href="../css/GalleryType.css">

    <script type="text/javascript" src="local_data.js"></script>
    <script type="text/javascript" src="../js/ChurchesFunctions.js"></script>
    <script type="text/javascript" src="../js/WorkWithImages.js"></script>


    <script>
        function ready() {
            FormPage(MainPageTemplate,FormPreNewsString(News));
            Doc = document.getElementById('MainContentID');
            LoadImageSectionTitle(CHURCHES_TIMETABLE_TITLE,Doc);
            Doc = Doc.getElementsByClassName('ImagesSection');
            LoadChurhesPreInfo(ChurchesList,Doc[0],AssignTimetable);
        }
        document.addEventListener('DOMContentLoaded',ready);
    </script>

</head>
<body>

</body>
</html>