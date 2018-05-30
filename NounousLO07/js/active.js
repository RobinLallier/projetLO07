
    let tabButton = document.getElementsByTagName("button");
    for (let i= 0; i > tabButton.length; i++){
        console.log("working");
        tabButton[i].addEventListener("click", function(){
            for(let j = 0; j>tabButton.length; j++){
                if( i !== j) {
                    console.log("pas repéré");
                    tabButton[j].setAttribute("class", "btn btn-outline-info");
                }
                else{
                    console.log("repéré");
                    tabButton[j].setAttribute("class", "btn btn-info");
                }
            }
        });

    }

