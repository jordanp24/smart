<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT 
v.idventa AS id, 
CONCAT(c.nombres, ' ', c.apellidos) AS cliente,
CONCAT(u.nombres, ' ', u.apellidos) AS vendedor
FROM venta v
INNER JOIN clientes c ON
c.idcliente = v.cliente
INNER JOIN usuario u ON
u.id = v.usuario
WHERE c.idcliente = ".$_GET['cod'];
$resultquery = $mysqli->query($querydata);
?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Cliente |  SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-mostrat-->
        <!--Data-Table-->
        <div class="container marginNav" style="margin-bottom: 60px;">
            <div class="row">
                <caption>
                    <h2 class="center-align titulo-1 negrita">HISTORIAL DE VENTAS </h2>
                    <hr><br>
                </caption>
                <div class="col s12">
                <a class="btn red darken-3 right tooltipped" data-position="top" data-tooltip="Regresar" onclick="window.history.back()">Regresar<i class="material-icons right white-text">arrow_back</i></a>
                    <table id="tablaArtículoss" class="striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                        <thead class="white-text indigo darken-4">
                            <tr>
                                <th>ID</th>
                                <th>CLIENTE</th>
                                <th>VENDEDOR</th>
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
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["cliente"]; ?></td>
                                    <td><?php echo $row["vendedor"]; ?></td>
                                    <td>
                                        <!-- <a href="historialPago.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Ver historial de pagos"><i class="material-icons center indigo-text text-darken-3">attach_money</i></a> -->
                                        <a href="verVenta.php?cod=<?php echo $row["id"]; ?>" class="btn white tooltipped" data-position="top" data-tooltip="Ver Venta"><i class="material-icons center indigo-text text-darken-3">attach_money</i></a>
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
                $('#tablaArtículoss').DataTable({
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
                    ordering: false,
                    columnDefs: [{
                        targets: ['_all'],
                        className: 'mdc-data-table__cell'
                    }],
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                });
                $("select").val('10');
                $('select').addClass("browser-default");
                $('.dt-button').addClass("waves-effect waves-light indigo negrita white-text");
                // $('select').material_select();
            });
        </script>
        <!--Fin-Cuerpo-de-mostrat-->

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




    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>


</body>

</html>