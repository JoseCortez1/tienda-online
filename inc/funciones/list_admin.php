<?php 
    include 'conexion.php';

    try{

        $respuesta = $conn->query("SELECT * FROM administradores WHERE eliminado = 0 AND status = 1 ORDER BY id DESC");

    }catch(Exception $e){
        echo "Error !!" . $e->getMessage() . "<br>";
        return false;
    }

?>