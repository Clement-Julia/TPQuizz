var id = 1;
var slideGouD = 1;
const btnValidates = document.querySelectorAll(".btn-validate");
const premiereCarteVisible = document.getElementById(id);
premiereCarteVisible.style.visibility = "visible";


for (var i = 0; i < btnValidates.length; i++){

    var btnValidate = btnValidates[i];

    btnValidate.addEventListener('click', () => {

        var card = document.getElementById(id);
        console.log(id);
        var inputChecked = Number(card.querySelector('input[name=question-' + id + ']:checked').value);
        if(inputChecked != undefined){
            if(slideGouD % 2 != 0){
                card.classList.add("slide-left");
            } else if(slideGouD % 2 == 0 && slideGouD != 10) {
                card.classList.add("slide-right");
            }
            slideGouD++;
            id++;
        }
        CompteARebour(1, id);
        card = document.getElementById(id);
        card.style.visibility = "visible";
    });
}



function CompteARebour (endtime, id) {

    document.getElementById("timer-" + id).innerHTML = endtime;
    var timeinterval = setInterval( function() {
        endtime--;
        document.getElementById("timer-" + id).innerHTML = endtime;

        if ( endtime == 0 ) {
            
            clearInterval (timeinterval);

            var evt = document.createEvent("MouseEvents");
            evt.initMouseEvent("click", true, true, window,0, 0, 0, 0, 0, false, false, false, false, 0, null);
            document.getElementById("btn-" + id).dispatchEvent(evt);

        }
    }, 1000);
}