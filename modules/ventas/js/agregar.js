'use strict';

function agregar() {
    var nom = document.getElementById("nom").value;
    var des = document.getElementById("des").value;
    var pre = document.getElementById("pre").value;
    var idu = sessionStorage.getItem('idu');
    // alert("Nom: " + nom + ", des: " + des + ", pre: " + pre + ", idu: " + idu);

    // if (nom.length && des.length && pre.length) {
    //     alert("El precio del artículo está vacío");
    // } else {
    var articulo = {
        nom,
        des,
        pre,
        idu
    };

    $.ajax({
        type: "POST",
        url: "../controller/?op=agregar",
        data: {
            valores: JSON.stringify(articulo.nom)
        },
    }).done(function (result) {
        if (result != 1) {
            alert(result);
        } else if (result == 1) {
            alert('El articulo fue creado correctamente');
            location.href = "./";
        }
    }).fail(function (error) {
        alert("Error Petición POST: " + error);
    });
}