<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");

$querydata = "SELECT c.idcliente, v.idventa AS id, c.nombres, c.apellidos, c.dpi, c.direccion, c.telefono, c.email, v.descripcion FROM venta v 
INNER JOIN clientes c ON
v.cliente = c.idcliente
WHERE v.idventa =" . $_GET['cod'];
$resultquery = $mysqli->query($querydata);

?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Editar Cliente | SMART";
include '../../include/views/head.php';
?>

<body>

    <div>
        <?php include '../../include/views/navbar.php'; ?>

        <!--Cuerpo-de-editarCliente-->
        <div class="container marginNav">
            <div class="editarCliente">
                <div>
                    <div class="row center" style="margin-top: 40px;">
                        <div class="input-field center-align">
                            <div id="admin">
                                <a target="_blank" class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Venta PDF" href="../../ventas/views/rptVenta.php?cod=<?php echo $_GET['cod'] ?>"><i class="material-icons left white-text">assignment</i> Generar Venta en PDF</a>
                            </div>
                            <div id="encargado">
                                <a target="_blank" class="btn cyan darken-3 tooltipped" data-position="top" data-tooltip="Venta PDF" href="../../ventas/views/rptVentaShort.php?cod=<?php echo $_GET['cod'] ?>"><i class="material-icons left white-text">assignment</i> Generar Venta en PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="row margin marginNav">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">DATOS DEL CLIENTE</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                        <form method="POST" enctype="multipart/form-data" action="../controller/?op=2">
                                            <div class="row" hidden>
                                                <div class="input-field col s6">
                                                    <input disabled name="idc" id="idc" type="text" class="validate" value="<?php echo $row["idcliente"]; ?>">
                                                    <label for="idc" class="black-text">Nombres:</label>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input disabled name="nom" id="nom" type="text" class="validate" required value="<?php echo $row["nombres"]; ?>">
                                                    <label for="nom" class="black-text">Nombres: <span class="red-text">*</span></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input disabled name="ape" id="ape" type="text" class="validate" required value="<?php echo $row["apellidos"]; ?>">
                                                    <label for="apellido" class="black-text">Apellidos:<span class="red-text">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input disabled name="dpi" id="dpi" type="text" class="validate" value="<?php echo $row["dpi"]; ?>">
                                                    <label for="dpi" class="black-text">NIT:</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input disabled name="dir" id="dir" type="text" class="validate" required value="<?php echo $row["direccion"]; ?>">
                                                    <label for="dir" class="black-text">Dirección:<span class="red-text">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input disabled name="cel" id="cel" type="number" class="validate" value="<?php echo $row["telefono"]; ?>">
                                                    <label for="cel" class="black-text">Teléfono:</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input disabled name="em" id="em" type="email" class="validate" value="<?php echo $row["email"]; ?>">
                                                    <label for="em" class="black-text">Correo electrónico:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12 m12">
                                                    <input maxlength="200" name="des" id="des" type="text" class="validate" value="<?php echo $row["descripcion"]; ?>">
                                                    <label for="des" class="black-text">Descripción:</label>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <form class="">3
                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <div class="materialert error">
                                                        <div class="material-icons">error_outline</div>
                                                        Error: No se ha encontrado al cliente
                                                    </div>
                                                    <a onclick="window.history.back()" class="modal-close waves-effect waves-light btn-small red darken-2 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    $mysqli->query("commit");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <caption>
                            <h2 class="center-align titulo-1 negrita">ARTÍCULOS</h2>
                            <hr><br>
                        </caption>
                        <div class="col s12">
                            <!-- <a class="btn indigo darken-2 right tooltipped modal-trigger" data-position="top" data-tooltip="Agregar artículo" href="#tablarticulosModal"><i class="material-icons center">add</i></a> -->
                            <br><br><br><br>
                            <table id="articulosagregados" class=" display striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                                <thead class="white-text indigo darken-2">
                                    <tr>
                                        <th hidden>IDTV</th>
                                        <th hidden>IDA</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio Q.</th>
                                        <!-- <th>Acción</th> -->
                                    </tr>
                                </thead>

                                <?php
                                $cont = 0;
                                $mysqli->query("start transaction");
                                $resultquery = $mysqli->query($querydata);
                                $queryarticulosadd = "SELECT 
                                v.idventa AS idv, 
                                dv.iddetalleventa AS idtv, 
                                a.idarticulo AS ida,
                                a.nombre, 
                                dv.preciofinal,
                                dv.cantidad
                                FROM detalleventa dv 
                                INNER JOIN venta v ON
                                v.idventa = dv.venta
                                INNER JOIN articulo a ON 
                                a.idarticulo = dv.articulo
                                WHERE v.idventa = " . $_GET['cod'] . " AND dv.deleted IS NULL";
                                $articulosagregados = $mysqli->query($queryarticulosadd);
                                ?>

                                <tbody>
                                    <?php
                                    if ($articulosagregados->num_rows)
                                        // output data of each row
                                        while ($row = $articulosagregados->fetch_assoc()) {
                                            $cont++;
                                    ?>
                                        <tr id="fila<?php echo $cont; ?>">
                                            <td hidden><?php echo $row["idtv"]; ?></td>
                                            <td hidden><?php echo $row["ida"]; ?></td>
                                            <td><?php echo $row["nombre"]; ?></td>
                                            <td><?php echo $row["cantidad"]; ?></td>
                                            <td><?php echo $row["preciofinal"]; ?></td>
                                            <?php
                                            // echo "<td>\n<a href='historialPago.php?cod=" . $row['idtv'] . "' class='btn indigo darken-1 white-text tooltipped' id='fila$cont' data-position='top' data-tooltip='Ver Historial pago'><i class='material-icons center'>attach_money</i></a></td>\n</tr>";

                                            ?>
                                        </tr>
                                    <?php
                                        }
                                    $mysqli->query("commit");
                                    ?>
                                </tbody>
                            </table><br><br>

                            <div hidden>
                                <label style="font-weight: bold; color: #2C3E50;" for="cont">Cont</label><br>
                                <input value="<?php echo $cont; ?>" disabled="" class="form-modal form-modal" id='cont' name='cont' maxlength="1000" cols='120' rows='5' />
                            </div>

                            <div class="row">
                                <div class="input-field center-align">
                                    <!-- <button id="enviar" type="button" class="btn-small indigo darken-1 negrita"><i class="material-icons right">save</i>Guardar</button> -->
                                    <a onclick="window.history.back()" class="btn-small red darken-2 negrita"><i class="material-icons right">arrow_back</i>Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        $mysqli->query("start transaction");
                        $resultquery = $mysqli->query($querydata);
                        $queryarticulos = "SELECT 
                            a.idarticulo AS id, 
                            a.nombre, 
                            a.descripcion, 
                            a.precio, 
                            CONCAT(u.nombres, ' ', u.apellidos) AS agregadopor 
                            FROM articulo a, usuario u 
                            WHERE a.usuario = u.id and a.vendido is null and a.deleted is null
                            ORDER BY a.nombre ASC";
                        $resultarticulos = $mysqli->query($queryarticulos);
                        ?>
                        <div id="tablarticulosModal" class="modal modal-fixed-footer">
                            <div class="modal-content">
                                <caption>
                                    <h2 class="center-align titulo-1 negrita">ARTÍCULOS</h2>
                                    <hr><br>
                                </caption>
                                <div class="col s12">
                                    <!-- <a class="btn cyan darken-3 right tooltipped" data-position="top" data-tooltip="Agregar Abono" href="agregar.php"><i class="material-icons center white-text">add</i></a> -->
                                    <table id="tablarticulos" class=" materiales display striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                                        <thead class="white-text indigo darken-4">
                                            <tr>
                                                <th hidden>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Precio Q.</th>

                                                <!-- <th>Agregado por</th> -->
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if ($resultarticulos->num_rows)
                                                // output data of each row
                                                while ($row = $resultarticulos->fetch_assoc()) {
                                            ?>
                                                <tr id="row<?php echo $row['id']; ?>">
                                                    <td hidden><?php echo $row["id"]; ?></td>
                                                    <td><?php echo $row["nombre"]; ?></td>
                                                    <td><?php echo $row["descripcion"]; ?></td>
                                                    <td><?php echo $row["precio"]; ?></td>
                                                    <!-- <td><?php echo $row["agregadopor"]; ?></td> -->
                                                    <td>
                                                        <?php
                                                        echo "<button id=" . $row['id'] . " onclick='seleccionArticulo(this.id)' class='btn indigo tooltipped' data-position='top' data-tooltip='Selecionar'><i class='material-icons center white-text text-darken-3'>check_circle</i></button>";
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
                            </div>
                            <div class="modal-footer">
                                <a class="modal-close btn red darken-4 right tooltipped negrita" data-position="top" data-tooltip="Cerrar">Cerrar<i class="material-icons right">close</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!--Fin-cuerpo-de-editarCliente-->
    <!--Footer-de-Pagina-->
    <?php include '../../include/views/footer.php'; ?>
    <!--Fin-Footer-de-Pagina-->
    </div>
    <script type="text/javascript" src="../js/agregar.js?v=1.0"></script>
    <script>
        $("form").submit(function(e) {
            e.preventDefault();
        });

        var cont = 0,
            cantRows = 0;
        cont = cantRows = document.getElementById('cont').value;

        var artsDeleted = [];


        function disableAdminFunctions() {
            let rol = sessionStorage.getItem('rol');
            if (rol != 1) {
                $('#addButton').attr("disabled", true);
                $('.deleteButton').attr("disabled", true);
                $('#admin').attr("hidden", true);
            } else $('#encargado').attr("hidden", true);
        }
        disableAdminFunctions();


        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function(item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

        $(document).ready(function() {
            $('#enviar').click(function() {
                let venta = {
                    cliente: '',
                    descripcion: '',
                    usuario: ''
                };

                let articulo = {
                    idarticulo: '',
                    financiamiento: '',
                    interes: '',
                    preciofinal: ''
                };

                let detalles = [];

                venta.cliente = document.getElementById("idc").value;
                venta.usuario = sessionStorage.getItem('idu');
                venta.descripcion = document.getElementById('des').value;
                let cod = findGetParameter("cod");

                if (cantRows > 0) {
                    $('#articulosagregados tbody tr').each(function() {
                        articulo.idarticulo = $(this).find('td').eq(1).text();
                        articulo.financiamiento = $(this).find('td').eq(3).text();
                        articulo.interes = $(this).find('td').eq(4).text();
                        articulo.preciofinal = $(this).find('td').eq(5).text();
                        detalles.push(articulo);
                    });

                    if (confirm("¿Desea guarda los datos?")) {
                        $('#articulosagregados tbody tr').each(function() {
                            $(this).remove();
                        });
                        cont = 0;
                        cantRows = 0;

                        $.ajax({
                            type: "POST",
                            url: "../controller/?op=editar",
                            data: {
                                venta: JSON.stringify(venta),
                                detalles: JSON.stringify(detalles),
                                artsDeleted: JSON.stringify(artsDeleted),
                                idventa: cod
                            },
                        }).done(function(result) {
                            if (result != 1) {
                                alert(result);
                            } else {
                                alert('Venta editada correctamente');
                                location.href = "../views";
                                // window.history.back();
                            }
                        }).fail(function(error) {
                            alert("Error Petición POST: " + error);
                        });
                    } else {
                        detalles = [];
                    }

                } else {
                    alert("¡Debe agregar por lo menos una material!");
                }
            });
        });



        function seleccionArticulo(id) {
            $("#tablarticulos tbody #row" + id).each(function() {
                let utilidad = 0,
                    cuotas = 0;
                let ida, idadd, nom, precio;
                let valido = true;

                $("#articulosagregados tbody tr").each(function() {
                    if (id == $(this).find('td').eq(1).text()) valido = false;
                });

                if (valido) {
                    cont++;
                    cantRows++;
                    while (!utilidad.length) utilidad = prompt("Igrese el % de utilidad:", "15");
                    while (!cuotas.length) cuotas = prompt("Igrese # de cuotas", "6");
                    ida = $(this).find('td').eq(0).text();
                    nom = $(this).find('td').eq(1).text();
                    pre = parseFloat($(this).find('td').eq(3).text()) + parseFloat((utilidad / 100) * $(this).find('td').eq(3).text());
                    let fila = `<tr id="fila${cont}">\n<td>0</td>\n<td>${ida}</td>\n<td>${nom}</td>\n<td>${cuotas}</td>\n<td>${utilidad}</td>\n<td>${pre}</td>\n<td>${pre}</td>\n<td>\n<button type="button" class="btn red white-text tooltipped" id="fila${cont}" onclick="elim(this.id)" data-position="top" data-tooltip="Eliminar"><i class="material-icons center">delete</i></button></td>\n</tr>\n`;
                    $('#articulosagregados tbody').append(fila);
                    $('#tablarticulosModal').modal('close');
                } else alert('El artículo ya fue agregado.')
            });
        }

        function elim(id_fila) {
            if (cantRows <= 0) {

                alert("Alerta: ¡no existe ningun material para eliminar!");
                return false;

            } else {

                cantRows--;



                // console.log({routeParam: cod})

                $("#articulosagregados tbody #" + id_fila).each(function() {
                    if ($(this).find('td').eq(0).text() > 0) artsDeleted.push($(this).find('td').eq(0).text());
                });

                $('#articulosagregados tbody #' + id_fila).remove();

                console.log({
                    artsDeleted
                });

                return false;
            }

        }

        $(document).ready(function() {
            $('#tablarticulos').DataTable({
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
                    },
                    "pageLength": 7
                },
                responsive: true,
                autoWidth: false,
                paginate: false,
                ordering: false,
                info: false,
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


    <!--Google-Charts-CDN-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Fin-Google-Charts-CDN-->
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

    <!--Fin-Google-Charts-CDN-->


    <!--JQuery-->

    <!-- Fin-Compiled and minified CSS -->




    <!-- <script type="text/javascript" src="../js/editar.js"></script> -->
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
    </script>

</body>

</html>