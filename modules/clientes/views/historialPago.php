<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT a.idabono AS id, a.correlativo, a.adeudo, DATE_FORMAT(a.`fechaPagoCliente`, '%d/%m/%Y') AS fechapago,
CONCAT(c.nombres, ' ', c.apellidos) AS cliente
FROM abono a 
INNER JOIN detalleventa dv ON
dv.iddetalleventa = a.detalleventa
INNER JOIN venta v ON
v.idventa = dv.venta
INNER JOIN clientes c ON
v.cliente = c.idcliente
WHERE 
a.pago > 1 AND
a.detalleventa = " . $_GET['cod'];
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

        <!--Cuerpo-de-VerClientes-->
        <!--Data-Table-->
        <div class="container marginNav">
            <div class="row">
                <caption>
                    <h2 class="center-align titulo-1 negrita">HISTORIAL ABONOS</h2>
                    <hr><br>
                </caption>
                <div class="col s12">
                    <a class="btn red darken-3 right tooltipped" data-position="top" data-tooltip="Regresar" onclick="window.history.back()">Regresar<i class="material-icons right white-text">arrow_back</i></a>
                    <table id="tablaClientes" class=" materiales display striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                        <thead class="white-text indigo darken-4">
                            <tr>
                                <th>ID</th>
                                <th>CORRELATIVO</th>
                                <th>CLIENTE</th>
                                <th>PAGO Q.</th>
                                <th>FECHA PAGO</th>
                                <!-- <th>Morosidad</th> 
                                <th>Acción</th> -->
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
                                    <td><?php echo $row["correlativo"]; ?></td>
                                    <td><?php echo $row["cliente"]; ?></td>
                                    <td><?php echo $row["adeudo"]; ?></td>
                                    <td><?php echo $row["fechapago"]; ?></td>

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
                    ordering: false,
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