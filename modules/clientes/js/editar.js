'use strict';

$(document).ready(function () {
    $('#enviar').click(function () {

        var nom = document.getElementById("nom").value;
        var ape = document.getElementById("ape").value;
        var nit = document.getElementById("nit").value;
        var dir = document.getElementById("dir").value;
        var cel = document.getElementById("cel").value;
        var em = document.getElementById("em").value;
        var id = document.getElementById("id").value;
        // alert("Nom: "+nom+", ape: "+ape+", Nit: "+nit+", Cel: "+cel+", Dir: "+dir+", Em: "+em);

        if (!nom.length) {
            alert("El nombre está vacío");
        } else if (!ape.length) {
            alert("El apellido está vacío");
        } else if (!dir.length) {
            alert("La dirección está vacía");
        } else {
            var cliente = {
                nom,
                ape,
                nit,
                dir,
                cel,
                em,
                id
            };

            $.ajax({
                type: "POST",
                url: "../controller/?op=2",
                data: {
                    valores: JSON.stringify(cliente)
                },
            }).done(function (result) {
                if (result != 1) {
                    alert(result);
                } else if (result == 1) {
                    alert('El cliente fue actualizado correctamente');
                    location.href = "verClientes.php";
                }
            }).fail(function (error) {
                alert("Error Petición POST: " + error);
            });
        }
    });
});