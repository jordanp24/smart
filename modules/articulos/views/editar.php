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
                                    <h1 class="center-align titulo-3 negrita">EDITAR ARTÍCULO</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                        <form method="POST" enctype="multipart/form-data" action="../controller/?op=editar">
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
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $row["precio"] ?>" id="pre" name="pre" type="text" required class="validate" onblur="validarPrecio()" onkeyup="this.value=Numeros(this.value)">
                                                    <label for="pre" class="black-text">Precio venta Q:<span class="red-text">*</span></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $row["preciocompra"] ?>" id="preco" name="preco" type="text" required class="validate" onblur="validarPrecio()" onkeyup="this.value=Numeros(this.value)">
                                                    <label for="preco" class="black-text">Precio compra Q:<span class="red-text">*</span></label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="des" name="des" cols="30" rows="10" class="materialize-textarea"><?php echo $row["descripcion"] ?></textarea>
                                                    <label for="des" class="black-text">Descripción:<span class="red-text">*</span></label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="file-field input-field col s6 offset-s3">
                                                    <div class="btn blue darken-4">
                                                        <span><i class="material-icons center white-text">add_a_photo</i></span>
                                                        <input title="Foto recibo de luz o patente" name="imgart" id="imgart" type="file">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input title="Foto recibo de luz o patente" placeholder="Foto recibo de luz o patente *" class="file-path validate" type="text">
                                                    </div>
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
        $(document).ready(function() {
            $('form').submit(function(evt) {
                $(this).unbind('submit').submit()
            });
        })

        function validarPrecio() {
            let pre = document.getElementById('pre').value
            let preco = document.getElementById('preco').value

            if (parseFloat(pre) < parseFloat(preco)) {
                alert('El precio de compra no puede ser mayor al de venta.');
            }
        };


        function Numeros(string) { //Solo numeros
            var out = '';
            var filtro = '1234567890.'; //Caracteres validos

            //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
            for (var i = 0; i < string.length; i++)
                if (filtro.indexOf(string.charAt(i)) != -1)
                    //Se añaden a la salida los caracteres validos
                    out += string.charAt(i);

            //Retornar valor filtrado
            return out;
        }

        function buscarProducto() {
            let nom = document.getElementById('nom').value
            let id = document.getElementById('id').value

            if (nom.length) {
                $.ajax({
                    type: "GET",
                    url: `../controller/?op=buscarEdit&nombre=${nom}&id=${id}`,
                }).done(function(result) {
                    let articulo = JSON.parse(result);
                    if (articulo?.id?.length) {
                        alert(`Ya existe un artículo con nombre: ${articulo.nombre}`);
                        $("#enviar").prop('disabled', true);
                        $("#cod").prop('disabled', true);
                        $("#pre").prop('disabled', true);
                        $("#preco").prop('disabled', true);
                        $("#des").prop('disabled', true);
                        $("#imgart").prop('disabled', true);
                    } else {
                        // alert(`El nombre: ${nom}, para un articulo es válido.`);
                        $("#enviar").prop('disabled', false);
                        $("#cod").prop('disabled', false);
                        $("#pre").prop('disabled', false);
                        $("#preco").prop('disabled', false);
                        $("#des").prop('disabled', false);
                        $("#imgart").prop('disabled', false);
                    }
                }).fail(function(error) {
                    alert("Error Petición GET: " + error);
                });
            }
        }
    </script>
</body>

</html>