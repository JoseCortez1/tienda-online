<?php 

    function obtenerAdministradores(){
        include 'conexion.php';
        try{    
    
            return $conn->query("SELECT * FROM administradores WHERE eliminado = 0 AND status = 1 ORDER BY id DESC");
    
        }catch(Exception $e){
            echo "Error !!" . $e->getMessage() . "<br>";
            return false;
        }

    }

    function obtenerProductos(){
        include 'conexion.php';
        try {
            return $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 ORDER BY nombre ASC ");
        } catch (Exception $e) {
            echo "Error !!: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    function obtenerProducto($id){
        include 'conexion.php';
        try {
            return $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 AND id= $id ");
        } catch (Exception $e) {
            echo "Error !!: " . $e->getMessage() . "<br>";
            return false;
        }
    }
    if(isset($_POST['id_producto'])){
        $id = $_POST['id_producto'];
        $producto = obtenerProducto($id);
        echo json_encode($producto);
    }

?>