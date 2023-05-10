<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = " SMART";
include '../../include/views/head.php';
?>

<script type="text/javascript">
    if (sessionStorage.getItem('firstname')) location.href = "../../home/views/";
</script>

<body class="blue darken-3 lighten-1 login">
    <link rel="stylesheet" href="../../../css/login.css?v=1.10">
    <div class="container marginNav">
        <div>
            <div class="row margin">
                <div class="col s12 m6 offset-m3 valign">
                    <div class="card hoverable z-depth-2 border-radius">
                        <div class="card-title indigo-text text-darken-3">
                            <div class="center-align titulo-3 negrita"><img class='responsive-img' width="70%" alt='SMART' src="../../../img/logo.png"> </div>
                        </div>
                        <form id="loginForm" onsubmit="logIn()">
                            <div class="card-content">
                                <div class="input-field">
                                    <i class="material-icons prefix blue-text text-darken-3">account_circle</i>
                                    <input id="name" type="text" class="validate" required>
                                    <label for="name" class="black-text">Usuario<span class="red-text">*</span></label>
                                </div>
                                <br>
                                <div class="input-field">
                                    <i class="material-icons prefix blue-text text-darken-3">lock</i>
                                    <input id="pass" type="password" class="validate" required>
                                    <label for="pass" class="black-text">Contraseña<span class="red-text">*</span></label>
                                </div>
                                <br>
                                <div class="input-field center-align">
                                    <div class="btn-group" role="group">
                                        <button type="submit" id="login" class="waves-effect waves-light btn-small blue darken-3 white-text">
                                            <i class="material-icons right">input</i>Iniciar sesión
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="../../../js/animacion.js"></script>
    <script type="text/javascript" src="../../../js/formulario.js"></script>

    <script>
        window.onload = function() {
            $("#name").val('');
            $("#pass").val('');
        };

        setTimeout(function() {
            $("#name").val('');
            $("#pass").val('');
        }, 800);

        $("form").submit(function(e) {
            e.preventDefault();
        });

        function logIn() {
            let user = document.getElementById("name").value;
            let pass = document.getElementById("pass").value;
            let session = null;
            // alert("User: " + user + ", pass: " + pass);

            let login = {
                user,
                pass
            };


            $.ajax({
                type: "POST",
                url: "../../usuarios/controller/?op=1",
                data: {
                    login: JSON.stringify(login)
                }
            }).done(function(result) {
                if (result) session = JSON.parse(result);
                if (session?.idu) {
                    sessionStorage.setItem('idu', session.idu);
                    sessionStorage.setItem('rol', session.rol)
                    sessionStorage.setItem('firstname', session.firstname);
                    sessionStorage.setItem('lastname', session.lastname);
                    sessionStorage.setItem('user', session.user);
                }
                location.href = "../../login/controller";
            }).fail(function(error) {
                alert("Error petición de inicio de sesión: " + error);
            });

        }
    </script>
</body>

</html>