<?php
    $nombre =  $_SESSION['nombre_usuario'] ;
    $correo = $_SESSION['correo_usuario'] ;
    $rol = $_SESSION['rol'] ;
    $id =  $_SESSION['id'] ;
?>
    <div class="nav-principal">

        <nav>
            <a href="principal.php" class="hover-nav nav">Inicio</a>
            <a class="hover-nav nav" href="listadoAdmin.php">Administradores</a>
            <a class="hover-nav nav" href="listado-productos.php">Productos</a>
            <a class="hover-nav nav" href="listado-usuarios.php">Usuarios</a>
        </nav>
        <div class="sesion-principal">
            <h3 class="" >Hola <span> <?php echo $nombre; ?> </span> </h3>
            <a class="hover-nav nav" href="index.php?cerrar_sesion=true">Cerrar sesión</a>
        </div>

    </div>
