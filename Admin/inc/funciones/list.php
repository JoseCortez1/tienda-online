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
    function obtenerUsuarios(){
        include 'conexion.php';
        try{    

            return $conn->query("SELECT * FROM usuarios WHERE eliminado = 0 AND status = 1 ORDER BY id DESC");

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
            $resultado =  $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 AND id= $id ");
            $conn->close();
            return $resultado;
        } catch (Exception $e) {
            echo "Error !!: " . $e->getMessage() . "<br>";
            return false;
        }

    }

    function obtenerPedidoNoR($id) {
        include "conexion.php";
        try{
            return $conn->query("SELECT * FROM pedidos WHERE status = 0 AND eliminado = 0 AND id = $id ");
        } catch(Exception $e) {
            echo "error! " . $e->getMessage() . "<br>";
            return false;
        }
    }
    function obtenerPedidoR($id) {
        include "conexion.php";
        try{
            return $conn->query("SELECT * FROM pedidos WHERE status = 1 AND eliminado = 0 AND id = $id ");
        } catch(Exception $e) {
            echo "error! " . $e->getMessage() . "<br>";
            return false;
        }
    }
?>
