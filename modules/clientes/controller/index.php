<?php
include("../../../db/conection.php");
$op = $_GET['op'];

switch ($op) {
    case 1:
        if (!empty($_POST)) {
            $cliente = json_decode($_POST['cliente'], true);

            $nom = mysqli_real_escape_string($mysqli, $cliente['nom']);
            $ape = mysqli_real_escape_string($mysqli, $cliente['ape']);
            $ser = mysqli_real_escape_string($mysqli, $cliente['ser']);
            $tip = mysqli_real_escape_string($mysqli, $cliente['tip']);

            $mysqli->query("start transaction");
            $query = "CALL add_cliente('$nom', '$ape', '$ser', '$tip', @msg)";
            if (!$mysqli->query($query)) {
                echo "Error al guarda el cliente: " . $mysqli->error;
            }
            $mysqli->query("commit");
        }
        break;

    case 2:
        if (!empty($_POST)) {
            $cliente = json_decode($_POST['cliente'], true);

            $id = mysqli_real_escape_string($mysqli, $cliente['id']);
            $nom = mysqli_real_escape_string($mysqli, $cliente['nom']);
            $ape = mysqli_real_escape_string($mysqli, $cliente['ape']);
            $ser = mysqli_real_escape_string($mysqli, $cliente['ser']);
            $tip = mysqli_real_escape_string($mysqli, $cliente['tip']);

            $query = "CALL up_cliente($id, '$nom', '$ape', '$ser', '$tip', @msg)";
            if (!$mysqli->query($query)) {
                echo "Error al actualizar el cliente: " . $mysqli->error;
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
        while ($row = $result->fetch_assoc()) {
            $rawdata[] = $row;
        }

        echo json_encode($rawdata);
        $result->close();
        $mysqli->query("commit");
        break;
}
