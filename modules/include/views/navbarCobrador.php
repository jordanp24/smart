<?php
$firstname = "<script>document.write(sessionStorage.getItem('firstname'))</script>";

$lastname = "<script>document.write(sessionStorage.getItem('lastname'))</script>";

$user = "<script>document.write(sessionStorage.getItem('user'))</script>";
?>
<div class="navbar-fixed">
    <nav class="indigo darken-4">
        <div class="containerNav">
            <div>
                <div class="nav-wrapper">
                    <div class="espacio" style="width: 100px;">
                        <a href="../../home/views/" class="brand-logo waves-effect waves-light negrita">
                            <img src="../../../img/logo.png" style="border-radius: 6%;" width="80px">
                        </a>
                    </div>
                    <a href="#" data-target="menu-responsive" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">

                        <!--Primera-Opcion-de-Web-menu-desplegable-Dashboard-->
                        <li class="waves-effect waves-light"><a href="../../home/views/">Inicio<i class="material-icons left">home</i></a></li>
                        <!--Fin-Primera-Opcion-de-Web-menu-desplegable-Dashboard-->

                        <!-- <li><a class="waves-effect waves-light" href="../../reportes/views/" data-target="dropdown4">Reportes<i class="material-icons left">assignment</i></a></li> -->

                        <!--Segunda-Opcion-de-Web-menu-desplegable-Productos-->
                        <!-- <li class=" "><a class="dropdown-trigger" href="#" data-target="dropdown1">Artículos<i class="material-icons left">add_shopping_cart</i></a></li>
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="../../articulos/views/" class="indigo-text text-darken-2">Ver Artículos<i class="material-icons left">visibility</i></a></li>
                            <li><a href="../../articulos/views/agregar.php" class="indigo-text text-darken-2">Agregar
                                    Artículos<i class="material-icons left">add</i></a></li>
                        </ul> -->
                        <!--Fin-Segunda-Opcion-de-Web-menu-desplegable-Productos-->

                        <!--Segunda-Opcion-de-Web-menu-desplegable-Productos-->
                        <li class=" "><a class="dropdown-trigger" href="#" data-target="dropdownV">Ventas<i class="material-icons left">local_atm</i></a></li>
                        <ul id='dropdownV' class='dropdown-content'>
                            <!-- <li><a href="../../ventas/views/ventas.php" class="indigo-text text-darken-2">Ver Ventas<i class="material-icons left">visibility</i></a></li> -->
                            <li><a href="../../ventas/views/" class="indigo-text text-darken-2">Agregar Ventas<i class="material-icons left">add</i></a></li>
                            <li><a href="../../ventas/views/ventas-pausadas.php" class="indigo-text text-darken-2">Ver Ventas Pausadas<i class="material-icons left">assignment</i></a></li>
                            <!-- <li><a target="_blank" href="../../ventas/views/rptCierre.php" class="indigo-text text-darken-2">Generar Cierre<i class="material-icons left">attach_money</i></a></li> -->
                        </ul>
                        <!--Fin-Segunda-Opcion-de-Web-menu-desplegable-Productos-->

                        <!--Tercera-Opcion-de-Web-menu-desplegable-Cotizacion-->
                        <!-- <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Abonos<i class="material-icons left">receipt_long</i></a></li>
                        <ul id='dropdown2' class='dropdown-content'>
                            <li><a href="../../abonos/views/" class="indigo-text text-darken-2">Ver Abonoss<i class="material-icons left">visibility</i></a></li>
                            <li><a href="../../abonos/views/agregar.php" class="indigo-text text-darken-2">Agregar Abonos<i class="material-icons left">add</i></a></li>
                        </ul> -->
                        <!--Fin-Tercera-Opcion-de-Web-menu-desplegable-Cotizacion-->

                        <!--Cuarta-Opcion-de-Web-menu-desplegable-Clientes-->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown3">Clientes<i class="material-icons left">groups</i></a></li>
                        <ul id='dropdown3' class='dropdown-content'>
                            <li><a href="../../clientes/views/verClientes.php" class="indigo-text text-darken-2">Ver Clientes<i class="material-icons left">visibility</i></a></li>
                            <li><a href="../../clientes/views/agregarCliente.php" class="indigo-text text-darken-2">Agregar
                                    Clientes<i class="material-icons left">add</i></a></li>
                        </ul>
                        <!--Fin-Cuarta-Opcion-de-Web-menu-desplegable-Clientes-->

                        <!--Quinta-Opcion-de-Web-menu-desplegable-Usuarios-->
                        <!-- <li><a class="dropdown-trigger" href="#!" data-target="dropdown4">Usuarios<i class="material-icons left">manage_accounts</i></a></li>
                        <ul id='dropdown4' class='dropdown-content'>
                            <li><a href="../../usuarios/views/" class="indigo-text text-darken-2">Ver Usuarios<i class="material-icons left">visibility</i></a></li>
                            <li><a href="../../usuarios/views/agregarUsuario.php" class="indigo-text text-darken-2">Agregar Usuarios<i class="material-icons left">add</i></a></li>
                        </ul> -->
                        <!--Fin-Quinta-Opcion-de-Web-menu-desplegable-Usuarios-->


                        <!--Sexta-Opcion-de-Web-menu-desplegable-Perfil-->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown5"><?php echo $firstname . ' ' . $lastname; ?><i class="material-icons left">account_circle</i></a></li>
                        <ul id='dropdown5' class='dropdown-content'>

                            <!--Disparador-de-diálogo-modal-->
                            <li><a href="#modalcerrarsession" class="indigo-text text-darken-2 modal-trigger">Cerrar Sesión<i class="material-icons left">logout</i></a></li>
                            <!--Fin-Disparador-de-diálogo-modal-->

                            <!--Fin-Sexta-Opcion-de-Web-menu-desplegable-Perfil-->
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<!--Fin-Barra-de-navegacion-->

<!--estructura-de-diálogo-modal-->
<div id="modalcerrarsession" class="modal grey lighten-4">
    <div class="modal-content">
        <h2 class="titulo-1 center-align">¿Estás seguro de que quieres cerrar la sesión?</h2>
    </div>
    <div class="modal-footer grey lighten-4">
        <a href="../../usuarios/controller/?op=3" class="modal-close waves-effect waves-light btn-small indigo darken-4 negrita">Aceptar<i class="material-icons right">send</i></a>
        <a href="#!" class="modal-close waves-effect waves-light btn-small white indigo-text text-darken-3 negrita">Cancelar<i class="material-icons right">backspace</i></a>
    </div>
</div>
<!--fin-estructura-de-diálogo-modal-->

<!--Menu-Desplegable-para-vista-mobile-todas-las-opciones-->
<ul class="sidenav" id="menu-responsive">
    <li class="indigo darken-4 white-text">
        <div class="user-view">
            <a class="sidenav-close right" href="#"><i class="material-icons white-text">close</i></a>
            <a href="#"><i class="material-icons medium circle white-text">account_circle</i></a>
            <a href="#"><span class="white-text negrita name"><?php echo $firstname . ' ' . $lastname; ?></span></a>
            <a href="#"><span class="white-text email"><?php echo $user; ?></span></a>
        </div>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <!-- <li>
                    <div class="divider"></div>
                </li> -->

            <!--Primer-Opcion-en-Menu-Responsiva-Dashboard-->
            <li>
                <a class="waves-effect waves-light collapsible-header" href="../../home/views/">Inicio<i class="material-icons left">home</i></a>
            </li>
            <!--Fin-Primer-Opcion-en-Menu-Responsiva-Dashboard-->
            <!-- <li>
                <div class="divider"></div>
            </li> -->

            <!--P rimer-Opcion-en-Menu-Responsiva-Dashboard-->
            <!-- <li>
                <a class="waves-effect waves-light collapsible-header" href="../../reportes/views/">Reportes<i class="material-icons left">assignment</i></a>
            </li> -->
            <!--Fin-Primer-Opcion-en-Menu-Responsiva-Dashboard-->



            <li>
                <div class="divider"></div>
            </li>

            <!--Segunda-Opcion-en-Menu-Responsiva-Dashboard-->
            <!-- <li>
                <a class="collapsible-header waves-effect waves-light">Artículos<i class="material-icons left">add_shopping_cart</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="../../articulos/views/">Ver Artículos<i class="material-icons left">visibility</i></a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="../../articulos/views/agregar.php">Agregar Artículos<i class="material-icons left">add</i></a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <!--Fin-Segunda-Opcion-en-Menu-Responsiva-Dashboard-->

            <!-- <li>
                <div class="divider"></div>
            </li> -->

            <!--Tercera-Opcion-en-Menu-Responsiva-Dashboard-->
            <li>
                <a class="collapsible-header waves-effect waves-light">Ventas<i class="material-icons left">local_atm</i></a>
                <div class="collapsible-body">
                    <ul>
                        <!-- <li><a href="../../ventas/views/">Ver Ventas<i class="material-icons left">visibility</i></a></li>
                        <li>
                            <div class="divider"></div>
                        </li> -->
                        <!-- <li><a href="../../abonos/views/agregar.php">Nueva Operacion<i class="material-icons left">add</i></a></li> -->
                        <li><a href="../../ventas/views/">Agregar Ventas<i class="material-icons left">add</i></a></li>
                        <!-- <li><a target="blank" href="../../ventas/views/rptCierre.php">Generar Cierre<i class="material-icons left">attach_money</i></a></li> -->
                    </ul>
                </div>
            </li>
            <!--Fin-Tercera-Opcion-en-Menu-Responsiva-Dashboard-->

            <li>
                <div class="divider"></div>
            </li>

            <!--Cuarta-Opcion-en-Menu-Responsiva-Dashboard-->
            <li>
                <a class="collapsible-header waves-effect waves-light">Clientes<i class="material-icons left">groups</i></a>
                <div class="collapsible-body">
                    <ul>

                        <li><a href="../../clientes/views/verClientes.php">Ver Clientes<i class="material-icons left">visibility</i></a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="../../clientes/views/agregarCliente.php">Agregar Clientes<i class="material-icons left">add</i></a></li>
                    </ul>
                </div>
            </li>
            <!--Fin-Cuarta-Opcion-en-Menu-Responsiva-Dashboard-->

            <li>
                <div class="divider"></div>
            </li>

            <!--Quita-Opcion-en-Menu-Responsiva-Dashboard-->
            <!-- <li>
                <a class="collapsible-header waves-effect waves-light">Usuarios<i class="material-icons left">manage_accounts</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="../../usuarios/views/">Ver Usuarios<i class="material-icons left">visibility</i></a></li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li><a href="../../usuarios/views/agregarUsuario.php">Agregar Usuarios<i class="material-icons left">add</i></a></li>
                    </ul>
                </div>
            </li> -->
            <!--Quinta-Fin-Cuarta-Opcion-en-Menu-Responsiva-Dashboard-->
            <!-- <li>
                <div class="divider"></div>
            </li> -->

            <!--Sexta-Opcion-en-Menu-Responsiva-Dashboard-->
            <li>
                <a class="waves-effect waves-light collapsible-header modal-trigger" href="#modalcerrarsession"><i class="material-icons left">logout</i>Cerrar Sesión</a>
            </li>
            <!--Fin-Sexta-Opcion-en-Menu-Responsiva-Dashboard-->
        </ul>
    </li>

    <li>
        <div class="divider"></div>
    </li>

</ul>

<!--Fin-Menu-Desplegable-para-vista-mobile-todas-las-opciones-->