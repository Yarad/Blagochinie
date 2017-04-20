function SaveChanges() {
    var CreatedHtml = CKEDITOR.instances.editor1.getData();
    var MainForm = document.getElementById('MainForm');
    MainForm.innerHTML += '<textarea name="fPreparedHtmlContent" style = "display:none">' + CreatedHtml + '</textarea>';
    MainForm.submit();
}

var CurrPhotoSet = 0;

function AddSetOfPhotos() {
    doc = document.getElementById('FormOfAddedPhotos');
    var NewSetElement = document.createElement('div');
    NewSetElement.className = "PhotosSetDescription";
    NewSetElement.id = "PhotosSetDescription" + CurrPhotoSet;

    NewSetElement.innerHTML = '' +
        '<input type="text" name="fSetsOfPhotosNames[' + CurrPhotoSet + ']" value="Имя группы фотографий" form="MainForm"/>' +
        '<button class="DeleteCurrSetButton" onclick="DeleteCurrSet('+ CurrPhotoSet +')"></button>'    +
    '<br><input class="LoadFilesButtons" type="file" min="0" max="20" name="SetsOfPhotos_'+CurrPhotoSet+'[]" multiple="true" form="MainForm">';
    doc.appendChild(NewSetElement);
    CurrPhotoSet++;
}

function DeleteCurrSet(num) {
    doc = document.getElementById('FormOfAddedPhotos');
    doc.removeChild(document.getElementById("PhotosSetDescription" + num));
}