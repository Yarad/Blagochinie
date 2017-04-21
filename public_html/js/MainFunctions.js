/*
 function FormPage() {
 var Doc;
 var icon=FROM_ROOT+'images/'+'favicon.ico';
 var link = document.createElement('link');
 var head = document.getElementsByTagName('head')[0];

 link.setAttribute('href',icon);
 link.setAttribute('type','image/x-icon');
 link.setAttribute('rel','shortcut icon');
 head.appendChild(link);

 document.body.innerHTML = arguments[0]; //ejs.compile(MainPageTemplate)(data);
 PrepareForMobile(MobileOpenMenuButtonID);

 if (arguments.length >= 2) {
 Doc = document.getElementById('LeftContentID');
 Doc.innerHTML = arguments[1];
 }
 if (arguments.length >=3){
 Doc = document.getElementById('MainContentID');
 Doc.innerHTML = arguments[2];
 }

 if (arguments.length >=4){
 document.title = arguments[3];
 }
 else
 document.title = MAIN_TITLE;
 }
 */
function PrepareForMobile() {
    if (window.matchMedia("(max-width: 1200px)").matches) {
        document.addEventListener('click', OpenBody_click);
    }
}
function OpenBody_click() {
    var temp = event.target;
    var Doc = document.getElementById('MenuSet');

    if (temp.id == 'OpenMenu') {
        if (getComputedStyle(Doc).display == 'none') {
            Doc.style.display = 'block';
        }
        else {
            Doc.style.display = 'none';
        }

    }
    else {
        Doc.style.display = 'none';
    }
}

var CurrentPage = 1;
var AmountOfPages;
var Doc;
var NewsArray;

function LoadNews(InputNewsArray, IDToPlace) {
    Doc = document.getElementById(IDToPlace); //где будет менюшка
    console.log(InputNewsArray);
    NewsArray = InputNewsArray;
    AmountOfPages = Math.ceil(NewsArray.length / NewsPerPage); //кол-во страниц по кол-ву новостей
    DrawNews(Doc, NewsArray, (CurrentPage - 1) * NewsPerPage, CurrentPage * NewsPerPage);//отобразить новости текущей страницы

    var PageArr = CalculatePages(AmountOfPages, CurrentPage, MaxPageLinks); //возвращает массив тех значений, которые
    // будут отображаться в меню
    DrawPageLinks(Doc, PageArr); //отрисовывает меню для перехода по страницам
}

function DrawNews(Doc, NewsArray, First, Last) {
    //for (var i = First; (i < Last) && (i < NewsArray.length); i++) {
    console.log(NewsArray);
    //NewsArray.forEach(function(CurrNews, id, arr) {
    for (var CurrNews in NewsArray) {
        Doc.innerHTML +=
            '<a class="News" href = "news.php?Date=' + CurrNews["Date"] + '&' + 'Num=' + CurrNews["id"] + '">' +
            '<h3 class="APieceOfNewsTitle Caps">' + CurrNews["Date"] + ' ' + CurrNews["Name"] + '</h3>' +
            '<p class="APieceOfNewsText">' + CurrNews["Annotation"] + '</p>' +
            '</a>';

    }
}

function CalculatePages(AmountOfPages, CurrentPage, MaxPageLinks) {
    var ResArr = [];
    var LeftSide = false;
    var RightSide = false;
    var i, j;

    if (AmountOfPages == 1) return [];
    if (AmountOfPages <= MaxPageLinks) {
        for (i = 1; i <= AmountOfPages; i++)
            ResArr.push(i);
        return ResArr;
    }

    if (CurrentPage <= Math.ceil(MaxPageLinks / 2)) {
        LeftSide = true;
    }
    if (AmountOfPages - CurrentPage <= Math.floor(MaxPageLinks / 2)) {
        RightSide = true;
    }

    ResArr[0] = 1;
    ResArr[AmountOfPages - 1] = AmountOfPages;

    if (LeftSide) {
        for (i = 1; i <= AmountOfPages - 2; i++)
            ResArr[i - 1] = i;
        ResArr[AmountOfPages - 2] = Space;
    }
    else if (RightSide) {
        for (i = AmountOfPages - 1; i >= 2; i--)
            ResArr[i - 1] = i;
        ResArr[1] = Space;
    }
    else {
        ResArr[1] = Space;
        ResArr[AmountOfPages - 2] = Space;

        ResArr[Math.ceil(AmountOfPages / 2) - 1] = CurrentPage;
        for (i = Math.ceil(AmountOfPages / 2); i <= AmountOfPages - 3; i++)
            ResArr[i] = i + 1;
        for (i = Math.ceil(AmountOfPages / 2) - 2; i >= 2; i--)
            ResArr[i] = i + 1;
    }
    /*for (i = 1; (i <= Math.floor(MaxPageLinks / 2)) && (CurrentPage - i != 0); i++)
     ResArr.unshift(CurrentPage - i);
     var temp = ResArr.length;
     for (i = temp + 1, j = 1; (i <= MaxPageLinks) && (CurrentPage + j != AmountOfPages + 1); i++, j++)
     ResArr.push(CurrentPage + j);

     if (ResArr[ResArr.length - 1] != AmountOfPages) {
     ResArr.push(Space);
     ResArr.push(AmountOfPages);
     }


     if (ResArr[0] != 1) {
     ResArr.unshift(Space);
     ResArr.unshift(1);
     }
     */

    return ResArr;

}
function DrawPageLinks(Doc, PageArray) {
    var i;
    Doc.innerHTML = Doc.innerHTML + '<div class="PageLinksContainer"></div>';

    Doc = Doc.getElementsByClassName("PageLinksContainer");
    for (i = 0; i < PageArray.length; i++) {
        Doc[0].innerHTML += '<div class="PageLinks" id="' + PageArray[i] + '" onclick="TurnPage(' + PageArray[i] + ')"  >' + PageArray[i] + '</div>';
    }
}
function TurnPage(PageInput) {
    if (PageInput != Space) {
        CurrentPage = PageInput;
        Doc.innerHTML = '';
        DrawNews(Doc, NewsArray, (CurrentPage - 1) * NewsPerPage, CurrentPage * NewsPerPage);
        var PageArr = CalculatePages(AmountOfPages, CurrentPage, MaxPageLinks); //возвращает массив тех значений, которые
                                                                                // будут отображаться в меню
        DrawPageLinks(Doc, PageArr);
    }
}


//подлежит удалению
function FormTitleStringByNum(NewsArray, Num) {
    return NewsArray[NewsArray.length - Num].Data + ' ' + NewsArray[NewsArray.length - Num].Name;
}