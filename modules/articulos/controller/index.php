<?php
include("../../../db/conection.php");
$op = $_GET['op'];

switch ($op) {
    case 'agregar':
        $cod = mysqli_real_escape_string($mysqli, $_POST['cod']);
        $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
        $des = mysqli_real_escape_string($mysqli, $_POST['des']);
        $pre = mysqli_real_escape_string($mysqli, $_POST['pre']);
        $preco = mysqli_real_escape_string($mysqli, $_POST['preco']);
        $us = mysqli_real_escape_string($mysqli, $_POST['idu']);

        $tmp = $_FILES['imgart']['tmp_name'];
        if (is_uploaded_file($tmp)) {
            $typed = $_FILES['imgart']['type'];
            $aleatorio = rand(10000, 99000);
            $nombrefoto = $_FILES['imgart']['name'];
            $ruta = "../fotos/" . $aleatorio . $nombrefoto;
        } else $ruta = "";


        $mysqli->query("start transaction");

        $query = "CALL add_articulo('$cod', '$nom', '$des', $pre, $preco, '$ruta', $us, @msg)";
        
        if (!$mysqli->query($query)) {
            echo utf8_encode("Error al guarda el artículo: ") . $mysqli->error;
        } else {
            if (is_uploaded_file($tmp)) {
                move_uploaded_file($tmp, $ruta);
            }

            $resultMaxArticulo = $mysqli->query("SELECT MAX(idarticulo) as articulo from articulo");
            $art = $resultMaxArticulo->fetch_assoc();
            $articulo = $art['articulo'];


            header("Location: ../views/existencia.php?cod=$articulo");
        }

        $mysqli->query("commit");
        break;

    case 'editar':
        $cod = mysqli_real_escape_string($mysqli, $_POST['cod']);
        $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
        $des = mysqli_real_escape_string($mysqli, $_POST['des']);
        $pre = mysqli_real_escape_string($mysqli, $_POST['pre']);
        $preco = mysqli_real_escape_string($mysqli, $_POST['preco']);
        $id = mysqli_real_escape_string($mysqli, $_POST['id']);;

        $tmp = $_FILES['imgart']['tmp_name'];

        $mysqli->query("start transaction");

        if (is_uploaded_file($tmp)) {
            $typed = $_FILES['imgart']['type'];
            $aleatorio = rand(10000, 99000);
            $nombrefoto = $_FILES['imgart']['name'];
            $tmp = $_FILES['imgart']['tmp_name'];
            $ruta = "../fotos/" . $aleatorio . $nombrefoto;

            $result = $mysqli->query("select imagen from articulo where idarticulo=$id");
            $url = $row = mysqli_fetch_array($result);
        } else {
            $result = $mysqli->query("select imagen from articulo where idarticulo=$id");
            $url = $row = mysqli_fetch_array($result);

            $ruta = $url['imagen'];
        }

        $query = "CALL up_articulo($id, '$cod', '$nom', '$des', $pre, $preco, '$ruta', @msg)";
        if (!$mysqli->query($query)) {
            echo "Error al guarda el articulo: " . $mysqli->error;
        } else {
            if (is_uploaded_file($tmp)) {
                move_uploaded_file($tmp, $ruta);
                if ($url['imagen']) unlink($url['imagen']);
            }

            header("Location: ../views/");
        }

        $mysqli->query("commit");
        break;


    case 'eliminar':
        $articulo = json_decode($_POST['valores'], true);
        $id = $articulo['id'];

        $mysqli->query("start transaction");

        if (!$mysqli->query("CALL del_articulo($id, @msg);")) {
            echo "Error al eliminar el articulo: " . $mysqli->error;
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

    case 'buscar':
        $rawdata = array();
        $nombre = $_GET["nombre"];
        $mysqli->query("start transaction");
        $query = "SELECT a.* FROM articulo a WHERE a.nombre = '$nombre'";
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $rawdata = array('nombre' => $row['nombre'], 'codigo' => $row['codigo'], 'id' => $row['idarticulo']);
        }

        echo json_encode($rawdata);
        $result->close();
        $mysqli->query("commit");
        // echo "cliente: $dpi";
        break;

    case 'buscarEdit':
        $rawdata = array();
        $nombre = $_GET["nombre"];
        $id = $_GET["id"];
        $mysqli->query("start transaction");
        $query = "SELECT a.* FROM articulo a WHERE a.nombre = '$nombre' AND a.idarticulo != $id";
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $rawdata = array('nombre' => $row['nombre'], 'codigo' => $row['codigo'], 'id' => $row['idarticulo']);
        }

        echo json_encode($rawdata);
        $result->close();
        $mysqli->query("commit");
        // echo "cliente: $dpi";
        break;

    case 'existencia':
        $existencia = $_POST['existencia'];
        $articulo = $_POST['articulo'];
        $mysqli->query("start transaction");
        $query = "UPDATE articulo SET existencia = $existencia  WHERE idarticulo = $articulo";
        // echo $query;
        $mysqli->query($query);
        $mysqli->query("commit");
        $mysqli->close();
        echo 1;
        break;
}
