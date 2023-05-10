<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Agregar Cliente |  SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-agregarCliente-->
        <div class="container" style="margin-top: 20px;">
            <div class="agregarCliente">
                <div>
                    <div class="row margin">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">NUEVO CLIENTE</h1>
                                </div>
                                <div class="card-content">
                                    <form method="POST" enctype="multipart/form-data" action="../controller/?op=1">
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input name="nom" id="nom" type="text" class="validate" required>
                                                <label for="nom" class="black-text">Nombres:<span class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="ape" id="ape" type="text" class="validate" required>
                                                <label for="ape" class="black-text">Apellidos:<span class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="dpi" id="dpi" type="number" class="required" onblur="validarDPIcliente()">
                                                <label for="dpi" class="black-text">NIT o DPI</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input name="dir" id="dir" type="text" class="validate">
                                                <label for="dir" class="black-text">Dirección:</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="cel" id="cel" type="number" class="validate">
                                                <label for="cel" class="black-text">Teléfono:</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="em" id="em" type="email" class="validate">
                                                <label for="em" class="black-text">Correo electrónico:</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="file-field input-field col s6">
                                                <div class="btn blue darken-4">
                                                    <span><i class="material-icons center white-text">assignment</i></span>
                                                    <input title="Foto recibo de luz o patente" name="fore" id="fore" type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input title="Foto recibo de luz o patente" placeholder="Foto recibo de servicios o patente" class="file-path validate" type="text">
                                                </div>
                                            </div>
                                            <div class="file-field input-field col s6">
                                                <div class="btn blue darken-4">
                                                    <span><i class="material-icons center white-text">contacts</i></span>
                                                    <input title="Foto DPI" name="fodpi" id="fodpi" type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input title="Foto DPI" placeholder="Foto DPI" class="file-path validate" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field center-align">
                                                <button class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita" id="enviar"><i class="material-icons right">save</i>Guardar</button>
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
    </div>
    <br>
    <!--Fin-cuerpo-de-agregarCliente-->
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
    <script type="text/javascript" src="../js/agregar.js?v=1.0"></script>

    <script>
        $(document).ready(function() {
            // $('form').submit(function(ev) {
            //     $(this).unbind('submit').submit()
            // });
            // function(evt) {return true;}
            $('form').submit(function(evt) {
                $(this).unbind('submit').submit()
            });
        })

        function validarDPIcliente() {
            let dpi = document.getElementById('dpi').value
            if (dpi.length) {
                $.ajax({
                    type: "GET",
                    url: `../controller/?op=buscarCliente&dpi=${dpi}`,   
                }).done(function(result) {

                    let cliente = JSON.parse(result);
                    if (cliente?.dpi?.length) {
                        alert(`Ya existe un cliente con NIT o DPI: ${cliente.dpi} y nombre: ${cliente.nombre}`);
                        $("#enviar").prop('disabled', true);
                        $("#nom").prop('disabled', true);
                        $("#ape").prop('disabled', true);
                        $("#dir").prop('disabled', true);
                        $("#cel").prop('disabled', true);
                        $("#em").prop('disabled', true);
                        $("#fore").prop('disabled', true);
                        $("#fodpi").prop('disabled', true);                        
                    } else {
                        alert(`El cliente con DPI: ${dpi} es válido.`);
                        $("#enviar").prop('disabled', false);
                        $("#nom").prop('disabled', false);
                        $("#ape").prop('disabled', false);
                        $("#dir").prop('disabled', false);
                        $("#cel").prop('disabled', false);
                        $("#em").prop('disabled', false);
                        $("#fore").prop('disabled', false);
                        $("#fodpi").prop('disabled', false);                        
                    }
                }).fail(function(error) {
                    alert("Error Petición GET: " + error);
                });
            }
        }
    </script>
</body>

</html>