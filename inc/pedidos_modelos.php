<?php
/** */
function obtenerProductos(){
    include 'conexion.php';
    try {
        return $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 ORDER BY nombre ASC ");
    } catch (Exception $e) {
        echo "Error !!: " . $e->getMessage() . "<br>";
        return false;
    }
}
if(isset($_POST['tipo'])){
        try {
            session_start();
            include 'conexion.php';
            $usuario = $_SESSION['user'];
            $fecha = date("d.m.y");
            $stmt = $conn->prepare("SELECT status, id FROM pedidos WHERE usuario = ? ");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();

            $stmt->bind_result($estatus_pedido, $id_pedido);
            $stmt->fetch();

            $flag_estado_pedido = false;
            echo "estatus = $estatus_pedido , Id = $id_pedido ";
            if(isset($id_pedido)){
                if($estatus_pedido){
                    echo "pedido abierto";
                    $_SESSION['id_pedido'] = $id_pedido;
                }else{
                    echo "pedido cerrado";
                    $flag_estado_pedido = true;
                }  
            }else{
                $flag_estado_pedido = true;
            }
            $stmt->close();
            if($flag_estado_pedido){
                try{
                    
                    $stmtInsert = $conn->prepare("INSERT INTO pedidos(usuario, fecha) VALUES (?, ?) ");
                    $stmtInsert->bind_param("ss", $usuario, $fecha);
                    $stmtInsert->execute();
                    if($stmtInsert->affected_rows > 0){
                        $_SESSION['id_pedido'] = $stmtInsert->insert_id;
                        echo "pedido abierto y creado";
                    }
                }catch(Exception $e){
                    echo "Error insert: " . $e->getMessage() . "<br>";
                    return false;
                }
                $stmtInsert->close();
            }
            $conn->close();
        } catch (Exception $e) {
            echo "Error !!: " . $e->getMessage() . "<br>";
            return false;
        }   
        //var_dump($_POST);

}
 



    /*
     session_start();
        $id = $_POST['id_producto'];
        include 'conexion.php';

        $producto = $conn->query("SELECT * FROM productos WHERE eliminado = 0 AND status = 1 AND id= $id ");
        
        
        $lastId = 0;    
        foreach($producto as $pro);
        var_dump($producto);
        var_dump($pro); 

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
             echo "'". $pedidoJSON . "'";
            echo "<br>"; 
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
        if($_POST['tipo'] == 'agregar'){                                                              
            $id_pedido = $_SESSION['pedido_actual']['id_pedido'];
            $flag = false;
            $i = 0;
            $pos = -1;
            $_SESSION['pedido_actual']['total'] = (float) $_SESSION['pedido_actual']['total'] + (float)$pro['costo'];

            foreach($_SESSION['pedido_actual']['productos']['nombre_producto'] as $nombre_producto){
                if($nombre_producto == $pro['nombre']){
                    $flag = false;
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
             var_dump($_SESSION['pedido_actual']['productos']); 
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
    */