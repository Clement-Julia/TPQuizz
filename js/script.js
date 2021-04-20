var inputError = document.getElementById("inputError");
if(inputError != null){
    inputError.addEventListener("click", function() {
        document.getElementById("labelError").innerHTML = "Réécrivez votre email";
    });
}

function addClass(){
    document.getElementById("recherche").classList.add("notval");
}

setInterval(function(){if(document.getElementById("recherche").value == ""){
    document.getElementById("recherche").classList.remove("notval");
}}, 3000);