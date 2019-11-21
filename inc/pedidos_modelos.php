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

function obtenerListaPedido($id_pedido){
  include "conexion.php";
  $queryMamalona = "SELECT nombre, id_pedido, id_producto, cantidad, costo  FROM pedidos_productos JOIN productos WHERE pedidos_productos.id_producto = productos.id AND pedidos_productos.id_pedido = $id_pedido ";
  return $conn->query($queryMamalona);

}

function obtenerNombreProducto($id){
  include "conexion.php";
  $obj_item = $conn->query("SELECT nombre FROM productos WHERE id = $id ");
  foreach ($obj_item as $key => $value) {
    return $value;
  }
}
if(isset($_POST['tipo']) && $_POST['tipo'] == "crear"){
  session_start();
  $id_producto = $_POST['id_producto'];
  $fecha_pedido = date("d.m.y");
  if($_SESSION['tipo_user'] == "anonimo"){
    $user = $_SESSION['user'];
  }else{
    $user = $_SESSION['id'];
  }

  include "conexion.php";

  try{
    /**var_dump($fecha_pedido)   ;
    var_dump($user);
    Insertando los datos para el pedido **/
    $stmt = $conn->prepare(" INSERT INTO pedidos (fecha, usuario) VALUES(?,?) ");
    $stmt->bind_param("ss", $fecha_pedido, $user);
    $stmt->execute();
    /**REvisando que se afecte la tabla, anunciando que se inserto correctamente
       el pedido **/
    if($stmt->affected_rows > 0){
      //echo "Correctamente insertado";
      $id_pedido  = $stmt->insert_id;
      $_SESSION['id_pedido'] = $id_pedido;
      $cantidad = 1;
      /**Insertando el pedido_producto **/
      $stmt = $conn->prepare(" INSERT INTO pedidos_productos(id_pedido, id_producto, cantidad) VALUES (?,?,?) ");
      $stmt->bind_param("iii", $id_pedido, $id_producto,  $cantidad);
      $stmt->execute();
      if($stmt->affected_rows > 0){
        /**Obteniendo el costo del producto para agregarlo al carrito **/
        $stmt = $conn->prepare("SELECT costo FROM productos WHERE id = ? ");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();

        $stmt->bind_result($costo_producto);
        $stmt->fetch();

        /**Revisando que la consulta retorne un valor **/
        if(isset($costo_producto)){
          echo $costo_producto;
        }else{
          echo "Error en consulta ";
        }
      }else{
        echo " No se inserto el pedido_producto <br>";
      }
    }else{
      echo "No se inserto el pedido <br>";
    }

  }catch(Exception $e){

    echo "Error! Insert pedidos: " . $e->getMessage();

  }
}

if(isset($_POST['tipo']) && $_POST['tipo'] == "agregar"){
  session_start();
  $id_pedido = $_SESSION['id_pedido'];
  $id_producto = $_POST['id_producto'];
  $cantidad = 1;

  include "conexion.php";

  /**Obteniendo productos con id_pedido igual **/
  $pedidos_productos=  $conn->query("SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido ");

  $flag_update_cantidad = false;
  if(isset($pedidos_productos)){
    /**Ciclo para leer cada campo de cada producto **/
    foreach ($pedidos_productos  as $producto) {
      // code...
      /**Cambiamos el id_producto que viene como string a un entero para
      poderlo comparar con el id_producto que viene del home */
      if((int)$producto['id_producto'] == $id_producto){

        /**En caso de ser igual incrementamos la cantidad que tenga en uno **/
        $cantidad_actual = (int)$producto['cantidad'] + 1;

        /**Realizamos una actualizacion a  la fila **/
        $stmt = $conn->prepare("UPDATE pedidos_productos SET cantidad = ? WHERE id_pedido = ? AND id_producto = ? ");
        $stmt->bind_param("iii",$cantidad_actual, $id_pedido, $id_producto);
        $stmt->execute();

        if($stmt->affected_rows > 0){
          /**En caso de que se ejecute correctamenete hacemos un retorno del valor del producto para agregarlo
          al carrito**/
          $obj_costo_producto = $conn->query("SELECT costo FROM productos WHERE id = $id_producto");
          foreach ($obj_costo_producto as $costo_producto);
          echo (int)$costo_producto['costo'];
          /**Se actualiza la bandera a true para no realizar una doble insercion
          en la fila **/
          $flag_update_cantidad = true;
        }
      }
    }

    /**En caso de no coincidir con ninguna fila la bandera no cambia
    y se realiza una nueva insercion en la fula */
    if(!$flag_update_cantidad){

      $stmt = $conn->prepare("INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad) VALUES (?,?,?) ");
      $stmt->bind_param("iii", $id_pedido, $id_producto, $cantidad );
      $stmt->execute();

      if($stmt->affected_rows > 0){
        $obj_costo_producto = $conn->query("SELECT costo FROM productos WHERE id = $id_producto");
        foreach ($obj_costo_producto as $costo_producto);
        echo (int)$costo_producto['costo'];
      }
    }
  }


}

if(isset($_POST['tipo']) && $_POST['tipo'] == "modificar"){
  session_start();
  $id_pedido = (int)$_SESSION['id_pedido'];
  $id_producto = (int)$_POST['id_producto'];
  $cantidad = (int)$_POST['cantidad'];
  if($cantidad >= 0){
    include "conexion.php";
    $stmt = $conn->prepare("UPDATE pedidos_productos SET cantidad = ? WHERE id_pedido = ? AND id_producto = ? ");
    $stmt->bind_param("iii", $cantidad, $id_pedido, $id_producto );
    $stmt->execute();
    //var_dump($conn);
    if($stmt->affected_rows > 0){
      $respuesta = array(
        "respuesta"=> "exitoso"
      );
      echo json_encode($respuesta);

    }else{
      $respuesta = array(
        "respuesta" => "fasho"
      );
      echo json_encode($respuesta);
    }
  }else{
    $respuesta = array(
      "respuesta" => "fasho"
    );
    echo json_encode($respuesta);
  }

}

/**
if(isset($_POST['tipo']) && $_POST['tipo'] == "eliminar"){
  session_start();
  include "conexion.php";
  $id_producto = $_POST['id_producto'];
  $id_pedido = $_SESSION['id_pedido'];

  $stmt = $conn->query(" DELETE FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido ");

  if(!isset($stmt)){
    $stmt = $conn->query("UPDATE pedidos SET status = 0 WHERE id = $id_pedido ");
    if(isset($stmt)){
      $_SESSION['id_pedido'] = -1;
      echo "UPDATE correctly";
    }
    echo "Good job motherfucker";
  }else{
    echo "oh no!!! motherFucker";
  }

}**/
if(isset($_POST['tipo']) && $_POST['tipo'] == "vaciar"){
  session_start();
  include "conexion.php";
  $id_pedido = $_SESSION['id_pedido'];

  $stmt = $conn->query("UPDATE pedidos SET status = 0 WHERE id = $id_pedido ");
  if(isset($stmt)){
    $_SESSION['id_pedido'] = -1;
    echo "UPDATE correctly";
  }


}

if(isset($_POST['tipo']) && $_POST['tipo'] == "pagar"){
  session_start();
  $id_pedido = $_SESSION['id_pedido'];
  include "conexion.php";
  $stmt = $conn->query("UPDATE pedidos SET status = 0 WHERE id = $id_pedido ");
  if($stmt){
    echo "chingon";
  }

}
if(isset($_POST['carrito'])){
  session_start();
  $_SESSION['carrito_art'] = $_POST['carrito_art'];
  $_SESSION['carrito_total'] = $_POST['carrito_total'];
}
