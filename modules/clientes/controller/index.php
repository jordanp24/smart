<?php
include("../../../db/conection.php");
$op = $_GET['op'];

switch ($op) {
    case 1:
        if (!empty($_POST)) {
            $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
            $ape = mysqli_real_escape_string($mysqli, $_POST['ape']);
            $dpi = mysqli_real_escape_string($mysqli, $_POST['dpi']);
            $dir = mysqli_real_escape_string($mysqli, $_POST['dir']);
            $cel = mysqli_real_escape_string($mysqli, $_POST['cel']);
            $em = mysqli_real_escape_string($mysqli, $_POST['em']);

            $typed = $_FILES['fodpi']['type'];
            $aleatoriod = rand(10000, 99000);
            $nombrefotod = $_FILES['fodpi']['name'];
            $tmpd = $_FILES['fodpi']['tmp_name'];
            $rutad = "../fotos/" . $aleatoriod . $nombrefotod;

            $typer = $_FILES['fore']['type'];
            $aleatorior = rand(10000, 99000);
            $nombrefotor = $_FILES['fore']['name'];
            $tmpr = $_FILES['fore']['tmp_name'];
            $rutar = "../fotos/" . $aleatorior . $nombrefotor;


            $query = "CALL add_cliente('$nom', '$ape', '$dpi', '$dir', '$cel', '$em', '$rutar', '$rutad', @msg)";
            $mysqli->query("start transaction");
            if (!$mysqli->query($query)) {
                echo "Error al guarda el cliente: " . $mysqli->error;
            } else {
                move_uploaded_file($tmpd, $rutad);
                move_uploaded_file($tmpr, $rutar);
                echo "El cliente fue creado correctamente";
                header("Location: ../views/verClientes.php");
            }
            $mysqli->query("commit");
        }
        break;

    case 2:
        if (!empty($_POST)) {
            $idc = mysqli_real_escape_string($mysqli, $_POST['idc']);
            $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
            $ape = mysqli_real_escape_string($mysqli, $_POST['ape']);
            $dpi = mysqli_real_escape_string($mysqli, $_POST['dpi']);
            $dir = mysqli_real_escape_string($mysqli, $_POST['dir']);
            $cel = mysqli_real_escape_string($mysqli, $_POST['cel']);
            $em = mysqli_real_escape_string($mysqli, $_POST['em']);
            $tmpr = $_FILES['fore']['tmp_name'];
            $tmpd = $_FILES['fodpi']['tmp_name'];

            if (is_uploaded_file($tmpr) && is_uploaded_file($tmpd)) {
                $typer = $_FILES['fore']['type'];
                $aleatorior = rand(10000, 99000);
                $nombrefotor = $_FILES['fore']['name'];
                $rutar = "../fotos/" . $aleatorior . $nombrefotor;
                $resultr = $mysqli->query("select fotorecibo from clientes where idcliente=$idc");
                $urlr = $rowr = mysqli_fetch_array($resultr);

                $typed = $_FILES['fodpi']['type'];
                $aleatoriod = rand(10000, 99000);
                $nombrefotod = $_FILES['fodpi']['name'];
                $rutad = "../fotos/" . $aleatoriod . $nombrefotod;
                $resultd = $mysqli->query("select fotodpi from clientes where idcliente=$idc");
                $urld = $rowd = mysqli_fetch_array($resultd);
            } else if (!is_uploaded_file($tmpr) && is_uploaded_file($tmpd)) {
                $resultr = $mysqli->query("select fotorecibo from clientes where idcliente=$idc");
                $urlr = $rowr = mysqli_fetch_array($resultr);
                $rutar = $urlr['fotorecibo'];

                $typed = $_FILES['fodpi']['type'];
                $aleatoriod = rand(10000, 99000);
                $nombrefotod = $_FILES['fodpi']['name'];
                $rutad = "../fotos/" . $aleatoriod . $nombrefotod;
                $resultd = $mysqli->query("select fotodpi from clientes where idcliente=$idc");
                $urld = $rowd = mysqli_fetch_array($resultd);
            } else if (is_uploaded_file($tmpr) && !is_uploaded_file($tmpd)) {
                $typer = $_FILES['fore']['type'];
                $aleatorior = rand(10000, 99000);
                $nombrefotor = $_FILES['fore']['name'];
                $rutar = "../fotos/" . $aleatorior . $nombrefotor;
                $resultr = $mysqli->query("select fotorecibo from clientes where idcliente=$idc");
                $urlr = $rowr = mysqli_fetch_array($resultr);

                $resultd = $mysqli->query("select fotodpi from clientes where idcliente=$idc");
                $urld = $rowd = mysqli_fetch_array($resultd);
                $rutad = $urld['fotodpi'];
            }

            $query = "CALL up_clientes($idc, '$nom', '$ape', '$dpi', '$dir', '$cel', '$em', '$rutar', '$rutad', @msg)";
            $mysqli->query("start transaction");
            if (!$mysqli->query($query)) {
                $mysqli->query("rollback");
                echo "Error al guarda el cliente: " . $mysqli->error;
            } else {
                $result = $mysqli->query("SELECT @msg as m");
                $salida = $result->fetch_assoc();
                $msg = $salida['m'];

                if ($msg == 1) {
                    if (!is_uploaded_file($tmpr) && is_uploaded_file($tmpd)) {
                        unlink($urld['fotodpi']);
                        move_uploaded_file($tmpd, $rutad);
                    }
                    if (is_uploaded_file($tmpr) && !is_uploaded_file($tmpd)) {
                        move_uploaded_file($tmpr, $rutar);
                        unlink($urlr['fotorecibo']);
                    } else if (is_uploaded_file($tmpr) && is_uploaded_file($tmpd)) {
                        unlink($urld['fotodpi']);
                        move_uploaded_file($tmpd, $rutad);
                        move_uploaded_file($tmpr, $rutar);
                        unlink($urlr['fotorecibo']);
                    }
                    echo "El cliente fue creado correctamente";
                    header("Location: ../views/verClientes.php");
                } else if ($msg == 0) {
                    echo "Error al guarda el cliente: Ya existe un cliente con DPI: $nit";
                }
            }
            $mysqli->query("commit");
        }
        break;


    case 3:
        $cliente = json_decode($_POST['valores'], true);
        $id = $cliente['id'];

        $mysqli->query("start transaction");

        if (!$mysqli->query("CALL del_clientes($id, @msg);")) {
            echo "Error al eliminar el cliente: " . $mysqli->error;
        } else {
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];

            if ($msg == 1) {
                echo $msg;
            } else if ($msg == 0) {
                echo $msg;
            }
        }

        $mysqli->query("commit");
        break;

    case 'buscarCliente':
        $rawdata = array();
        $dpi = $_GET["dpi"];
        $mysqli->query("start transaction");
        $query = "SELECT c.idcliente AS id, CONCAT(c.nombres,' ',c.apellidos) AS nombre FROM clientes c WHERE c.dpi = $dpi;";
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $rawdata = array('nombre' => $row['nombre'], 'dpi' => $dpi, 'id' => $row['id']);
        } 
        
        echo json_encode($rawdata);
        $result->close();
        $mysqli->query("commit");
        // echo "cliente: $dpi";
        break;
    case 'telefonos';
    $rawdata = array();
    $id = $_GET["id"];
    $mysqli->query("start transaction");
    $query = "SELECT id, numero from telefono WHERE direccion = $id;";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
        $rawdata[] = $row;
    }
    
    echo json_encode($rawdata);
    $result->close();
    $mysqli->query("commit");
    break;
}
