<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT a.idarticulo as id, a.nombre, a.descripcion, a.precio FROM articulo a WHERE a.idarticulo = " . $_GET['cod'];
$resultquery = $mysqli->query($querydata);
?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Editar Artículo | SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-editarArtículo-->
        <div class="container marginNav">
            <div class="editarArtículo">
                <div>
                    <div class="row margin">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">EDITAR ARTÍCULO</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                        <form onsubmit="eliminar()">
                                        <div class="row">
                                                
                                                <div class="input-field col s12" hidden>
                                                    <input value="<?php echo $row["id"] ?>" id="id" name="id" type="text" max="100" required>
                                                    <label for="id" class="black-text">Nombre:<span class="red-text">*</span></label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row["nombre"] ?>" id="nom" name="nom" type="text" max="100" required>
                                                    <label for="nom" class="black-text">Nombre:<span class="red-text">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="des" name="des" cols="30" rows="10" class="materialize-textarea"><?php echo $row["descripcion"] ?></textarea>
                                                    <label for="des" class="black-text">Descripción:<span class="red-text">*</span></label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input value="<?php echo $row["precio"] ?>" id="pre" name="pre" type="text" required class="validate">
                                                    <label for="pre" class="black-text">Precio Venta Q:<span class="red-text">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <!-- <button class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita" type="submit"><i class="material-icons right">save</i>Guardar</button> -->
                                                    <button id="enviar" type="submit" class="col s6 modal-close waves-effect waves-light btn-small orange darken-1 white-text negrita"><i class="material-icons right">delete</i>Eliminar</button>
                                                    <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-3 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <form class="">
                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <div class="materialert error">
                                                        <div class="material-icons">error_outline</div>
                                                        Error: No se ha encontrado al articulo
                                                    </div>
                                                    <a onclick="window.history.back()" class="modal-close waves-effect waves-light btn-small red darken-2 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    $mysqli->query("commit");
                                    ?>

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
    <br>
    <!--Fin-cuerpo-de-editarArtículo-->
    <!--Footer-de-Pagina-->
    <?php include '../../include/views/footer.php'; ?>
    <!--Fin-Footer-de-Pagina-->
    </div>

    <script type="text/javascript" src="../js/eliminar.js?v=1.1"></script>
</body>

</html>