


function enfant(){
    let nombreEnfant = document.getElementById('select-enfant').value;
    document.getElementById('enfants').innerHTML = "";
    for (let i = 0; i < nombreEnfant; i++) {

        document.getElementById('enfants').innerHTML +=
            '<legend>Enfant ' + (i+1) +'</legend>' +
            '<label >Prénom de l\'Enfant</label>' +
            '<input type="text" name="enfant[]" class="form-control">' +
            '<label>Date de naissance</label>' +
            '<input type="date" name="date_naissance[]" class="form-control">' +
            '<label>Restrictions alimentaires</label>' +
            '<input type="text" name="restrictions_alim[]" class="form-control"><br>' ;


    }

}