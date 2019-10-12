<?php
    if(!(isset($_POST['id-user']))){
        header('location: index.php');
    }
    include 'conexion.php';

    echo '<pre>';
    var_dump($_FILES);
    var_dump($_POST);
    echo '</pre>';
    $file_name = $_FILES['imagen_archivo']['name'];    // Nombre real del Archivo
    $file_tmp  = $_FILES['imagen_archivo']['tmp_name'];// Nombre temporal del archivo
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $id = (int)$_POST['id-user'];
    
    //hashear el password(Aumenta la seguridad en la contraseña guardad);

    if(strlen($password) != 60){

        $opciones = [
            'cost'=>12, 
        ];
        $passHash = password_hash($password,PASSWORD_BCRYPT,$opciones);
    
    }else{
        $passHash = $password;
    }

    $rol = $_POST['rol'];
    if($rol == 'admin'){
        $tipoUser = 1;
    }else{
        $tipoUser = 2;
    }

    if($file_name != ''){
        $cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
        $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
        $dir = "../../archivos/";                         // Carpeta donde se guardan los archivos
        $file_enc = md5_file($file_tmp);
        if(isset($file_name)){
            $newNAme = $file_enc.'.'.$ext  ;            //Ponemos el nuevo nombre al archivo enc
            copy($file_tmp, $dir.$newNAme);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
        }

    }else{
        $file_name = $_POST['archivo'];
        

        $cadena = explode(".",$file_name);          // Separa el nombre para obtener la extension, almacena en un arreglo
        $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena

        $file_enc = $cadena[0];
        $newNAme = $file_name;
        echo $file_enc;
        echo "<br>";
        echo $newNAme;
        
    }
   
   

//Terminar la consulta par apoder actualizar la tabla despues revisar el location del header y la pagina de editar

    try {
        $stmt = $conn->prepare("UPDATE administradores SET nombre=?, apellido=?, correo=?, pass=?, archivo_n=?, archivo=?, rol=?  WHERE id = ? ");
        $stmt->bind_param("ssssssii", $nombre, $apellido, $correo, $passHash,  $file_enc, $newNAme, $tipoUser, $id);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        header('Location: ../../listadoAdmin.php');
    } catch (Exception $e) {
       echo $e->getMessage();
      
    }
    ?>