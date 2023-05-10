<?php
include("../../../db/conection.php");
$op = $_GET['op'];

switch ($op) {
    case 'agregar':
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);

        $mysqli->query("start transaction");



        if (!$mysqli->query("CALL add_venta('" . $venta['descripcion'] . "', " . $venta['cliente'] . ", " . $venta['usuario'] . ",  @msg)")) {
            echo "Error al guarda el articulos: " . $mysqli->error;
            $mysqli->query("rollback");
        } else {
            $mysqli->query("commit");
            $mysqli->query("start transaction");

            foreach ($detalles as $detalle) {
                $mysqli->query("commit");
                $mysqli->query("start transaction");


                $arti = $detalle['idarticulo'];
                $preciof = $detalle['preciofinal'];
                $cant = $detalle['cantidad'];

                $query = "CALL add_detalleventa((SELECT MAX(v.idventa) FROM venta v), $arti,  $preciof, $cant, @msg)";
                // echo $query;
                if (!$mysqli->query($query)) {
                    echo "Error al guardar articulos de la venta: " . $mysqli->error;
                }
            }

            $mysqli->query("commit");
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];
            echo $msg;
        }

        break;

    case 'crear':
        $cliente = json_decode($_POST['cliente'], true);
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);

        $nombre = $cliente['nombre'];
        $apellido = $cliente['apellido'];
        $dpi = $cliente['dpi'];
        $direccion = $cliente['direccion'];
        $celular = $cliente['celular'];
        $email = $cliente['email'];

        $mysqli->query("start transaction");

        $query = "CALL add_cliente('$nombre', '$apellido', '$dpi', '$direccion', '$celular', '$email', '', '', @msg)";

        if (!$mysqli->query($query)) {
            echo "Error al guarda la cliente: " . $mysqli->error;
            $mysqli->query("rollback");
        } else {
            if (!$mysqli->query("CALL add_venta('" . $venta['descripcion'] . "', (SELECT MAX(c.idcliente) FROM clientes c), " . $venta['usuario'] . ",  @msg)")) {
                echo "Error al guarda la venta: " . $mysqli->error;
                $mysqli->query("rollback");
            } else {
                $mysqli->query("commit");
                $mysqli->query("start transaction");

                foreach ($detalles as $detalle) {
                    $mysqli->query("commit");
                    $mysqli->query("start transaction");

                    $arti = $detalle['idarticulo'];
                    $preciof = $detalle['preciofinal'];
                    $cant = $detalle['cantidad'];

                    $query = "CALL add_detalleventa((SELECT MAX(v.idventa) FROM venta v), $arti,  $preciof, $cant, @msg)";
                    // echo $query;
                    if (!$mysqli->query($query)) {
                        echo "Error al guardar articulos de la venta: " . $mysqli->error;
                    }
                }

                $mysqli->query("commit");
                $result = $mysqli->query("SELECT @msg as m");
                $salida = $result->fetch_assoc();
                $msg = $salida['m'];
                echo $msg;
            }
        }

        break;

    case 'editar':
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);
        $artsDeleted = json_decode($_POST['artsDeleted'], true);
        $idventa = $_POST['idventa'];
        $updateProcess = false;
        // var_dump($detalles);

        $mysqli->query("start transaction");

        if (!empty($artsDeleted))
            foreach ($artsDeleted as $dtv) {
                if (!$mysqli->query("CALL del_detalleventa($dtv, @msg);")) {
                    echo "Error al anular articulos de la venta: " . $mysqli->error;
                    $updateProcess = false;
                    $mysqli->query("rollback");
                } else {
                    $updateProcess = true;
                }
            }
        else $updateProcess = true;


        if ($updateProcess) {
            if (!empty($detalles))
                foreach ($detalles as $detalle) {

                    $arti = $detalle['idarticulo'];
                    $preciof = $detalle['preciofinal'];
                    $cant = $detalle['cantidad'];

                    $query = "CALL add_detalleventa($idventa, $arti, $preciof, $cant, @msg)\n";

                    if (!$mysqli->query($query)) {
                        $updateProcess = false;
                        echo "Error al guardar articulos de la venta: " . $mysqli->error;
                    }
                }
        } else if (!$updateProcess) {
            $mysqli->query("rollback");
        }


        if ($updateProcess) {
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];
            echo $msg;
            $mysqli->query("commit");
        }

        break;


    case 'pausar':
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);

        $mysqli->query("start transaction");
        $msg;


        if (!$mysqli->query("CALL add_venta_pausada('" . $venta['descripcion'] . "', " . $venta['cliente'] . ", " . $venta['usuario'] . ",  @msg)")) {
            echo "Error al guarda el articulos: " . $mysqli->error;
            $mysqli->query("rollback");
        } else {

            foreach ($detalles as $key => $detalle) {
                if ($key == 0) {
                    $arti = $detalle['idarticulo'];
                    $cant = $detalle['cantidad'];

                    $query = "CALL add_detalleventa_pausado((SELECT MAX(v.idventa) FROM venta v), $arti, $cant, @msg)";

                    if (!$mysqli->query($query)) {
                        echo "Error al guardar articulos de la venta: " . $mysqli->error;
                        $mysqli->query("rollback");
                    } else {
                        $result = $mysqli->query("SELECT @msg as m");
                        $salida = $result->fetch_assoc();
                        $msg = $salida['m'];
                    }
                } else {
                    if ($msg != 1) {
                        $mysqli->query("rollback");
                        echo $msg;
                    } else {
                        $arti = $detalle['idarticulo'];
                        $cant = $detalle['cantidad'];

                        $query = "CALL add_detalleventa_pausado((SELECT MAX(v.idventa) FROM venta v), $arti, $cant, @msg)";

                        if (!$mysqli->query($query)) {
                            echo "Error al guardar articulos de la venta: " . $mysqli->error;
                            $mysqli->query("rollback");
                        } else {
                            $result = $mysqli->query("SELECT @msg as m");
                            $salida = $result->fetch_assoc();
                            $msg = $salida['m'];
                        }
                    }
                }
            }
        }

        $result = $mysqli->query("SELECT @msg as m");
        $salida = $result->fetch_assoc();
        $msg = $salida['m'];
        if ($msg == 1) $mysqli->query("commit");
        echo $msg;

        break;




    case 'pausarCrear':
        $cliente = json_decode($_POST['cliente'], true);
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);

        $nombre = $cliente['nombre'];
        $apellido = $cliente['apellido'];
        $dpi = $cliente['dpi'];
        $direccion = $cliente['direccion'];
        $celular = $cliente['celular'];
        $email = $cliente['email'];

        $mysqli->query("start transaction");
        $msg;


        $query = "CALL add_cliente('$nombre', '$apellido', '$dpi', '$direccion', '$celular', '$email', '', '', @msg)";

        if (!$mysqli->query($query)) {
            echo "Error al guarda la cliente: " . $mysqli->error;
            $mysqli->query("rollback");
        } else {
            if (!$mysqli->query("CALL add_venta_pausada('" . $venta['descripcion'] . "', (SELECT MAX(c.idcliente) FROM clientes c), " . $venta['usuario'] . ",  @msg)")) {
                echo "Error al guarda la venta: " . $mysqli->error;
                $mysqli->query("rollback");
            } else {
                foreach ($detalles as $key => $detalle) {

                    if ($key == 0) {
                        $arti = $detalle['idarticulo'];
                        $cant = $detalle['cantidad'];

                        $query = "CALL add_detalleventa_pausado((SELECT MAX(v.idventa) FROM venta v), $arti, $cant, @msg)";

                        if (!$mysqli->query($query)) {
                            echo "Error al guardar articulos de la venta: " . $mysqli->error;
                            $mysqli->query("rollback");
                        } else {
                            $result = $mysqli->query("SELECT @msg as m");
                            $salida = $result->fetch_assoc();
                            $msg = $salida['m'];
                        }
                    } else {
                        if ($msg != 1) {
                            $mysqli->query("rollback");
                            echo $msg;
                        } else {
                            $arti = $detalle['idarticulo'];
                            $cant = $detalle['cantidad'];

                            $query = "CALL add_detalleventa_pausado((SELECT MAX(v.idventa) FROM venta v), $arti, $cant, @msg)";

                            if (!$mysqli->query($query)) {
                                echo "Error al guardar articulos de la venta: " . $mysqli->error;
                                $mysqli->query("rollback");
                            } else {
                                $result = $mysqli->query("SELECT @msg as m");
                                $salida = $result->fetch_assoc();
                                $msg = $salida['m'];
                            }
                        }
                    }
                }
            }
        }

        $result = $mysqli->query("SELECT @msg as m");
        $salida = $result->fetch_assoc();
        $msg = $salida['m'];
        if ($msg == 1) $mysqli->query("commit");
        echo $msg;

        break;



    case 'pausarEditar':
        $venta = json_decode($_POST['venta'], true);
        $detalles = json_decode($_POST['detalles'], true);
        $artsDeleted = json_decode($_POST['artsDeleted'], true);
        $detallesConfirmacion = json_decode($_POST['detallesConfirmacion'], true);
        $idventa = $_POST['idventa'];
        $updateProcess = false;

        $mysqli->query("start transaction");

        if (!$mysqli->query("UPDATE venta SET pausada = 0 WHERE idventa = $idventa")) {
            echo "Error al confirmar la venta: " . $mysqli->error;
            $updateProcess = false;
            $mysqli->query("rollback");
        }

        if (!empty($artsDeleted)) {
            foreach ($artsDeleted as $dtv) {
                if (!$mysqli->query("CALL del_detalleventa_pausado($dtv, @msg);")) {
                    echo "Error al anular articulos de la venta: " . $mysqli->error;
                    $updateProcess = false;
                    $mysqli->query("rollback");
                } else {
                    $updateProcess = true;
                }
            }
        } else $updateProcess = true;


        if ($updateProcess) {
            if (!empty($detalles)) foreach ($detalles as $key => $detalle) {

                $idtv = $detalle['idtv'];
                $query = "CALL confirm_detalleventa($idtv, @msg)";

                if ($key == 0) {
                    if (!$mysqli->query($query)) {
                        echo "Error al guardar articulos de la venta: " . $mysqli->error;
                    } else {
                        $result = $mysqli->query("SELECT @msg as m");
                        $salida = $result->fetch_assoc();
                        $msg = $salida['m'];
                    }
                } else {
                    if ($msg != 1) {
                        $mysqli->query("rollback");
                        echo $msg . ' ';
                    } else {
                        if (!$mysqli->query($query)) {
                            echo "Error al guardar articulos de la venta: " . $mysqli->error;
                        } else {
                            $result = $mysqli->query("SELECT @msg as m");
                            $salida = $result->fetch_assoc();
                            $msg = $salida['m'];
                        }
                    }
                }
            }


            if (!empty($detallesConfirmacion)) foreach ($detallesConfirmacion as $key => $detalle) {
                $idtv = $detalle['idtv'];
                $query = "CALL confirm_detalleventa($idtv, @msg)";

                if ($key == 0) {
                    if (!$mysqli->query($query)) {
                        echo "Error al guardar articulos de la venta: " . $mysqli->error;
                    } else {
                        $result = $mysqli->query("SELECT @msg as m");
                        $salida = $result->fetch_assoc();
                        $msg = $salida['m'];
                    }
                } else {
                    if ($msg != 1) {
                        $mysqli->query("rollback");
                        echo $msg . ' ';
                    } else {
                        if (!$mysqli->query($query)) {
                            echo "Error al guardar articulos de la venta: " . $mysqli->error;
                        } else {
                            $result = $mysqli->query("SELECT @msg as m");
                            $salida = $result->fetch_assoc();
                            $msg = $salida['m'];
                        }
                    }
                }
            }
        } else if (!$updateProcess) {
            $mysqli->query("rollback");
        }



        $result = $mysqli->query("SELECT @msg as m");
        $salida = $result->fetch_assoc();
        $msg = $salida['m'];
        if ($msg == 1) $mysqli->query("commit");
        echo $msg;


        break;

    case 'eliminar':
        $idventa = $_POST['idventa'];
        $detalles = json_decode($_POST['detalles'], true);
        $updateProcess = false;


        if (!$mysqli->query("CALL del_venta($idventa, @msg);")) {
            echo "Error al eliminar la venta: " . $mysqli->error;
            $updateProcess = false;
            $mysqli->query("rollback");
        } else $updateProcess = true;

        if (!empty($detalles)) {
            foreach ($detalles as $dtv) {
                if (!$mysqli->query("CALL del_detalleventa($dtv, @msg);")) {
                    echo "Error al anular articulos de la venta: " . $mysqli->error;
                    $updateProcess = false;
                    $mysqli->query("rollback");
                } else {
                    $updateProcess = true;
                }
            }
        }


        $result = $mysqli->query("SELECT @msg as m");
        $salida = $result->fetch_assoc();
        $msg = $salida['m'];
        if ($msg == 1) $mysqli->query("commit");
        echo $msg;


        break;

    case 'eliminarPausada':
        $idventa = $_POST['idventa'];
        $detalles = json_decode($_POST['detalles'], true);
        $updateProcess = false;


        if (!$mysqli->query("CALL del_venta($idventa, @msg);")) {
            echo "Error al eliminar la venta: " . $mysqli->error;
            $updateProcess = false;
            $mysqli->query("rollback");
        } else $updateProcess = true;

        if (!empty($detalles)) {
            foreach ($detalles as $dtv) {
                if (!$mysqli->query("CALL del_detalleventa_pausado($dtv, @msg);")) {
                    echo "Error al anular articulos de la venta: " . $mysqli->error;
                    $updateProcess = false;
                    $mysqli->query("rollback");
                } else {
                    $updateProcess = true;
                }
            }
        }


        $result = $mysqli->query("SELECT @msg as m");
        $salida = $result->fetch_assoc();
        $msg = $salida['m'];
        if ($msg == 1) $mysqli->query("commit");
        echo $msg;


        break;
}
