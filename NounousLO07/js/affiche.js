function affiche(nomId) {



    let div = document.getElementById(nomId);

    let activeDiv = document.getElementsByClassName("visible");
    let i = 0;
    while (activeDiv.length > i){
        activeDiv[i].setAttribute("class", "hidden");
        i++;
    }

    div.setAttribute("class", "visible");
}
