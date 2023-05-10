<!--Ultima-Actualizacion:-03/29/2021-->
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "404: Not Found | SMART";
include './modules/include/views/head.php';
?>

<head>
    <link rel="shortcut icon" href="./img/logo.jpeg" />
</head>

<body class="teal lighten-4 login">
    <div class="container marginNav">
        <div>
            <div class="row margin">
                <div class="col s12 m8 offset-m2">
                    <div class="card hoverable z-depth-2">
                        <div class="card-title red darken-3 white-text">
                            <h1 class="center-align titulo-3 negrita">ERROR 404</h1>
                        </div>
                        <div class="card-content center">
                            <p>¡La página a la que intentas acceder no existe. Verifica la dirección!</p>
                        </div>
                        <br>
                        <div class="card-action right-align">
                            <a class="waves-effect waves-light btn-small teal darken-3 white-text" onclick="window.history.back()"><i class="material-icons right">backspace</i>Regresar</a>
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
</body>

</html>