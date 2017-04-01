function LoadImagesByList(List, Place, TheirClass) {


    for (var i = 0; i < List.length; i++) {
        Place.innerHTML += '<' +
            'a class="example-image-link" href="' + FolderWithLocalImages + '/' + List[i].Big + '" data-lightbox="example-' + List[i].class + '" data-title="' + List[i].title + '">\
            <img class="example-image ' + TheirClass + '" src="' + FolderWithLocalImages + '/' + List[i].Small + '"  alt=""/>\
            </a>';
    }

}

function LoadGalleryPreInfo(GalleryArray, Doc) {

    //Doc.innerHTML = '';
    var temp = '';
    for (var i = 0; i < GalleryArray.length; i++) {

        Doc.innerHTML += '\
        <a class = "GalleryBlock" href = "' + GalleryArray[i].AlbumFolder + '/' + GalleryArray[i].AlbumPageName + '">\
            <div class = "GalleryPreImageBlock">\
                <img class = "GalleryImg" src="' + GalleryArray[i].AlbumFolder + '/' + FolderWithLocalImages + '/' + GalleryArray[i].AlbumPrePhoto + '">\
            </div>\
            <p class = "GalleryText">' + GalleryArray[i].AlbumTitle + '</p> \
            </a>';
    }
}

function LoadImageSectionTitle(Title, Doc) {
    Doc.innerHTML += '<h3 class="APieceOfNewsTitle" align="center">' + Title + '</h3>'+
        '<div class="ImagesSection">' +
        '</div>';

}

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