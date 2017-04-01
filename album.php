<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Везде-->
    <meta name="viewport" content="width=device-width; initial-scale=1">
    <link rel="stylesheet" href="../../css/MainPageStyle.css">
    <link rel="stylesheet" href="../../css/News.css">

    <script type="text/javascript" src="../../js/Constants.js"></script>
    <script type="text/javascript" src="../../js/MainTemplates.js"></script>
    <script type="text/javascript" src="../../js/MainFunctions.js"></script>
    <script type="text/javascript" src="../../js/global_data.js"></script>
    <!--Везде-->

    <link rel="stylesheet" href="../../css/CustomObjectStyle.css">
    <link rel="stylesheet" href="../../css/lightbox.min.css">
    <link rel="stylesheet" href="../../css/GalleryType.css">

    <script type="text/javascript" src="../local_data.js"></script>
    <script type="text/javascript" src="../../js/WorkWithImages.js"></script>
    <script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../../js/lightbox.js"></script>


    <script>
        function ready() {

            var AlbumNum = 1;
            FormPage(MainPageTemplate, FormPreNewsString(News),document.body.innerHTML);

            var Doc = document.getElementById('MainContentID');
            LoadImageSectionTitle(Albums[Albums.length - AlbumNum].AlbumTitle,Doc);

            Doc = document.getElementsByClassName('ImagesSection');
            LoadImagesByList(Albums[Albums.length - AlbumNum].Photos, Doc[0], 'ImgInGallery');

            LoadLightBox();
            CheckGalleryForMobile(Doc[0]);
        }
        document.addEventListener('DOMContentLoaded',ready);

    </script>


</head>
<body>


</body>
</html>