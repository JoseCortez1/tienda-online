<?php
    include "inc/funciones/sesiones.php";
    include "inc/funciones/list.php";
    $respuesta = obtenerUsuarios();
    include "inc/templates/header.php";
/*
    echo "<pre>";

        foreach($respuesta as $administrador){
            var_dump($administrador);
        }
    echo "</pre>";
*/
?>
    <header id="usuario_logeado:<?php echo $_SESSION['id'];?>" class="usuarioLog">
    <?php
            include 'inc/templates/navegacion.php';
        ?>
    </header>
    <div class="contenedor-md">
        <div class="administradores-table">
            <div class="btn-listaAdmin reg-input">
                <input type="submit" id="alta-admin" class="btn-alta pag_usuario" value="ALTA USUARIO">
            </div>
            <div class="head-admin">
                <h2>Usuarios: <?php echo $respuesta->num_rows; ?></h2>
            </div>
            <div class="body-admin">
                <?php foreach($respuesta as $usuario){ ?>
                    <form action="#"  method="post" class="form-admin">
                        <div class="admin" id="<?php echo $usuario['id']; ?>">
                            <img class="img-admin consultar-info" src="archivos/<?php echo $usuario['archivo'];?>" alt="foto usuario">
                            <p class="nombre">
                                <?php echo  $usuario['nombre'] . " " . $usuario['apellido']; ?>
                            </p>

                            <p>
                                <?php echo $usuario['correo']; ?>
                            </p>
                            <div class="iconos">
                                <?php
                                    if( $_SESSION['id'] == $usuario['id']){
                                        $bandera = true;
                                    }
                                    else{
                                        $bandera = false;
                                    }
                                ?>
                                <img  src="img/eye-regular.svg" class="icono vista" alt="imagen vista">
                                <img  src="img/vista.svg" class="icono editar" alt="imagen editar">
                                <img  src="img/trash.svg"
                                    class="icono eliminar
                                        <?php echo ($bandera) ? 'desactivado' : ''; ?>"
                                        <?php echo ($bandera) ? 'disable' : '';
                                    ?>
                                    alt="imagen basura">
                                <input type="hidden"  name="id-user" value="<?php echo $usuario['id']; ?>">

                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="js/admin-scripts.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>
