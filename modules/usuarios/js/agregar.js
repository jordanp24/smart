'use strict';

$(document).ready(function () {
    $('#enviar').click(function () {
        var nom = document.getElementById("nom").value;
        var ape = document.getElementById("ape").value;
        var usu = document.getElementById("usu").value;
        var con = document.getElementById("con").value;
        var rol = document.getElementById("rol").value;
        // var em = document.getElementById("em").value;
        // alert("Nom: "+nom+", ape: "+ape+", Usu: "+usu+", Con: "+con+", Rol: "+rol);

        if (!nom.length) {
            alert("El nombre está vacío");
        } else if (!ape.length) {
            alert("El apellido está vacío");
        } else if (!usu.length) {
            alert("El nombre de usuario está vacío");
        } else if (!con.length) {
            alert("Se debe definir una contraseña");
        } else if (!rol.length) {
            alert("No ha indicado el rol que tendrá el usuario.");
        } else {
            var usuario = {
                nom,
                ape,
                usu,
                con,
                rol
            };

            $.ajax({
                type: "POST",
                url: "../controller/?op=2",
                data: {
                    valores: JSON.stringify(usuario)
                },
            }).done(function (result) {
                if (result != 1) {
                    alert(result);
                } else if (result == 1) {
                    alert('El usuario fue creado correctamente');
                    location.href = "./";
                }
            }).fail(function (error) {
                alert("Error Petición POST: " + error);
            });
        }
    });
});