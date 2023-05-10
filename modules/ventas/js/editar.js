'use strict';

function editar() {
    var nom = document.getElementById("nom").value;
    var des = document.getElementById("des").value;
    var pre = document.getElementById("pre").value;
    var id =  document.getElementById('id').value;
    // alert("id: "+id +", Nom: " + nom + ", des: " + des + ", pre: " + pre);

    var articulo = {
        nom,
        des,
        pre,
        id
    };

    $.ajax({
        type: "POST",
        url: "../controller/?op=editar",
        data: {
            articulo: JSON.stringify(articulo)
        },
    }).done(function (result) {
        if (result != 1) {
            alert(result);
        } else if (result == 1) {
            alert('El préstamo fue actualizado correctamente');
            location.href = "./";
        }
    }).fail(function (error) {
        console.table(error)
        alert("Error Petición POST: " + error);
    });
}
