<?php 
    
    include "inc/funciones/list_admin.php";
    include "inc/templates/header.php";
/*
    echo "<pre>";
        
        foreach($respuesta as $administrador){
            var_dump($administrador);   
        }
    echo "</pre>";
*/
?>

    <div class="contenedor">
        <div class="administradores-table">
            <div class="">
                <input type="submit" id="alta-admin" class="btn-alta" value="ALTA ADMINISTRADOR">
            </div>
            <div class="head-admin">
                <h2>Administradores</h2>
            </div>
            <div class="body-admin">
                <?php foreach($respuesta as $administrador){ ?>
                    <div class="admin" id="<?php echo $administrador['id']; ?>">
                        <img class="img-admin" src="archivos/<?php echo $administrador['archivo'];?>" alt="foto usuario">
                        <p class="nombre">
                            <?php echo  $administrador['nombre'] . " " . $administrador['apellido']; ?>
                        </p>

                        <p>
                            <?php echo $administrador['correo']; ?>
                        </p>
                        <img  src="img/trash.svg" class="icono eliminar" alt="imagen basura">
                    </div> 
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="js/admin-scripts.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>