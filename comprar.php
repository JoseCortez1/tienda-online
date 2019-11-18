<?php
  include "./inc/templates/header.php"
?>

  <main>
    <div class="contenedor">
      <div class="titulo carrito_titulo">
        <h2>Mi Carrito de Compras</h2>
      </div>
      <pre>

          <?php
          if(isset($_SESSION['id_pedido']) && ($_SESSION['carrito_total'] > 0)){
            $id_pedido = $_SESSION['id_pedido'];
          ?>
      </pre>


      <div class="cuerpo_carrito">
        <?php include "./inc/pedidos_modelos.php" ;
          $items_lista = obtenerListaPedido($id_pedido);
          if($items_lista){
        ?>
        <form class="form_carrito" action="#" method="post">
          <div class="btn-acciones">
            <button type="button" id="vaciar" name="vaciar">Vaciar</button>
          </div>
          <div id="img_error0">

          </div>
          <?php

                foreach ($items_lista as $item) {
                  // code..
              ?>


                <div class="campo">
                    <label for="cantidad_producto<?php echo $item['id_producto']; ?>">
                        <img id="img_error<?php echo $item['id_producto']; ?>" style="display: none;"  src="./img/exclamation-circle-solid.svg" alt=""><?php echo $item['nombre'] ?>
                    </label>
                    <input type="number" min="0" class="item"
                      id="cantidad_producto.<?php echo $item['id_producto']; ?>"
                      data-costo="<?php echo (int)$item['costo']; ?>"
                      name="cantidad_producto"
                      value="<?php echo (int)$item['cantidad']; ?>">
                    <div class="borrar">
                      <img class="btn-borrar" src="./img/times-solid.svg" alt="eliminar producto">
                    </div>
                </div>

              <?php

            }
            ?>

          <div class="btn-acciones total_carrito">

            <p>Total: $<span id="total_carrito"><?php echo $_SESSION['carrito_total']; ?></span> </p>
          </div>
          <div class="btn-acciones">
            <button type="submit" id="pedir" name="pedir">Pedir</button>
          </div>
        </form> <!-- End Form campo -->
        <?php
        }else{
          echo "<h2> No hay ningun pedido existente </h2> ";
        } ?>
      </div> <!--End cuerpo_carrito -->
      <?php
    }else{?>
      <img class="carrito_vacio" src="./img/carritoVacio.png" alt="Carrito vacio">
    <?php } ?>
    </div> <!-- End contenedor -->
    <div id="mensaje_error" style="display: none;">
      Hola mundo
    </div>
  </main>
  <script src="./js/sweetalert2.all.min.js" ></script>
<?php include "./inc/templates/footer.php"; ?>
