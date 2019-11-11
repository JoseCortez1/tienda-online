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


    /** */
    if(isset($_POST['tipo'])){
        session_start();
        $id = $_POST['id_producto'];
        include 'conexion.php';

        $producto = $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 AND id= $id ");
        
        
        $lastId = 0;    
        foreach($producto as $pro);
        /* var_dump($producto);
        var_dump($pro); */

        if($_POST['tipo'] == 'crear'){
            $pedido = array(
                'productos' => array(
                    array(
                        'nombre_producto' => $pro['nombre'],
                        'cantidad_producto' => 1,
                        'costo' => $pro['costo'],
                        'id'  => $pro['id']
                        )
                ),
                'total' => $pro['costo']

                );
            
            $pedidoJSON = json_encode($pedido['productos']);
            /* echo "'". $pedidoJSON . "'";
            echo "<br>"; */
            try{
                $total = $pro['costo'];
                $conn->query("INSERT INTO pedidos (productos, total) VALUES('$pedidoJSON', $total) ");
                $objIDs= $conn->query(("SELECT id FROM pedidos ORDER BY id ASC"));
                foreach($objIDs as $IDs);
                $pedido['id_pedido'] = (int)$IDs['id'];

                
                $_SESSION['pedido_actual']= $pedido;

            }catch(Exception $e){
                echo "Error!!!: ". $e->getMessage() . "<br>";
            }


        }
        if($_POST['tipo'] == 'agregar'){                                                                /**Agregar  */
            $id_pedido = $_SESSION['pedido_actual']['id_pedido'];
            $flag = false;
            $i = 0;
            $pos = -1;
            $_SESSION['pedido_actual']['total'] = (float) $_SESSION['pedido_actual']['total'] + (float)$pro['costo'];

            foreach($_SESSION['pedido_actual']['productos']['nombre_producto'] as $nombre_producto){
                if($nombre_producto == $pro['nombre']){
                    $flag = true;
                    $pos = $i;
                }
                $i++;
            }
            if(!$flag){
                array_push($_SESSION['pedido_actual']['productos'], array(
                                'nombre_producto' => $pro['nombre'],
                                'cantidad_producto' => 1,
                                'costo' => $pro['costo'],
                                'id'  => $pro['id']
                                )
                );
            }else{
                $_SESSION['pedido_actual']['productos'][$pos]['cantidad_producto'] += 1;
                var_dump($_SESSION['pedido_actual']['productos'][$pos]);
            }
            /* var_dump($_SESSION['pedido_actual']['productos']); */
            $pedidoJSON = json_encode($_SESSION['pedido_actual']['productos']);
            $total = $_SESSION['pedido_actual']['total'];
            try{
                $conn->query("UPDATE pedidos SET productos = '$pedidoJSON', total = $total WHERE id= $id_pedido ");
                $lastId = $id_pedido;
            }catch(Exception $e){
                echo "Error!!!: ". $e->getMessage() . "<br>";
            }
        }

        echo json_encode($_SESSION['pedido_actual']);
    }
    /**
     * Ajustar para guardar items iguales juntos
    */
?>


