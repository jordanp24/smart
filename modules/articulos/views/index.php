<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT 
    a.idarticulo AS id, 
    a.nombre, 
    a.descripcion, 
    a.precio,
    a.preciocompra,
    a.existencia,
    CONCAT(u.nombres, ' ', u.apellidos) AS agregadopor 
    FROM articulo a, usuario u 
    WHERE a.usuario = u.id and a.deleted is null
    ORDER BY a.nombre ASC";
$resultquery = $mysqli->query($querydata);
?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Artículos |  SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-mostrat-->
        <!--Data-Table-->
        <div class="container marginNav" style="margin-bottom: 60px;">

            <div class="row">
                <div class="row">
                    <caption>
                        <h2 class="center-align titulo-1 negrita">ARTÍCULOS</h2>
                        <hr><br>
                    </caption>
                </div>
                <div class="row center">
                    <div class="input-field center-align">
                        <a class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Agregar artículo" href="agregar.php"><i class="material-icons left white-text">add</i> Agregar</a>
                    </div>
                </div>
                <div class="col s12">
                    <!-- <a style="margin-top: 10px;" class="btn cyan darken-3 top right tooltipped" data-position="top" data-tooltip="Agregar Artículo" href="agregar.php"><i class="material-icons center white-text">add</i></a> -->
                    <table id="tablaArtículoss" class="striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                        <thead class="white-text indigo darken-4">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio Venta</th>
                                <th>Precio Compra</th>
                                <th>Existencia</th>
                                <th>Agregado por</th>
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
                                    <td><?php echo $row["nombre"]; ?></td>
                                    <td><?php echo $row["descripcion"]; ?></td>
                                    <td><?php echo "Q. " . $row["precio"]; ?></td>
                                    <td><?php echo "Q. " . $row["preciocompra"]; ?></td>
                                    <td><?php echo $row["existencia"]; ?></td>
                                    <td><?php echo $row["agregadopor"]; ?></td>
                                    <td>
                                        <?php
                                        echo "<a href='ver.php?cod=" . $row['id'] . "' class='btn white tooltipped' data-position='top' data-tooltip='Ver artículo'><i class='material-icons center indigo-text text-darken-3'>remove_red_eye</i></a>";
                                        echo "<a href='editar.php?cod=" . $row['id'] . "' class='btn white tooltipped' data-position='top' data-tooltip='Editar artículo'><i class='material-icons center indigo-text text-darken-3'>edit</i></a>";
                                        echo "<a href='eliminar.php?cod=" . $row['id'] . "' class='btn white tooltipped' data-position='top' data-tooltip='Eliminar artículo'><i class='material-icons center indigo-text text-darken-3'>delete</i></a>";
                                        echo "<a href='existencia.php?cod=" . $row['id'] . "' class='btn white tooltipped' data-position='top' data-tooltip='Existencia'><i class='material-icons center indigo-text text-darken-3'>content_paste</i></a>";
                                        ?>
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
                        <caption>
                            <h2 class="center-align titulo-1 negrita">ARTÍCULOS POR FECHAS</h2>
                            <hr><br>
                        </caption>

                        <form name="formReporte">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="date" id="inicio" name="inicio" required class="validate" />
                                    <!-- <input name="em" id="em" type="email" class="validate"> -->
                                    <label for="inicio" class="black-text">Fecha inicio:</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="date" id="fin" name="fin" required class="validate" />
                                    <label for="fin" class="black-text">Fecha fin:</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a style="margin-left: 10px" class="waves-effect waves-light btn-small  btn indigo darken-3 right tooltipped negrita" data-position="top" data-tooltip="Generar reporte" onclick="generarReporte()">Generar<i class="material-icons right">save</i></a>
                        <a class="modal-close waves-effect waves-light btn-small  btn red darken-4 right tooltipped negrita" data-position="top" data-tooltip="Cerrar">Cerrar<i class="material-icons right">close</i></a>
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

            // function generarReporte() {
            //     let rangoBusqueda = {
            //         inicio,
            //         fin
            //     }

            //     rangoBusqueda.inicio = document.getElementById('inicio').value
            //     rangoBusqueda.fin = document.getElementById('fin').value
            //     if (rangoBusqueda.inicio.length > 0 && rangoBusqueda.fin.length > 0) {
            //         let url = `reporte.php?rangoBusqueda=${JSON.stringify(rangoBusqueda)}`
            //         window.open(url, '_blank');
            //     } else if (!rangoBusqueda.inicio.length) {
            //         alert('Debe indicar el rango de inicio para ala busqueda de los articuloss');
            //         $('#inicio').focus()
            //     } else if (!rangoBusqueda.fin.length) {
            //         alert('Debe indicar el fin del rango para ala busqueda de los articuloss');
            //         $('#fin').focus()
            //     }
            // }
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