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
            return $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1");
        } catch (Exception $e) {
            echo "Error !!: " . $e->getMessage() . "<br>";
            return false;
        }
    }

?>