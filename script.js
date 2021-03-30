const titre = document.querySelector("h1");
titre.addEventListener('mouseover', function () {
    titre.style.color = "black";
})
titre.addEventListener('mouseleave', function () {
    titre.style.color = "blue";
})