<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT * FROM clientes where deleted is null ORDER BY idcliente";
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
                        <h2 class="center-align titulo-1 negrita">VENTAS</h2>
                        <hr><br>
                    </caption>
                </div>
                <div class="row center">
                    <div class="input-field center-align">
                        <a class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Crear venta" href="crear.php"><i class="material-icons left white-text">add</i> Crear venta</a>
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
                                <th>DPI</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($resultquery->num_rows)
                                // output data of each row
                                while ($row = $resultquery->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["idcliente"]; ?></td>
                                    <td><?php echo $row["nombres"]; ?></td>
                                    <td><?php echo $row["apellidos"]; ?></td>
                                    <td><?php echo $row["dpi"]; ?></td>
                                    <td><?php echo $row["direccion"]; ?></td>
                                    <td><?php echo $row["telefono"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <td>
                                        <a href="agregar.php?cod=<?php echo $row["idcliente"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Generar venta"><i class="material-icons center indigo-text text-darken-3">arrow_forward</i></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            $mysqli->query("commit");
                            ?>
                        </tbody>
                    </table>
                </div>
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