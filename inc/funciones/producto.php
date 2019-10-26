<?php
if(!isset($_POST['tipo'])){
    exit("<h2>Pagina no encontrada</h2>");
}

/**
 * 
 * Se crea un solo archivo para manejar los distintos tipos de consulta que se pueden hacer a la base de datos 
 * por ejemplo: crear, actualizar y eliminar se enviara el mismo FormData desde JS pero con distinto tipo de operacion
 * esto nos permitira manejar la consulta adecuada para cada uno de las distintas operaciones 
 */
$tipo = $_POST['tipo'];
if($tipo == 'crear'){

    $nombre_crear = $_POST['nombre'];
    $codigo_crear = $_POST['codigo'];
    $descripcion_crear = $_POST['descripcion'];
    $costo_crear = $_POST['costo'];
    $stock_crear = $_POST['stock'];
    $imgNombreTMP = $_FILES['imagen_archivo']['tmp_name'];
    $imgNombre = $_FILES['imagen_archivo']['name'];

    include 'conexion.php';
    /**Se consulta la bd en caso de haber otro producto con el mismo codigo no duplicarlo */
    $consultaCodigo = $conn->query("SELECT * FROM productos WHERE codigo = $codigo_crear");

    if($consultaCodigo->num_rows <= 0){
        $cadena = explode(".",$imgNombre);          // Separa el nombre para obtener la extension, almacena en un arreglo
        $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
        $dir = "../../archivos_productos/";                         // Carpeta donde se guardan los archivos
        $file_enc = md5_file($imgNombreTMP);
        if(isset($imgNombre)){
            $newNAme = $file_enc.'.'.$ext  ;            //Ponemos el nuevo nombre al archivo enc
            copy($imgNombreTMP, $dir.$newNAme);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
        }

        $stmt = $conn->prepare("INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_n, archivo ) VALUES (?,?,?,?,?,?,?) ");
        $stmt->bind_param("sisiiss", $nombre_crear, $codigo_crear, $descripcion_crear, $costo_crear, $stock_crear, $file_enc, $newNAme);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        $respuesta = array(
            'respuesta' => 'correcto'
        );
    }else{
        $respuesta = array(
            'respuesta' => 'Codigo existente'
        );
    }

    echo json_encode($respuesta);
}

if($tipo == 'actualizar'){
    
    $nombre_crear = $_POST['nombre'];
    $codigo_crear = $_POST['codigo'];
    $descripcion_crear = $_POST['descripcion'];
    $costo_crear = $_POST['costo'];
    $stock_crear = $_POST['stock'];
    $id_actualizar = (int) $_POST['id_actualizar'];
    

    include 'conexion.php';
    
    $consultar_id = $conn->query("SELECT * FROM productos WHERE id = $id_actualizar");

    foreach($consultar_id as $producto_actual);
    /**
     * Se revissa que el archivo contenga informacion en caso de que no se tenga  se extraeran los datos de la vase de datos para hacer la actualizacion, se podria crear una consulta aparte para no actualizar esos datos, peroo psss ya lo hice, 
     * 
     */
    if($_FILES['imagen_archivo']['name'] != ''){
        /*echo "hay imagen ";
        echo ": ". $_FILES['imagen_archivo']['name'];*/
        $imgNombreTMP = $_FILES['imagen_archivo']['tmp_name'];
        $imgNombre = $_FILES['imagen_archivo']['name'];
        
        $cadena = explode(".",$imgNombre);          // Separa el nombre para obtener la extension, almacena en un arreglo
        $ext = $cadena[1];                          // Extension extraida del arreglo en la variable $cadena
        $dir = "../../archivos_productos/";                         // Carpeta donde se guardan los archivos
        $file_enc = md5_file($imgNombreTMP);
        if(isset($imgNombre)){
            $newNAme = $file_enc.'.'.$ext  ;            //Ponemos el nuevo nombre al archivo enc
            copy($imgNombreTMP, $dir.$newNAme);     // Copia el archivo temporal a la carpeta asignada en la varibale $dir
        }
    }else{
       
        $file_enc = $producto_actual['archivo_n'];
        $newNAme = $producto_actual['archivo'];
    
    }

    $consultaCodigo = $conn->query("SELECT * FROM productos WHERE codigo = $codigo_crear");
    foreach($consultaCodigo as $codigoBD);

/**
 * Se compara codigoBD el cual es una busqueda del producto por medio del codigo que se esta actualizando  con una busqueda  del producto por id en su campo codigo si ambos coinciden significa que es el mismo codigo el que se quiere actualizar que el que actualmente posee, por lo tanto se mantiene y se crea la actuzalizacion */
    if(($consultaCodigo->num_rows <= 0) || ((int)$codigoBD['codigo'] == $producto_actual['codigo']) ){
        
        

        $stmt = $conn->prepare("UPDATE productos SET  nombre=?, codigo=?, descripcion=?, costo=?, stock=?, archivo_n=?, archivo=?  WHERE id = ?  ");
        $stmt->bind_param("sisiissi", $nombre_crear, $codigo_crear, $descripcion_crear, $costo_crear, $stock_crear, $file_enc, $newNAme, $id_actualizar);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        $respuesta = array(
            'respuesta' => 'correcto'
        );
    }else{
        $respuesta = array(
            'respuesta' => 'Codigo existente'
        );
    }

    echo json_encode($respuesta);
}


if($tipo  === 'eliminar'){
    /**Eliminar por id
     * 
     * EN esta funcion recibimos un id y eliminamos de la BD por medio del mismo
     */
    $id_eliminar = (int)$_POST['id_eliminar'];
    include 'conexion.php';
    try{
        $conn->query("UPDATE productos SET eliminado = 1  WHERE id = $id_eliminar");

        $respuesta = array(
            'respuesta' => 'correcto'
        );

        $conn->close();

    }catch(Exception $e){
        $respuesta = array(
            'repuesta'=> 'Error al eliminar',
            'info-respuesta'=> $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}