<?php
    include 'conexion.php';


    $file_name = $_FILES['imagen_archivo']['name'];    // Nombre real del Archivo
    $file_tmp  = $_FILES['imagen_archivo']['tmp_name'];// Nombre temporal del archivo
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    
    //hashear el password(Aumenta la seguridad en la contraseña guardad);

    $opciones = [
        'cost'=>12, 
    ];
    $passHash = password_hash($password,PASSWORD_BCRYPT,$opciones);



    $rol = $_POST['rol'];
    if($rol == 'admin'){
        $tipoUser = 1;
    }else{
        $tipoUser = 2;
    }

    
    $cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
    $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
    $dir = "../../archivos/";                         // Carpeta donde se guardan los archivos
    $file_enc = md5_file($file_tmp);
    if(isset($file_name)){
        $newNAme = $file_enc.'.'.$ext  ;            //Ponemos el nuevo nombre al archivo enc
        copy($file_tmp, $dir.$newNAme);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
    }
   
   



    $sql = " INSERT INTO administradores(nombre, apellido, correo, pass, archivo_n, archivo, rol) VALUES (?,?,?,?,?,?,?) ";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $apellido, $correo, $passHash,  $file_enc, $newNAme, $tipoUSer);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        header('Location: ../../listadoAdmin.php');
    } catch (Exception $e) {
       echo $e->getMessage();
      
    }
    ?>