/**
 * Created by user on 30.04.2017.
 */
function FormGraphicByIdArrAndHeight(IDToPlace,IDToPaintDialY,IDToPaintDialX, InputArray, MaxHeight) {
    console.log(InputArray);

    var Doc1 = document.getElementById(IDToPlace);
    var MaxValue = 0;
    for (var i = 0; i < InputArray.length; i++)
        if (InputArray[i] > MaxValue) MaxValue = InputArray[i];

    var CurrWidth = (Doc1.clientWidth - 2*InputArray.length)/InputArray.length;
    var CurrNode;
    for (i = 0; i < InputArray.length; i++) {
        CurrNode = document.createElement('div');
        CurrNode.className = "ColumnBlock";
        CurrNode.style.height = MaxHeight * InputArray[i] / MaxValue;
        CurrNode.style.width = CurrWidth;
        Doc1.appendChild(CurrNode)
    }

    Doc1 = document.getElementById(IDToPaintDialY);
    Doc1.style.height = MaxHeight;

    var AmountOfLinesY = 10;
    for(i=0;i<AmountOfLinesY;i++)
    {
        CurrNode = document.createElement('div');
        CurrNode.innerText = Math.round(MaxValue*i*1000/AmountOfLinesY);
        CurrNode.style.position = 'absolute';
        CurrNode.style.bottom = MaxHeight*i/AmountOfLinesY;
        Doc1.appendChild(CurrNode);
    }

    var Doc2 = document.getElementById(IDToPaintDialX);
    Doc2.style.height = "10px";

    var AmountOfLinesX = 10;
    for(i=0;i<AmountOfLinesX;i++)
    {
        CurrNode = document.createElement('div');
        CurrNode.innerText = Math.round(InputArray.length*i/AmountOfLinesX);
        CurrNode.style.position = 'absolute';
        CurrNode.style.left = MaxHeight*i/AmountOfLinesX + Doc1.clientWidth;
        Doc2.appendChild(CurrNode);
    }
}