<?php
    if(!(isset($_POST['id-user']))){
        header('location: index.php');
    }


    $id_busqueda = (int)$_POST['id-user'];

    include 'inc/funciones/conexion.php';

    if(isset($_GET['alta_usuario'])){
      $stmt = $conn->prepare("SELECT nombre, apellido, correo, archivo, pass FROM usuarios WHERE id = ?");
      $stmt->bind_param('i', $id_busqueda);
      $stmt->execute();

      $stmt->bind_result($nombre_busqueda, $apellido_busqueda, $correo_busqueda, $imagen_busqueda, $pass_busqueda);
    }else{
      $stmt = $conn->prepare("SELECT nombre, apellido, correo, archivo, rol, pass FROM administradores WHERE id = ?");
      $stmt->bind_param('i', $id_busqueda);
      $stmt->execute();

      $stmt->bind_result($nombre_busqueda, $apellido_busqueda, $correo_busqueda, $imagen_busqueda, $rol_busqueda, $pass_busqueda);
    }

    $stmt->fetch();

    if($nombre_busqueda){
        session_start();

        include 'inc/templates/header.php';
        include 'inc/templates/navegacion.php';
    ?>
        <form action="#" id="actualizar" class="card-body form-ec" method="post" enctype= "multipart/form-data" data-user="<?php  echo $_SESSION['id']; ?>">

            <div class="contenedores">
                <label for="nombre"  class="register register-sm">
                    <p>Nombre: </p>
                    <input type="text"  name="nombre" id="nombre" value="<?php echo $nombre_busqueda;?>" >
                </label>

                <label for="apellido" class="register register-sm">
                    <p>Apellido: </p>
                    <input type="text"  name="apellido" id="apellido" value="<?php echo $apellido_busqueda;?>"  >
                </label>
            </div>
            <div class="contenedores">

                <label for="correo" class="register register-sm">
                    <p>Correo: </p>
                    <input type="hidden" id="correo-actual" data-correo_anterior="<?php echo $correo_busqueda;?>">
                    <input type="email"  name="correo" id="correo" value="<?php echo $correo_busqueda;?>"  >
                </label>

                <label for="password" class="register register-sm">
                    <p>Contraseña: </p>
                    <input type="hidden" name="password-old" value="<?php echo $pass_busqueda;?>">
                    <input type="password"  name="password" id="password" value="<?php echo $pass_busqueda;?>" >
                </label>
            </div>
            <div class="contenedores f">
                  <?php
                  if(!isset($_GET['alta_usuario'])){
                  ?>
                    <label for="rol" class="register register-sm">
                     <p>Rol</p>
                        <select name="rol" id="rol" value="<?php $flag =  ($rol_busqueda === 1) ? 'admin' : 'consul';?>" >
                            <option value="">Tipo De Rol</option>
                            <option value="admin" <?php echo ($flag == 'admin') ? 'selected': ''; ?> >Administrar</option>
                            <option value="consul" <?php echo ($flag == 'admin') ? '': 'selected'; ?>>Consultar</option>
                        </select>
                    </label>
                  <?php
                  }
                  ?>
                <label for="archivo" class="register register-sm">
                    <p>Foto de perfil</p>
                    <input type="hidden" name="archivo" value="<?php echo $imagen_busqueda; ?>">
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
                <?php
                  if(isset($_GET['alta_usuario'])){
                ?>
                <div class="">
                  <input type="hidden" id="rol" class="pag_usuario" value="0">
                </div>
                <?php
                  }
                 ?>

                <input type="hidden" name="id-user" value="<?php echo $id_busqueda; ?>">
                <div class="reg-input">

                    <input  id="enviar" class="boton-submit YES " type="submit" value="ACTUALIZAR INFORMACION" >
                </div>
                <div class="reg-input">
                    <input id="cancelar" type="submit" class="boton-submit NOT " value="CANCELAR">
                </div>


            </div>

        </form>

        <div  id ="campoError" class="campoError">
        </div>

        <script src="js/script.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>

    <?php
    }else{
        echo "Error";
    }
?>

</body>
</html>
