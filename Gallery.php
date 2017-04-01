<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1">
    <!--Везде-->
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
    <script type="text/javascript" src="../js/WorkWithImages.js"></script>



    <script>
        function ready() {
            FormPage(MainPageTemplate,FormPreNewsString(News));

            var Doc = document.getElementById('MainContentID');
            LoadImageSectionTitle(GALLERY_TITLE,Doc);

            Doc = Doc.getElementsByClassName('ImagesSection');
            LoadGalleryPreInfo(Albums,Doc[0]);
        }
        document.addEventListener('DOMContentLoaded',ready);
    </script>

</head>
<body>

</body>
</html>