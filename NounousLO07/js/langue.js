function langue() {
    let nombreLangue = document.getElementById('select-langue').value;
    document.getElementById('langue').innerHTML = "";
    for (let i = 0; i < nombreLangue; i++) {

        document.getElementById('langue').innerHTML +=
            "<div class='my-4'>" +
                '<legend>Choisissez votre Langue n°' + (i + 1) + '</legend>' +
                "<select name='langue[]' class='form-control my-4'>" +
                    "<option value='anglais'>Anglais</option>" +
                    "<option value='espagnol'>Espagnol</option>" +
                    "<option value='portugais'>Portugais</option>" +
                    "<option value='allemand'>Allemand</option>" +
                    "<option value='italien'>Italien</option>" +
                    "<option value='chinois'>Chinois</option>" +
                    "<option value='japonais'>Japonais</option>" +
                    "<option value='arabe'>Arabe</option>" +
                "</select>"
            "</div>";
    }

}