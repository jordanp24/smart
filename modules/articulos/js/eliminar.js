'use strict';

function eliminar() {

    var id = document.getElementById("id").value;
    // alert("Nom: "+nom+", ape: "+ape+", Nit: "+nit+", Cel: "+cel+", Dir: "+dir+", Em: "+em);

    if (!id.length) {
        alert("El articulos no existe");
    } else {
        var articulo = {
            id
        };

        $.ajax({
            type: "POST",
            url: "../controller/?op=eliminar",
            data: {
                valores: JSON.stringify(articulo)
            },
        }).done(function(result) {
            if (result == 1) {
                alert('El articulos fue eliminado correctamente');
                location.href = "./";
            } else if (result == 0) {
                alert('El articulos ya habia sido eliminado anteriormente');
                location.href = "./";
            } else if (result != 1 || result != 0) {
                alert(result);
            }
        }).fail(function(error) {
            alert("Error Petición POST: " + error);
        });
    }
}