var inputError = document.getElementById("inputError");
if(inputError != null){
    inputError.addEventListener("click", function() {
        document.getElementById("labelError").innerHTML = "Réécrivez votre email";
    });
}

function addClass(){
    document.getElementById("recherche").classList.add("notval");
}

var recherche = document.getElementById("recherche");
if(recherche != null){
    setInterval(function(){if(recherche.value == ""){
        recherche.classList.remove("notval");
    }}, 3000);
}

