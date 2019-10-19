
<?php 
    if(!(isset($_POST['id-user']))){
        header('location: index.php');
    }
    
    
    $id = (int)$_POST['id-user'];
    include 'inc/funciones/conexion.php';
    $stmt = $conn->prepare("SELECT nombre, apellido, correo, archivo, rol, pass FROM administradores WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($nombre, $apellido, $correo, $imagen, $rol, $pass);
    $stmt->fetch();

    if($nombre){
        include 'inc/templates/header.php';    
    ?>
        <div class="contenedor-big card-body grid-2 c-info" >
            <img src="archivos/<?php echo $imagen ?>" alt="Imagen User" class="cuadro">
            <div class="informacion">
                
                <div class="personal">
                    <h3><?php echo $nombre . " " . $apellido; ?></h3>
                    <h4><?php echo ($rol === 1) ? "Administrador" : "Consultor"; ?></h4>
                </div>

                
                <div class="extras">
                    <h4>Correo: <?php echo $correo; ?></h4>
                    <h4>Contraseña enc: <?php echo $pass; ?></h4>
                </div>

                <div class="register-btn crear-cuenta c.info">
                    <a href="listadoAdmin.php" id="" >Regresar</a> 
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
