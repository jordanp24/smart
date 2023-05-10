<!--Ultima-Actualizacion:-03/29/2021-->
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Sesión Cerrada con Éxito |  SMART";
include '../../include/views/head.php';
?>

<body class="grey lighten-4 login">
    <div class="container marginNav">
        <div>
            <div class="row margin">
                <div class="col s12 m8 offset-m2">
                    <div class="card hoverable z-depth-2">
                        <div class="card-title indigo darken-2 white-text">
                            <h1 class="center-align titulo-3 negrita">¡Has Cerrado Sesión con Éxito!</h1>
                        </div>
                        <div class="card-content center">
                            <br>
                            <p>Si deseas iniciar sesión presiona el botón de Inicio de sesión.</p>
                        </div>
                        <br>
                        <div class="card-action right-align">
                            <a class="waves-effect waves-light btn-small indigo darken-4 white-text" href="login.php"><i class="material-icons right">login</i>Inicio de Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../../../js/animacion.js"></script>
    <script type="text/javascript" src="../../../js/formulario.js"></script>
    <script type="text/javascript">
        sessionStorage.removeItem('idu');
        sessionStorage.removeItem('rol');
        sessionStorage.removeItem('firstname');
        sessionStorage.removeItem('lastname');
        sessionStorage.removeItem('user');
    </script>
</body>

</html>