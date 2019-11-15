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


if(isset($_POST['tipo']) && $_POST['tipo'] == "crear"){
  session_start();
  $id_producto = $_POST['id_producto'];
  $fecha_pedido = date("d.m.y");
  $user = $_SESSION['user'];

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

if(isset($_POST['carrito'])){
  session_start();

  $_SESSION['carrito_art'] = $_POST['carrito_art'];
  $_SESSION['carrito_total'] = $_POST['carrito_total'];
}
