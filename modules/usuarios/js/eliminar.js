'use strict';

$(document).ready(function () {
    $('#enviar').click(function () {

        var id = document.getElementById("id").value;
        // alert("Nom: "+nom+", ape: "+ape+", Nit: "+nit+", Cel: "+cel+", Dir: "+dir+", Em: "+em);

        if (!id.length) {
            alert("El cliente no existe");
        } else {
            var usuario = {
                id
            };

            $.ajax({
                type: "POST",
                url: "../controller/?op=5",
                data: {
                    valores: JSON.stringify(usuario)
                },
            }).done(function (result) {
                if(result == 1) {
                    alert('El usuario fue eliminado correctamente');
                    location.href = "./";
                }else if(result == 0) {
                    alert('El usuario ya habia sido eliminado anteriormente');
                    location.href = "./";
                }else  if (result != 1 || result != 0) {
                    alert(result);
                }
            }).fail(function (error) {
                alert("Error Petición POST: " + error);
            });
        }
    });
});