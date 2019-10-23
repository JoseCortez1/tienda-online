<?php
if(!isset($_POST['tipo'])){
    exit("<h2>Pagina no encontrada</h2>");
}
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