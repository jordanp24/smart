<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT * FROM cliente where deleted is null ORDER BY id";
$resultquery = $mysqli->query($querydata);
?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Clientes |  SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-VerClientes-->
        <!--Data-Table-->
        <div class="container marginNav">
            <div class="row">
                <div class="row">
                    <caption>
                        <h2 class="center-align titulo-1 negrita">CLIENTES</h2>
                        <hr><br>
                    </caption>
                </div>
                <div class="row center">
                    <div class="input-field center-align">
                        <a class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Agregar cliente" href="agregarCliente.php"><i class="material-icons left white-text">add</i> Agregar</a>
                    </div>
                </div>
                <div class="col s12">
                    <!-- <a class="btn cyan darken-3 right tooltipped" data-position="top" data-tooltip="Agregar Cliente" href="agregarCliente.php"><i class="material-icons center white-text">add</i></a> -->
                    <table id="tablaClientes" class="striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                        <thead class="white-text indigo darken-4">
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Servicio</th>
                                <th>Dirección</th>
                                <th>Tipo servicio</th>
                                <th>Morosidad</th>
                                <!-- <th>Morosidad</th> -->
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($resultquery->num_rows)
                                // output data of each row
                                while ($row = $resultquery->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["nombres"]; ?></td>
                                    <td><?php echo $row["apellidos"]; ?></td>
                                    <td><?php echo $row["servicio"]; ?></td>
                                    <td><?php echo $row["direccion"]; ?></td>
                                    <td><?php echo $row["tiposervicio"]; ?></td>
                                    <td><?php echo $row["morosidad"] == 1 ? 'Moroso' : "Al día"; ?></td>
                                    <td>
                                        <a href="mostrarCliente.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Ver Cliente"><i class="material-icons center indigo-text text-darken-3">remove_red_eye</i></a>
                                        <a href="editarCliente.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Editar Cliente"><i class="material-icons center indigo-text text-darken-3">edit</i></a>
                                        <a href="eliminarCliente.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Eliminar Cliente"><i class="material-icons center indigo-text text-darken-3">delete</i></a>
                                        <a href="historialCliente.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Historial Cliente"><i class="material-icons center indigo-text text-darken-3">assignment</i></a>

                                    </td>
                                </tr>
                            <?php
                                }
                            $mysqli->query("commit");
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--estructura-de-diálogo-modal-->
                <div id="agregarmodal" class="modal grey lighten-4">
                    <div class="modal-content">
                        <h2 class="titulo-1 center-align">Agregar Cliente</h2>
                    </div>
                    <div class="modal-footer grey lighten-4">
                        <a href="#!" class="modal-close waves-effect waves-light btn-small indigo darken-1 negrita"><i class="material-icons right">save</i>Guardar</a>
                        <a href="#!" class="modal-close waves-effect waves-light btn-small red darken-2 negrita"><i class="material-icons right">backspace</i>Cancelar</a>
                    </div>
                </div>
                <!--fin-estructura-de-diálogo-modal-->


            </div>
        </div>
        <!--Fin-Data-Table-->
        <!--Footer-de-Pagina-->
        <?php include '../../include/views/footer.php'; ?>
        <!--Fin-Footer-de-Pagina-->
        <script>
            $(document).ready(function() {
                $('#tablaClientes').DataTable({
                    language: {
                        "info": "Mostrar _START_ a _END_ de _TOTAL_ registros existentes",
                        "zeroRecords": "No hay regisros para mostrar.",
                        "emptyTable": "No hay regisros para mostrar.",
                        "infoEmpty": "Mostrando 0 de 0 de _TOTAL_ registros existentes.",
                        "infoFiltered": "(filtrado desde _MAX_ registros existentes.)",
                        "lengthMenu": "Mostrar _MENU_ Registros",
                        "searchPlaceholder": "Buscar:",
                        "search": "",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Sig.",
                            "previous": "Ant."
                        }
                    },
                    responsive: true,
                    autoWidth: false,
                    columnDefs: [{
                        targets: ['_all'],
                        className: 'mdc-data-table__cell'
                    }],
                });
                $("select").val('10');
                $('select').addClass("browser-default");
                // $('select').material_select();
            });
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