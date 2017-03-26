/**
 * Created by user on 06.02.2017.
 */
function LoadChurhesPreInfo(DataObject, Doc,Assignment) {

    Doc.innerHTML = '';
    var temp = '';
    for (var i = 0; i < DataObject.length; i++) {

        if(Assignment == AssignInfo)
            temp = DataObject[i].PageWithInfoName;
        if (Assignment == AssignTimetable )
            temp = DataObject[i].PageWithTimetable;

        Doc.innerHTML += '\
        <a class = "GalleryBlock" href = "' + FolderWithChurchPages + '/' + DataObject[i].ChurchFolderName + '/' + temp + '">\
            <img class = "GalleryImg" src="' + ChurchesPrePhotoFolder + '/' + DataObject[i].ImgName + '">\
            <p class = "GalleryText">' + DataObject[i].Name + '</p> \
            </a>';
    }
}

