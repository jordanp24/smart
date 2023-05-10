<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Agregar Usuario |  SMART";
include '../../include/views/head.php';
include "../../../db/conection.php";

$mysqli->query("start transaction");
$querydata = "SELECT t.id, t.descripcion FROM tipousuario t where t.deleted is null order by t.descripcion";
$resultquery = $mysqli->query($querydata);
?>


<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-agregarUsuario-->
        <div class="container marginNav">
            <div class="agregarUsuario">
                <div>
                    <div class="row margin">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">AGREGAR USUARIO</h1>
                                </div>
                                <div class="card-content">
                                    <form class="">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="nom" type="text" class="validate" required>
                                                <label for="nom" class="black-text">Nombres:<span class="red-text">
                                                        *</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="ape" type="text" class="validate" required>
                                                <label for="ape" class="black-text">Apellidos:<span class="red-text">
                                                        *</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="usu" type="text" class="validate" required>
                                                <label for="usu" class="black-text">Usuario:<span class="red-text">
                                                        *</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="con" type="password" class="validate" required>
                                                <label for="con" class="black-text">Contraseña:<span class="red-text">
                                                        *</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6 offset-s3 s3">
                                                <select id="rol" name="rol" class="validate" required>
                                                    <option value="" disabled selected>Seleccionar</option>
                                                    <?php
                                                    if ($resultquery->num_rows) while ($row = $resultquery->fetch_assoc()) {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['descripcion'] . "</option?>";
                                                    }
                                                    $mysqli->query("commit");
                                                    ?>
                                                </select>
                                                <label for="rol" class="black-text">Rol de Usuario<span class="red-text">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field center-align">
                                                <button id="enviar" type="button" class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita"><i class="material-icons right">save</i>Guardar</button>
                                                <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-3 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!--Fin-cuerpo-de-agregarUsuario-->
    <!--Footer-de-Pagina-->
    <?php include '../../include/views/footer.php'; ?>
    <!--Fin-Footer-de-Pagina-->
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--JQuery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Google-Charts-CDN-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--Fin-Google-Charts-CDN-->
    <script type="text/javascript" src="../../../js/animacion.js"></script>
    <script type="text/javascript" src="../js/agregar.js?v=1."></script>
</body>
</body>

</html>