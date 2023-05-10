<?php
    include "../../../db/conection.php";
    $mysqli->query("start transaction");
    $querydata = "SELECT * FROM clientes where idcliente=" . $_GET['cod'];
    $resultquery = $mysqli->query($querydata);
?>
<!DOCTYPE html>
<html lang="es">

<?php 
    $tituloPagina = "Eliminar Cliente | SMART";
    include '../../include/views/head.php'; 
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-eliminarCliente-->
        <div class="container marginNav">
            <div class="eliminarCliente">
                <div>
                    <div class="row margin">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">ELIMINAR CLIENTE</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                    <form class="">
                                        <div class="row" hidden>
                                            <div class="input-field col s6">
                                                <input id="id" type="text" class="validate" disabled
                                                    value="<?php echo $row["idcliente"]; ?>">
                                                <label for="nom" class="black-text">Nombres:</label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="nom" type="text" class="validate" required disabled
                                                    value="<?php echo $row["nombres"]; ?>">
                                                <label for="nom" class="black-text">Nombres:<span
                                                        class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="ape" type="text" class="validate" required disabled
                                                    value="<?php echo $row["apellidos"]; ?>">
                                                <label for="apellido" class="black-text">Apellidos:<span
                                                        class="red-text">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="nit" type="number" class="validate" disabled
                                                    value="<?php echo $row["dpi"]; ?>">
                                                <label for="nit" class="black-text">NIT:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="dir" type="text" class="validate" required disabled
                                                    value="<?php echo $row["direccion"]; ?>">
                                                <label for="dir" class="black-text">Dirección:<span
                                                        class="red-text">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="cel" type="number" class="validate" disabled
                                                    value="<?php echo $row["telefono"]; ?>">
                                                <label for="cel" class="black-text">Teléfono:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="em" type="email" class="validate" disabled
                                                    value="<?php echo $row["email"]; ?>">
                                                <label for="email" class="black-text">Correo electrónico:</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field center-align">
                                                <button type="button" id="enviar"
                                                    class="col s6 modal-close waves-effect waves-light btn-small orange darken-1 negrita"><i
                                                        class="material-icons right">delete</i>Eliminar</button>
                                                <a onclick="window.history.back()"
                                                    class="col s6 modal-close waves-effect waves-light btn-small red darken-2 negrita"><i
                                                        class="material-icons right">cancel</i>Cancelar</a>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    } else {
                                    ?>
                                    <form class="">
                                        <style>

                                        </style>
                                        <div class="row">
                                            <div class="input-field center-align">
                                                <div class="materialert error">
                                                    <div class="material-icons">error_outline</div>
                                                    Error: No se ha encontrado al cliente
                                                </div>
                                                <a onclick="window.history.back()"
                                                    class="modal-close waves-effect waves-light btn-small red darken-2 negrita"><i
                                                        class="material-icons right">cancel</i>Cancelar</a>
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
    <!--Fin-cuerpo-de-eliminarCliente-->
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
    <script type="text/javascript" src="../js/eliminar.js"></script>
</body>

</html>