function CheckGalleryForMobile(Doc) {

    if (window.matchMedia('handheld, (max-width: 1200px)').matches) {
        var temp = Doc.scrollWidth;
        var H,x1,x2;
        var ImagesArray = Doc.getElementsByClassName('ImgInGallery');

        for (var i = 0; i < ImagesArray.length - 1; i += 2) {
            x1 = ImagesArray[i].height/ImagesArray[i].width;
            x2 = ImagesArray[i+1].height/ImagesArray[i+1].width;

            H = temp*x1*x2/(x1+x2)-10;

            console.log(temp)
            ImagesArray[i].style.height = ""+H+'px'+"";
            ImagesArray[i+1].style.height = ""+H+'px'+"";
        }
    }
}