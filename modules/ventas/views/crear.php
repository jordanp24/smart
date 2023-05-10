<?php
include "../../../db/conection.php";
// $mysqli->query("start transaction");

// $querydata = "SELECT * FROM clientes where idcliente=" . $_GET['cod'];
// $resultquery = $mysqli->query($querydata);

?>
<!DOCTYPE html>
<html lang="es">

<?php
$tituloPagina = "Editar Venta | SMART";
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
                                    <h1 class="center-align titulo-3 negrita">DATOS DEL CLIENTE</h1>
                                </div>

                                <div class="card-content">
                                    <form method="POST" enctype="multipart/form-data" action="../controller/?op=1">
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input name="nom" id="nom" type="text" class="validate" required>
                                                <label for="nom" class="black-text">Nombres:<span class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="ape" id="ape" type="text" class="validate" required>
                                                <label for="ape" class="black-text">Apellidos:<span class="red-text">*</span></label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="dpi" id="dpi" type="number" class="required" required ">
                                                <label for=" dpi" class="black-text">DPI o</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <input name="dir" id="dir" type="text" class="validate" required>
                                                <label for="dir" class="black-text">Dirección:</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="cel" id="cel" type="number" class="validate">
                                                <label for="cel" class="black-text">Teléfono:</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input name="em" id="em" type="email" class="validate">
                                                <label for="em" class="black-text">Correo electrónico:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12 m12">
                                                <input maxlength="200" name="des" id="des" type="text" class="validate" value="">
                                                <label for="des" class="black-text">Descripción de la venta:</label>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="file-field input-field col s6">
                                                <div class="btn blue darken-4">
                                                    <span><i class="material-icons center white-text">assignment</i></span>
                                                    <input title="Foto recibo de luz o patente" required name="fore" id="fore" type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input title="Foto recibo de luz o patente" placeholder="Foto recibo de luz o patente *" class="file-path validate" type="text">
                                                </div>
                                            </div>
                                            <div class="file-field input-field col s6">
                                                <div class="btn blue darken-4">
                                                    <span><i class="material-icons center white-text">contacts</i></span>
                                                    <input title="Foto DPI" required name="fodpi" id="fodpi" type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input title="Foto DPI" placeholder="Foto DPI *" class="file-path validate" type="text">
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="row">
                                            <div class="input-field center-align">
                                                <button class="col s6 modal-close waves-effect waves-light btn-small indigo darken-3 negrita" id="enviar"><i class="material-icons right">save</i>Guardar</button>
                                                <a onclick="window.history.back()" class="col s6 modal-close waves-effect waves-light btn-small red darken-3 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <caption>
                            <h2 class="center-align titulo-1 negrita">ARTÍCULOS SELECCIONADOS</h2>
                            <hr><br>
                        </caption>
                        <div class="col s12">
                            <a class="btn indigo darken-2 right tooltipped modal-trigger" data-position="top" data-tooltip="Agregar Material" href="#tablarticulosModal"><i class="material-icons center">add</i></a>
                            <br><br><br><br>
                            <table id="articulosagregados" class=" display striped responsive-table display nowrap highlight centered z-depth-1" cellspacing="0" width="100%">
                                <thead class="white-text indigo darken-2">
                                    <tr>
                                        <th hidden>ID</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody id="articulos">

                                </tbody>


                                <style>
                                    @media screen and (max-width: 992px) {
                                        #total {
                                            display: none;
                                        }
                                    }

                                    @media screen and (min-width: 993px) {
                                        #total2 {
                                            display: none;
                                        }
                                    }
                                </style>

                                <tbody id="total">
                                    <tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold">
                                        <td></td>
                                        <td></td>
                                        <td class="right">TOTAL Q.</td>
                                        <td><?php echo $total; ?></td>
                                    </tr>
                                </tbody>

                                <tbody id="total2">
                                    <tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold">
                                        <td>TOTAL Q.</td>
                                    </tr>
                                    <tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold">
                                        <td><?php echo $total; ?></td>
                                    </tr>
                                </tbody>

                            </table><br><br>
                            <div class="row">
                                <div class="input-field center-align">
                                    <button id="pausar" type="button" class="btn-small blue darken-1 negrita"><i class="material-icons right">access_time</i>Pausar</button>
                                    <button id="enviar" type="button" class="btn-small indigo darken-1 negrita"><i class="material-icons right">save</i>Guardar</button>
                                    <a onclick="window.history.back()" class="btn-small red darken-2 negrita"><i class="material-icons right">cancel</i>Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        $queryarticulos = "SELECT 
                            a.idarticulo AS id, 
                            a.nombre, 
                            a.descripcion, 
                            a.precio,
                            a.existencia,
                            CONCAT(u.nombres, ' ', u.apellidos) AS agregadopor 
                            FROM articulo a, usuario u 
                            WHERE a.usuario = u.id and a.existencia > 0 and a.deleted is null
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
                                                <th>Existencia</th>
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
                                                    <td><?php echo $row["existencia"]; ?></td>
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

        var cont = 0;
        var cantRows = 0;
        var total = 0;


        $(document).ready(function() {
            $('#enviar').click(function() {
                let rol = sessionStorage.getItem('rol');

                let cliente = {
                    nombre: '',
                    apellido: '',
                    dpi: '',
                    direccion: '',
                    celular: '',
                    email: ''
                }

                let venta = {
                    cliente: '',
                    descripcion: '',
                    usuario: ''
                };

                let articulo = {
                    idarticulo: '',
                    cantidad: '',
                    preciofinal: ''
                };

                let detalles = [];

                cliente.nombre = document.getElementById("nom").value;
                cliente.apellido = document.getElementById("ape").value;
                cliente.dpi = document.getElementById("dpi").value;
                cliente.direccion = document.getElementById("dir").value;
                cliente.celular = document.getElementById("cel").value;
                cliente.email = document.getElementById("em").value;

                venta.usuario = sessionStorage.getItem('idu');
                venta.descripcion = document.getElementById('des').value;

                if (!cliente.nombre.length) {
                    alert("El nombre cliente está vacío");
                } else if (!cliente.apellido.length) {
                    alert("El apellido del cliente está vacío");
                } else if (!cliente.direccion.length) {
                    alert("La dirección del cliente está vacía");
                } else if (!cliente.celular.length) {
                    alert("La celular del cliente está vacío");
                } else {

                    if (cantRows > 0) {
                        $('#articulosagregados #articulos tr').each(function() {
                            articulo.idarticulo = $(this).find('td').eq(0).text();
                            articulo.cantidad = $(this).find('td').eq(2).text();
                            articulo.preciofinal = $(this).find('td').eq(3).text();
                            detalles.push(articulo);
                            articulo = {
                                idarticulo: '',
                                cantidad: '',
                                preciofinal: ''
                            };
                        });

                        if (confirm("¿Desea guarda los datos?")) {

                            $('#articulosagregados #articulos tr').each(function() {
                                $(this).remove();
                            });
                            cont = 0;
                            cantRows = 0;

                            $.ajax({
                                type: "POST",
                                url: "../controller/?op=crear",
                                data: {
                                    cliente: JSON.stringify(cliente),
                                    venta: JSON.stringify(venta),
                                    detalles: JSON.stringify(detalles)
                                },
                            }).done(function(result) {
                                if (result != 1) {
                                    alert(result);
                                } else {
                                    alert('Venta generada correctamente');
                                    let url = rol == 1 ? `rptVenta.php?cod=${cod}` : `rptVentaShort.php?cod=${cod}`;
                                    window.open(url, '_blank');
                                    location.href = "./";
                                }
                            }).fail(function(error) {
                                alert("Error Petición POST: " + error);
                            });
                        } else {
                            detalles = [];
                        }

                    } else {
                        alert("¡Debe agregar por lo menos un artículo!");
                    }
                }
            });
        });




        $(document).ready(function() {
            $('#pausar').click(function() {
                let rol = sessionStorage.getItem('rol');

                let cliente = {
                    nombre: '',
                    apellido: '',
                    dpi: '',
                    direccion: '',
                    celular: '',
                    email: ''
                }

                let venta = {
                    cliente: '',
                    descripcion: '',
                    usuario: ''
                };

                let articulo = {
                    idarticulo: '',
                    cantidad: '',
                    preciofinal: ''
                };

                let detalles = [];

                cliente.nombre = document.getElementById("nom").value;
                cliente.apellido = document.getElementById("ape").value;
                cliente.dpi = document.getElementById("dpi").value;
                cliente.direccion = document.getElementById("dir").value;
                cliente.celular = document.getElementById("cel").value;
                cliente.email = document.getElementById("em").value;

                venta.usuario = sessionStorage.getItem('idu');
                venta.descripcion = document.getElementById('des').value;

                if (!cliente.nombre.length) {
                    alert("El nombre cliente está vacío");
                } else if (!cliente.apellido.length) {
                    alert("El apellido del cliente está vacío");
                } else if (!cliente.direccion.length) {
                    alert("La dirección del cliente está vacía");
                } else if (!cliente.celular.length) {
                    alert("La celular del cliente está vacío");
                } else {

                    if (cantRows > 0) {
                        $('#articulosagregados #articulos tr').each(function() {
                            articulo.idarticulo = $(this).find('td').eq(0).text();
                            articulo.cantidad = $(this).find('td').eq(2).text();
                            articulo.preciofinal = $(this).find('td').eq(3).text();
                            detalles.push(articulo);
                        });

                        if (confirm("¿Desea guarda los datos?")) {

                            $('#articulosagregados #articulos tr').each(function() {
                                $(this).remove();
                            });
                            cont = 0;
                            cantRows = 0;

                            $.ajax({
                                type: "POST",
                                url: "../controller/?op=pausarCrear",
                                data: {
                                    cliente: JSON.stringify(cliente),
                                    venta: JSON.stringify(venta),
                                    detalles: JSON.stringify(detalles)
                                },
                            }).done(function(result) {
                                if (result != 1) {
                                    alert(result);
                                } else {
                                    alert('Venta generada correctamente');
                                    let url = (rol == 1) ? `rptVenta.php` : `rptVentaShort.php`;
                                    window.open(url, '_blank');
                                    location.href = "./";
                                }
                            }).fail(function(error) {
                                alert("Error Petición POST: " + error);
                            });
                        } else {
                            detalles = [];
                        }

                    } else {
                        alert("¡Debe agregar por lo menos un artículo!");
                    }
                }
            });
        });



        function seleccionArticulo(id) {
            $("#tablarticulos tbody #row" + id).each(function() {
                let ida, idadd, nom, precio;
                let valido = true;
                let cantidad = 0;

                $("#articulosagregados #articulos tr").each(function() {
                    if (id == $(this).find('td').eq(0).text()) valido = false;
                });

                if (valido) {
                    cont++;
                    cantRows++;

                    ida = $(this).find('td').eq(0).text();
                    nom = $(this).find('td').eq(1).text();
                    pre = parseFloat($(this).find('td').eq(4).text());
                    while (typeof cantidad == 'object' || cantidad == 0 || parseFloat(pre) < cantidad) {
                        if (cantidad == 0) {
                            cantidad = prompt("Ingrese la cantidad de unidades:", "0");
                        } else if (parseFloat(pre) < cantidad) {
                            cantidad = prompt("No puede vender mas unidades de las existentes:", "0");
                        } else
                            cantidad = prompt("Valide la cantidad de unidades a vender:", "0");
                    }


                    let fila = `<tr id="fila${cont}">\n<td hidden>${ida}</td>\n<td>${nom}</td>\n<td>${cantidad}</td>\n<td>${pre * cantidad}</td>\n<td>\n<button type="button" class="btn red white-text tooltipped" id="${cont}" onclick="elim(this.id)" data-position="top" data-tooltip="Eliminar"><i class="material-icons center">delete</i></button></td>\n</tr>\n`;
                    $('#articulosagregados #articulos').append(fila);

                    total = total + (pre * cantidad);
                    let fila2 = `<tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold">\n<td></td><td></td><td colspan="3" class="right">TOTAL A PAGAR Q.</td><td>${total}</td>\n</tr>`;
                    let fila3 = `<tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold"><td>${total}</td>\n</tr>`;
                    $('#articulosagregados #total #pagototal').remove();
                    $('#articulosagregados #total2 #pagototal').remove();
                    $('#articulosagregados #total').append(fila2);
                    $('#articulosagregados #tota2').append(fila3);

                    $('#tablarticulosModal').modal('close');
                } else alert('El artículo ya fue agregado.')
            });
        }

        function elim(id_fila) {
            if (cantRows <= 0) {
                alert("Alerta: ¡no existe ningun artículo para eliminar!");
                return false;
            } else {
                cantRows--;

                let subtotal = 0;

                $('#articulosagregados #articulos #fila' + id_fila).each(function() {

                    subtotal = parseFloat($(this).find('td').eq(3).text());
                    console.log({
                        subtotal
                    });
                });

                total = total - subtotal;

               
                let fila2 = `<tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold">\n<td></td><td></td><td colspan="3" class="right">TOTAL A PAGAR Q.</td><td>${total}</td>\n</tr>`;
                let fila3 = `<tr id="pagototal" style="background-color: #7DCEA0; color: #145A32; font-weight: bold"><td>${total}</td>\n</tr>`;

                $('#articulosagregados #articulos #fila' + id_fila).remove();

                $('#articulosagregados #total #pagototal').remove();
                $('#articulosagregados #total').append(fila2);

                $('#articulosagregados #total2 #pagototal').remove();
                $('#articulosagregados #tota2').append(fila3);
                
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