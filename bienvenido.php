<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Bienvenido</title>
</head>
<body class="bg-red">
<?php
    $file_name = $_FILES['imagen_archivo']['name'];    // Nombre real del Archivo
    $file_tmp  = $_FILES['imagen_archivo']['tmp_name'];// Nombre temporal del archivo
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
    $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
    $dir = "archivos/";                         // Carpeta donde se guardan los archivos
    $file_enc = md5_file($file_tmp);

    if ($file_name != '') {                     // Verifica que exista el archivo

        @copy($file_tmp, $dir.$file_name);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
    }
    
    ?>
    <main class="tarjeta">
        <div class="rol">
            <h2><?php echo ($_POST['rol'] === 'consul') ? "consultar" : "administrar"; ?></h2>
        </div>
        <div class="top">
            <div class="imagen">
                <img src="<?php echo "$dir$file_name"; ?>" alt="Imagen de credencial">
            </div>
            <div class="datos">
                <p> <span> Nombre: </span> <?php echo $_POST['nombre'] . " " . $_POST['apellido'];?> </p>

                <p> <span> Correo: </span> <?php echo $_POST['correo']; ?></p>
                <p> <span> Contraseña: </span> <?php echo $_POST['password']; ?></p>
            </div>
        </div>

        <div class="bottom">
            <div class="datos">
                <p> <span> Contraseña encriptada MD5: </span> <?php echo  md5($_POST['password']); ?></p>
                <p> <span> nombre imagen:  </span> <?php echo $file_name; ?></p>
                <p> <span> direccion y nombre de la imagen:  </span> <?php echo $file_tmp; ?></p>
                <p> <span> imagen encriptada MD5:  </span> <?php echo $file_enc; ?></p>
                <p> <span> extension:  </span> <?php echo $ext; ?></p>
                <p> <span> Direccion de la imagen: </span>
                    <a href="<?php echo "./archivos/$file_name1 "; ?> "> 
                    <?php echo $file_name; ?> </a> 
                </p>
            </div>
        </div>

    </main>
</body>
</html>