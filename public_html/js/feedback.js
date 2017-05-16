/**
 * Created by user on 15.05.2017.
 */
function ChooseReciever(id)
{
    var AllRecievers = document.getElementsByClassName('FeedbackImage');
    for (var i=0;i<AllRecievers.length;i++)
        AllRecievers[i].classList.remove("FeedbackImage_choosed");
    var doc = document.getElementById(id);
    doc.classList.add("FeedbackImage_choosed");

    doc = document.getElementById('Reciever');
    doc.innerHTML = id;
}