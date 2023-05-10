<?php
include "../../../db/conection.php";
$mysqli->query("start transaction");
$querydata = "SELECT * FROM cliente where id=" . $_GET['cod'];
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
                    <div class="row margin marginNav">
                        <div class="col s12">
                            <div class="card hoverable z-depth-2">
                                <div class="card-title indigo darken-1 white-text">
                                    <h1 class="center-align titulo-3 negrita">EDITAR CLIENTE</h1>
                                </div>

                                <div class="card-content">
                                    <?php
                                    if ($resultquery->num_rows) {
                                        $row = $resultquery->fetch_assoc();
                                    ?>
                                        <form method="POST" enctype="multipart/form-data" action="../controller/?op=2">
                                            <div class="row" hidden>
                                                <div class="input-field col s6">
                                                    <input name="idc" id="idc" type="text" class="validate" value="<?php echo $row["id"]; ?>">
                                                    <label for="idc" class="black-text">Nombres:</label>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input name="nom" id="nom" type="text" class="validate" required value="<?php echo $row["nombres"]; ?>">
                                                    <label for="nom" class="black-text">Nombres: <span class="red-text">*</span></label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input name="ape" id="ape" type="text" class="validate" required value="<?php echo $row["apellidos"]; ?>">
                                                    <label for="apellido" class="black-text">Apellidos:<span class="red-text">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s4">
                                                    <input name="ser" id="ser" type="text" class="validate" value="<?php echo $row["servicio"]; ?>">
                                                    <label for="ser" class="black-text">Servicio:</label>
                                                </div>

                                                <div class="input-field col s4">
                                                    <input name="tip" id="tip" type="text" class="validate" value="<?php echo $row["tiposervicio"]; ?>">
                                                    <label for="tip" class="black-text">Tipo servicio:</label>
                                                </div>
                                                <div class="input-field col s4">
                                                    <input name="mor" id="mor" type="email" class="validate" value="<?php echo $row["morosidad"] == 1 ? 'Moroso' : "Al día"; ?>">
                                                    <label for="mor" class="black-text">Morosidad:</label>
                                                </div>
                                            </div>

                                            <?php
                                            $querydata = "SELECT * FROM direccion where cliente = " . $row["id"];
                                            $resultquery = $mysqli->query($querydata);
                                            ?>

                                            <table id="tablaDirecciones" class="striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                                                <thead class="white-text indigo darken-4">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Direccion</th>

                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    if ($resultquery->num_rows)
                                                        // output data of each row
                                                        while ($row = $resultquery->fetch_assoc()) {
                                                    ?>
                                                        <tr id="">
                                                            <td><?php echo $row["id"]; ?></td>
                                                            <td><input name="cel" id="cel" type="text" class="validate" value="<?php echo $row["descripcion"]; ?>"></td>
                                                            <td>
                                                                <button id="<?php echo $row['id'] ?>" type="button" onclick="editarDireccion(this.id)" class="btn white tooltipped" data-position="top" data-tooltip="Editar dirección"><i class="material-icons center indigo-text text-darken-3">edit</i></button>
                                                                <button id="<?php echo $row['id'] ?>" type="button" onclick="showModalcliente(this.id)" class="btn white tooltipped" data-position="top" data-tooltip="Ver teléfonos"><i class="material-icons center indigo-text text-darken-3">call</i></button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    $mysqli->query("commit");
                                                    ?>
                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <div id="modalTelefonos" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <caption>
                                                            <h2 class="center-align titulo-1 negrita">TELÉFONOS</h2>
                                                            <hr><br>
                                                        </caption>
                                                        <div class="col s12">
                                                            <!-- <a class="btn cyan darken-3 right tooltipped" data-position="top" data-tooltip="Agregar Abono" href="agregar.php"><i class="material-icons center white-text">add</i></a> -->
                                                            <table id="tablaClientes" class=" materiales display striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                                                                <thead class="white-text indigo darken-3">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>NÚMERO</th>
                                                                        <th>ACCIÓN</th>
                                                                        <!-- <th>Opción</th> -->
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="rowsTelefonos">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="modal-close btn red darken-4 right tooltipped negrita" data-position="top" data-tooltip="Cerrar">Cerrar<i class="material-icons right">close</i></a>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="input-field center-align">
                                                    <button type="submit" name="enviar" id="enviar" class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita"><i class="material-icons right">update</i>Actualizar</button>
                                                    <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-2 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <form class="">
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
                            </form>
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

    <script>
        async function showModalcliente(id) {
            $('#modalTelefonos').modal('open');
            let telefonos = [];
            let cont = 0;
            let contClean = 0;

            $.ajax({
                type: "get",
                url: `../controller/?op=telefonos&id=${id}`,
            }).done(function(result) {
                if (telefonos = JSON.parse(result)) {
                    $('#modalTelefonos #rowsTelefonos tr').each(function() {
                        contClean++;
                    });

                    for (let index = 0; index < contClean; index++) {
                        $('#modalTelefonos #rowsTelefonos #fila' + index).remove();
                    }

                    for (const telefono of telefonos) {
                        let fila = `<tr id="fila${cont}">\n
                        <td>${telefono?.id}</td>\n <td><input name="cel" id="cel" type="text" class="validate" value="${telefono.numero}"></td>\n
                        <td><button id="${telefono?.id}" onclick="editarDireccion(this.id)" class="btn white tooltipped" data-position="top" data-tooltip="Editar Cliente"><i class="material-icons center indigo-text text-darken-3">edit</i></button></td>\n</tr>\n`;
                        $('#modalTelefonos #rowsTelefonos').append(fila);
                        cont++;
                    }
                }
            }).fail(function(error) {
                console.log(error)
                alert("Error petición de inicio de sesión: " + error);
            });
        }

        $(document).ready(function() {
            $('#tablaDirecciones').DataTable({
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script type="text/javascript" src="../../../js/animacion.js"></script>
    <script type="text/javascript" src="../../../js/formulario.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="../../../js/animacion.js"></script>



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