<?php 
    include "inc/funciones/sesiones.php";
    include "inc/funciones/list.php";
    $respuesta = obtenerAdministradores();
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
                
                <input type="submit" id="alta-admin" class="btn-alta" value="ALTA ADMINISTRADOR">
            </div>
            <div class="head-admin">
                <h2>Administradores: <?php echo $respuesta->num_rows; ?></h2>
            </div>
            <div class="body-admin">
                <?php foreach($respuesta as $administrador){ ?>
                    <form action="#"  method="post" class="form-admin">
                        <div class="admin" id="<?php echo $administrador['id']; ?>">
                            <img class="img-admin consultar-info" src="archivos/<?php echo $administrador['archivo'];?>" alt="foto usuario">
                            <p class="nombre">
                                <?php echo  $administrador['nombre'] . " " . $administrador['apellido']; ?>
                            </p>
    
                            <p>
                                <?php echo $administrador['correo']; ?>
                            </p>
                            <div class="iconos">
                                <?php 
                                    if( $_SESSION['id'] == $administrador['id']){
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
                                <input type="hidden"  name="id-user" value="<?php echo $administrador['id']; ?>">
                               
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