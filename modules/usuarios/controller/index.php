<?php
include("../../../db/conection.php");
$op = $_GET['op'];

switch ($op) {
    case 1:
        $login = json_decode($_POST['login'], true);

        $name = $login['user'];
        $pass = $login['pass'];

        // echo "nombre: ".$name.", pass: ".$pass;

        $mysqli->query("start transaction");
        $stmt = $mysqli->prepare("SELECT id, tipousuario, nombres, apellidos, usuario FROM usuario WHERE usuario = ? AND contrasena = ?");
        //$stmt = $mysqli->prepare("insert into users(name, pass) values (?,?)");
        $stmt->bind_param('ss', $name, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->num_rows;

        if ($row) {
            if ($row > 0) {
                $data = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['idu'] = $data['id'];
                $_SESSION['rol'] = $data['tipousuario'];
                $_SESSION['firstname'] = $data['nombres'];
                $_SESSION['lastname'] = $data['apellidos'];
                $_SESSION['user'] = $data['usuario'];
                $rawdata = $_SESSION;
                echo json_encode($rawdata);
            }
        }
        $mysqli->query("commit");
        break;

    case 2:
        $user = json_decode($_POST['valores'], true);

        $nom = $user['nom'];
        $ape = $user['ape'];
        $usu = $user['usu'];
        $con = $user['con'];
        $rol = $user['rol'];

        $mysqli->query("start transaction");
        if (!$mysqli->query("CALL add_usuario($rol, '$nom', '$ape', '$usu', '$con', @msg);")) {
            echo "Error al crear el usuario: " . $mysqli->error;
        } else {
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];

            if ($msg == 1) {
                echo $msg;
            } else if ($msg == 0) {
                echo "Error al crear el usuario: Ya fue creado con anterioridad.";
            }
        }
        $mysqli->query("commit");
        break;


    case 3:
        session_start();
        // remove all session variables
        session_unset();

        // destroy the session 
        session_destroy();
        header("Location: ../../login/views/logoutExito.php");
        break;


    case 4:
        $user = json_decode($_POST['valores'], true);

        $nom = $user['nom'];
        $ape = $user['ape'];
        $usu = $user['usu'];
        $con = $user['con'];
        $rol = $user['rol'];
        $id = $user['id'];

        $mysqli->query("start transaction");
        if (!$mysqli->query("CALL up_usuario($id, $rol, '$nom', '$ape', '$usu', '$con', @msg);")) {
            echo "Error al actualizar el usuario: " . $mysqli->error;
        } else {
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];

            if ($msg == 1) {
                echo $msg;
            } else if ($msg == 0) {
                echo "Error al actualizar el usuario.";
            }
        }
        $mysqli->query("commit");
        break;

    case 5:
        $user = json_decode($_POST['valores'], true);


        $id = $user['id'];

        $mysqli->query("start transaction");
        if (!$mysqli->query("CALL del_usuario($id, @msg)")) {
            echo "Error al elminar el usuario: " . $mysqli->error;
        } else {
            $result = $mysqli->query("SELECT @msg as m");
            $salida = $result->fetch_assoc();
            $msg = $salida['m'];

            if ($msg == 1) {
                echo $msg;
            } else if ($msg == 0) {
                echo "Error al elminar el usuario.";
            }
        }
        $mysqli->query("commit");
        break;
}
