var MainPageTemplate = '\
<div class="header">\
    <div class="Icon left">\
    <div id="CrossDiv"></div>\
    </div>\
    <div class="Menu right">\
    <a id = "OpenMenu" class="MenuButton" href="javascript:void(0); ">Меню</a>\
    <ul id = MenuSet>\
    \
    <a class="MenuButton" href="'+FROM_ROOT+'index.html">Главная</a>\
    <a class="MenuButton" href="'+FROM_ROOT+'churches/ChurchesInfo.html">Храмы</a>\
    <a class="MenuButton" href="'+FROM_ROOT+'churches/ChurchesTimetable.html">Расписания</a>\
    <a class="MenuButton" href="'+FROM_ROOT+'Gallery/Gallery.html">Фотоальбом</a>\
    </ul>\
    </div>\
    </div>\
    <!--Начинаем содержание-->\
        \
<div id="LeftContentID" class="ContentLeft ContentBlock left">\
    </div>\
        \
    <div class="Present ContentBlock right">\
    <div id="PresentImageDiv" class="left">\
    </div>\
    <p id = "PresentWords" class="right">\
    Московский патриархат<br>\
Белорусский экзархат<br>\
Бобруйская епархия<br>\
Осиповичское благочиние\
</p>\
</div>\
\
<div id="MainContentID" class="MainContent ContentBlock right">\
    </div>\
';