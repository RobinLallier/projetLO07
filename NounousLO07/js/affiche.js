function affiche(nomClasse) {



    let div = document.getElementById(nomClasse);

    let activeDiv = document.getElementsByClassName("visible");
    let i = 0;
    while (activeDiv.length > i){
        activeDiv[i].setAttribute("class", "hidden");
        i++;
    }

    div.setAttribute("class", "visible");
}
