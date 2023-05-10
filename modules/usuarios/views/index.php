<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Usuarios |  SMART";
include '../../include/views/head.php';
include "../../../db/conection.php";

$mysqli->query("start transaction");
$querydata = "SELECT t.descripcion, u.* FROM usuario u INNER JOIN tipousuario t ON u.tipousuario = t.id where u.deleted is null ORDER BY u.id";
$resultquery = $mysqli->query($querydata);
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-VerUsuarios-->
        <!--Data-Table-->
        <div class="container marginNav">
            <div class="row">
                <caption>
                    <h2 class="center-align titulo-1 negrita">USUARIOS</h2>
                    <hr><br>
                </caption>
            </div>
            <div class="row center">
                <div class="input-field center-align">
                    <a class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Agregar venta" href="agregar.php"><i class="material-icons left white-text">add</i> Agregar</a>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <!-- <a class="btn cyan darken-3 right tooltipped" data-position="top" data-tooltip="Agregar Usuario" href="agregar.php"><i class="material-icons center">add</i></a> -->
                    <table id="tablaUsuario" class="striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                        <thead class="white-text indigo darken-4">
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
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
                                    <td><?php echo $row["descripcion"]; ?></td>
                                    <td><?php echo $row["nombres"]; ?></td>
                                    <td><?php echo $row["apellidos"]; ?></td>
                                    <td><?php echo $row["usuario"]; ?></td>
                                    <td>
                                        <a href="editar.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Editar Usuario"><i class="material-icons center indigo-text text-darken-3">edit</i></a>
                                        <a href="eliminar.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Eliminar Usuario"><i class="material-icons center indigo-text text-darken-3">delete</i></a>

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
                        <h2 class="titulo-1 center-align">Agregar Usuario</h2>
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
                $('#tablaUsuario').DataTable({
                    language: {
                        "info": "Mostrar _START_ a _END_ de _TOTAL_ registros existentes",
                        "zeroRecords": "No hay regisros para mostrar.",
                        "emptyTable": "No hay registros guardado para esta consulta.",
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
        <!--Fin-Cuerpo-de-VerUsuarios-->

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