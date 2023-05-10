<?php
include "../../../db/conection.php";

?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Artículo |  SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-VerClientes-->
        <!--Data-Table-->
        <div class="container" style="margin-top: 25px; margin-bottom: 60px">

            <div class="row">
                <div class="col s12">
                    <div class="card hoverable z-depth-2">
                        <div class="card-title indigo darken-1 white-text">
                            <h1 class="center-align titulo-3 negrita">NUEVO ARTÍCULO</h1>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="../controller/?op=agregar" enctype="multipart/form-data">

                                <div class="row" hidden>
                                    <div class="input-field col s12">
                                        <input id="idu" name="idu" type="text" max="100" required>
                                        <label for="idu" class="black-text">IDU:<span class="red-text">*</span></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="cod" name="cod" type="text" max="20" required>
                                        <label for="cod" class="black-text">Código:<span class="red-text">*</span></label>
                                    </div>
                                    <!-- </div>

                                <div class="row"> -->
                                    <div class="input-field col s6">
                                        <input id="nom" name="nom" type="text" max="100" required onblur="buscarProducto()">
                                        <label for="nom" class="black-text">Nombre:<span class="red-text">*</span></label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="pre" name="pre" type="text" required class="validate" onblur="validarPrecio()" onkeyup="this.value=Numeros(this.value)">
                                        <label for="pre" class="black-text">Precio Venta Q.:<span class="red-text">*</span></label>
                                    </div>

                                    <div class="input-field col s6">
                                        <input id="preco" name="preco" type="text" required class="validate" onblur="validarPrecio()" onkeyup="this.value=Numeros(this.value)">
                                        <label for="preco" class="black-text">Precio Compra Q.:<span class="red-text">*</span></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="des" name="des" cols="30" rows="10" class="materialize-textarea"></textarea>
                                        <label for="des" class="black-text">Descripción:<span class="red-text">*</span></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="file-field input-field col offset-s3 s6">
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
                                    <div class="input-field center-align">
                                        <button class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita" type="submit" id="enviar"><i class="material-icons right">save</i>Guardar</button>
                                        <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-3 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../js/agregar.js?v=1.0"></script>

        <!--Fin-Data-Table-->
        <!--Footer-de-Pagina-->
        <?php include '../../include/views/footer.php'; ?>
        <!--Fin-Footer-de-Pagina-->
        <script>
            $(document).ready(function() {

                $('#idu').val(sessionStorage.getItem('idu'));

                $('form').submit(function(evt) {
                    $(this).unbind('submit').submit()
                });
            });

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
                if (nom.length) {
                    $.ajax({
                        type: "GET",
                        url: `../controller/?op=buscar&nombre=${nom}`,
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
        <!--Fin-Cuerpo-de-VerClientes-->

    </div>
    <!-- Compiled and minified JavaScript -->
    <!--Google-Charts-CDN-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--Fin-Google-Charts-CDN-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
    <!--JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Fin-Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script type="text/javascript" src="../../../js/animacion.js"></script>
    <script type="text/javascript" src="../../../js/formulario.js"></script>

</body>

</html>