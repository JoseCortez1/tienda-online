<?php 
    include 'inc/funciones/sesiones.php';
    include 'inc/templates/header.php';
    
    $nombre =  $_SESSION['nombre_usuario'] ;
    $correo = $_SESSION['correo_usuario'] ;
    $rol = $_SESSION['rol'] ;
    $id =  $_SESSION['id'] ;
?>


    <div class="contenedor-principal">
        <header class="nav-principal">
            
            <nav>
                <a class="hover-nav nav" href="listadoAdmin.php">Administradores</a>
                <a class="hover-nav nav" href="#">Menu#</a>
                <a class="hover-nav nav" href="#">Menu#</a>
                <a class="hover-nav nav" href="#">Menu#</a>
                <a class="hover-nav nav" href="#">Menu#</a>
            </nav>
            <div class="sesion-principal">
                <h3 class="" >Hola <span> <?php echo $nombre; ?> </span> </h3>
                <a class="hover-nav nav" href="index.php?cerrar_sesion=true">Cerrar sesión</a>
            </div>

        </header>

        <main class="contenedor-big">
            <h2>Bienvenido</h2>
        </main>

    </div>
</body>
</html>