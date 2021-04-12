var href = document.location.href;
var url = new URL(href);
var numeroQuizz = url.searchParams.get("quizz");
var id = 0;
var slideGouD = 1;
const btnValidates = document.querySelectorAll(".btn-validate");
const premiereCarteVisible = document.getElementById(id);
premiereCarteVisible.style.visibility = "visible";
fetchStart(numeroQuizz);


for (var i = 0; i < btnValidates.length; i++){

    var btnValidate = btnValidates[i];

    btnValidate.addEventListener('click', () => {

        if(document.getElementById("0").style.display = "block"){
            document.getElementById("0").style.display = "none";
        }

        if(id != 0){

            var card = document.getElementById(id);
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

        } else {

            id++;

        }
        
        CompteARebour(20, id);
        fetchCard(id);
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
        // on clear le compteur dans le cas où l'utilisateur clique manuellement sur le bouton
        document.getElementById("btn-" + id).onclick = function(){
            clearInterval (timeinterval);
        }

    }, 1000);
}

async function fetchCard(id){

    var response = await fetch("../traitements/quizz.card.fetch.php?quizz=" + numeroQuizz + "&card=" + (id - 1));
    var card = await response.json();
    var reponsesQuizz = card["reponses"];

    document.getElementById('titre-' + id).innerHTML = card["titre"];
    document.getElementById('question-' + id).innerHTML = "Question : " + id + "<br>" + card["description"];
    document.getElementById("id-question-" + id).value = card["idQuestion"];
    console.log("id-question-" + id);
    var i = 1;
    for (const [key, value] of Object.entries(reponsesQuizz)) {
        console.log(key);
        console.log(value);
        document.getElementById("reponse-" + i + "-" + id).innerHTML = value;
        document.getElementById("question-" + i + "-" + id).value = key;
        i++;
    }

}

async function fetchStart(numeroQuizz){
    var response = await fetch("../traitements/quizz.start.card.fetch.php?quizz=" + numeroQuizz);
    var cardStart = await response.json();
    var designeds = document.querySelectorAll(".designed-by");

    document.getElementById("start-header").innerHTML = "Catégorie : " + cardStart[0]["libelle"] + "<br>Quizz : " + cardStart[0]["titre"];
    
    designeds.forEach(function(designed){
        designed.innerHTML = "Designed By " + cardStart[0]["pseudo"];
    })
    
};
