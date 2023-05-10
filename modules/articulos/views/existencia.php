<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT a.idarticulo as id, a.nombre, a.descripcion, a.precio, a.imagen, a.codigo, a.preciocompra, a.existencia FROM articulo a WHERE a.idarticulo = " . $_GET['cod'];
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
                                    <h1 class="center-align titulo-3 negrita">EXISTENCIA ARTÍCULO</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                        <form method="POST" onsubmit="save()">
                                            <div class="row">

                                                <div class="input-field col s12" hidden>
                                                    <input value="<?php echo $row["id"] ?>" id="id" name="id" type="text" max="100" required>
                                                    <label for="id" class="black-text">ID:<span class="red-text">*</span></label>
                                                </div>

                                                <div class="input-field col s6">
                                                    <input id="cod" name="cod" value="<?php echo $row["codigo"] ?>" type="text" max="20" required>
                                                    <label for="cod" class="black-text">Código:<span class="red-text">*</span></label>
                                                </div>


                                                <div class="input-field col s6">
                                                    <input value="<?php echo $row["nombre"] ?>" id="nom" name="nom" type="text" max="100" required onblur="buscarProducto()">
                                                    <label for="nom" class="black-text">Nombre:<span class="red-text">*</span></label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s6 offset-s3">
                                                    <input id="exis" name="exis" value="<?php echo $row["existencia"] ?>" type="number" required>
                                                    <label for="exis" class="black-text">Existencia:<span class="red-text">*</span></label>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <?php
                                                if (file_exists($row['imagen'])) echo "<div class='col m12 s6'><img class='responsive-img' alt='Foto recibo' src='" . $row['imagen'] . "'></div>";
                                                ?>
                                            </div>


                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <button class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita" type="submit"><i class="material-icons right">save</i>Guardar</button>
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
                                                        Error: No se ha encontrado al articulos
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

    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('form').submit(function(evt) {
        //         $(this).unbind('submit').submit()
        //     });
        // })


        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function(item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }


        function save() {
            let exis = document.getElementById('exis').value
            let cod = findGetParameter("cod");
            console.log({
                exis,
                cod
            });


            if (exis <= 0) {
                alert("No puede haber existencia 0 de un artículo");
            } else {

                $.ajax({
                    type: "POST",
                    url: "../controller/?op=existencia",
                    data: {
                        existencia: exis,
                        articulo: cod
                    },
                }).done(function(result) {
                    if (result != 1) {
                        alert(result);
                    } else if (result == 1) {
                        alert('La existencia se actualizó correctamente');
                        location.href = "./";
                    }
                }).fail(function(error) {
                    alert("Error Petición POST: " + error);
                });
            }

        }
    </script>
</body>

</html>