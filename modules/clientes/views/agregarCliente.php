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
                                            <div class="input-field col s6">
                                                <input name="nom" id="nom" type="text" class="validate" required>
                                                <label for="nom" class="black-text">Nombres:<span class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="ape" id="ape" type="text" class="validate" required>
                                                <label for="ape" class="black-text">Apellidos:<span class="red-text">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="ser" id="ser" type="text" class="validate">
                                                <label for="ser" class="black-text">Servicio:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="tip" id="tip" type="text" class="validate">
                                                <label for="tip" class="black-text">Tipo:</label>
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
            $('#enviar').click(function() {
                let cliente = {};
                
                let nom = document.getElementById("nom").value;
                let ape = document.getElementById("ape").value;
                let ser = document.getElementById("ser").value;
                let tip = document.getElementById("tip").value;

                cliente = {
                    nom,
                    ape,
                    ser,
                    tip
                };


                if (!cliente?.nom?.length) {
                    alert("El nombre está vacío: ");
                } else if (!cliente?.ape?.length) {
                    alert("El apellido está vacío");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../controller/?op=1",
                        data: {
                            cliente: JSON.stringify(cliente)
                        },
                    }).done(function(result) {
                        if (result != 1) {
                            alert(result);
                        } else if (result == 1) {
                            alert('El cliente fue guardado correctamente');
                            location.href = "verClientes.php";
                        }
                    }).fail(function(error) {
                        alert("Error Petición POST: " + error);
                    });
                }
            });
        });


        $("form").submit(function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>