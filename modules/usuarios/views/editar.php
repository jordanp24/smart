<!DOCTYPE html>
<html lang="es">
<?php
$tituloPagina = "Editar Usuario |  SMART";
include '../../include/views/head.php';
include "../../../db/conection.php";

$mysqli->query("start transaction");
$querydata = "SELECT t.id, t.descripcion FROM tipousuario t where t.deleted is null order by t.id";
$resultquery = $mysqli->query($querydata);

$query = "SELECT * FROM usuario where id=" . $_GET['cod'];
$result = $mysqli->query($query);
?>


<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>
        <!--Cuerpo-de-editarUsuario-->
        <div class="container marginNav">
            <div class="editarUsuario">
                <div>
                    <div class="row margin">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">EDITAR USUARIO</h1>
                                </div>
                                <div class="card-content">
                                    <?php
                                    if ($result->num_rows) {
                                        $row = $result->fetch_assoc();
                                    ?>
                                        <form class="">
                                            <div class="row">
                                                <div class="input-field col s6" hidden>
                                                    <input id="id" type="text" class="validate" readonly value="<?php echo $row["id"]; ?>">
                                                    <label for="nom" class="black-text">Nombres:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="nom" type="text" class="validate" required value="<?php echo $row["nombres"]; ?>">
                                                    <label for="nom" class="black-text">Nombres:<span class="red-text">
                                                            *</span></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="ape" type="text" class="validate" required value="<?php echo $row["apellidos"]; ?>">
                                                    <label for="ape" class="black-text">Apellidos:<span class="red-text">
                                                            *</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="usu" type="text" class="validate" required value="<?php echo $row["usuario"]; ?>">
                                                    <label for="usu" class="black-text">Usuario:<span class="red-text">
                                                            *</span></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="con" type="password" class="validate" required value="<?php echo $row["contrasena"]; ?>">
                                                    <label for="con" class="black-text">Contraseña:<span class="red-text">
                                                            *</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6 offset-s3 s3">
                                                    <select id="rol" name="rol" required>
                                                        <option value="" disabled selected>Seleccionar</option>
                                                        <?php
                                                        if ($resultquery->num_rows) while ($rows = $resultquery->fetch_assoc()) {
                                                            if ($rows['id'] == $row['tipousuario'])
                                                                echo "<option value='" . $rows['id'] . "' selected>" . $rows['descripcion'] . "</option>";
                                                            else
                                                                echo "<option value='" . $rows['id'] . "'>" . $rows['descripcion'] . "</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                    <label for="rol" class="black-text">Rol de Usuario<span class="red-text">
                                                            *</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <button id="enviar" type="button" class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita"><i class="material-icons right">update</i>Actualizar</button>
                                                    <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-2 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                </div>


                            <?php
                                    } else {
                            ?>
                                <form class="">
                                    <div class="row">
                                        <div class="input-field center-align">
                                            <div class="materialert error">
                                                <div class="material-icons">error_outline</div>
                                                Error: No se ha encontrado al usuario.
                                            </div>
                                            <a onclick="window.history.back()" class="modal-close waves-effect waves-light btn-small indigo darken-4 white-text negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                        </div>
                                    </div>
                                </form>
                            <?php
                                    }
                                    $mysqli->query("commit");
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!--Fin-cuerpo-de-editarUsuario-->
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
    <script type="text/javascript" src="../js/editar.js?v=1.0"></script>
</body>

</html>