
<?php
    session_start();
    if(!(isset($_POST['id-user']))){
        header('location: index.php');
    }


    $id = (int)$_POST['id-user'];
    include 'inc/funciones/conexion.php';

    if(isset($_GET['alta_usuario'])){
      $stmt = $conn->prepare("SELECT nombre, apellido, correo, archivo FROM usuarios WHERE id = ?");
    }else{
      $stmt = $conn->prepare("SELECT nombre, apellido, correo, archivo, rol FROM administradores WHERE id = ?");
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    if(isset($_GET['alta_usuario'])){
      $stmt->bind_result($nombre_info, $apellido_info, $correo_info, $imagen_info);
    }else{
      $stmt->bind_result($nombre_info, $apellido_info, $correo_info, $imagen_info, $rol_info);
    }

    $stmt->fetch();

    if($nombre_info){
        include 'inc/templates/header.php';
        include 'inc/templates/navegacion.php';
    ?>
        <div class="info-contacto__div" >
            <img src="archivos/<?php echo $imagen_info ?>" alt="Imagen User" class="info-contacto__img">
            <div class="">

                <div class="info-contacto-datos__div">
                    <h3><?php echo $nombre_info . " " . $apellido_info; ?></h3>

                    <p><?php
                      if(!isset($_GET['alta_usuario'])){
                        echo ($rol_info === 1) ? "Administrador" : "Consultor";
                      }
                     ?></p>
                </div>


                <div class="">
                    <p>Correo: <?php echo $correo_info; ?></p>
                </div>

                <div class="info-button-back__cont">
                    <a href="listado-usuarios.php" id="" >Regresar</a>
                </div>
            </div>
        </div>
    <?php
    }else{
        echo "Error";
    }
?>

</body>
</html>
