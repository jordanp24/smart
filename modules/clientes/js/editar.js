'use strict';

$(document).ready(function () {
    $('#enviar').click(function () {

        var id = document.getElementById("idc").value;
        var nom = document.getElementById("nom").value;
        var ape = document.getElementById("ape").value;
        var ser = document.getElementById("nit").value;
        var tip = document.getElementById("dir").value;
        var mor = document.getElementById("cel").value;
       
        if (!nom.length) {
            alert("El nombre está vacío");
        } else if (!ape.length) {
            alert("El apellido está vacío");
        } else if (!dir.length) {
            alert("La dirección está vacía");
        } else {
            var cliente = {
                id,
                nom,
                ape,
                ser,
                tip,
                mor
            };

            $.ajax({
                type: "POST",
                url: "../controller/?op=2",
                data: {
                    cliente: JSON.stringify(cliente)
                },
            }).done(function (result) {
                if (result != 1) {
                    alert(result);
                } 
                // else if (result == 1) {
                //     alert('El cliente fue actualizado correctamente');
                //     // location.href = "verClientes.php";
                // }
            }).fail(function (error) {
                alert("Error Petición POST: " + error);
            });
        }
    });
});