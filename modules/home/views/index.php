<!DOCTYPE html>
<html lang="es">

<?php 
    $tituloPagina = "Inicio |  SMART";
    include '../../include/views/head.php'; 
?>

<body class="inicio-imagen">

    <div>
        <?php include '../../include/views/navbar.php';?>
        <!--Cuerpo-de-Inicio-->
        <div class="center-align">
            <img src="../../../img/bg-home.jpg"  alt="SMART" width="100%" height="100%">
        </div>
        <!--Fin-Cuerpo-de-Inicio-->
        <!--Footer-de-Pagina-->
        <?php include '../../include/views/footer.php';?>
        <!--Fin-Footer-de-Pagina-->
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--JQuery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Google-Charts-CDN-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--Fin-Google-Charts-CDN-->
    <script src="../../../js/animacion.js"></script>
</body>

</html>