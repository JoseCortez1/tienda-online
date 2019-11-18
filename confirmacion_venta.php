<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style_tienda.css">
    <title>Confirmacion Venta</title>
  </head>
  <body>

    <?php
    session_start();
    if(!isset($_SESSION['id_pedido']) || ($_SESSION['id_pedido'] == -1) || ($_SESSION['carrito_art'] < 1) ){ ?>
      <div class="bg-gris">
          <img src="./img/error.svg" class="error-pag" alt="pagina no encontrada">
      </div>
    <?php
      exit();
    }else{
    ?>
      <h2 class="titulo">Confirmacion de compra</h2>
        <?php
        include "./inc/pedidos_modelos.php";
        $id_pedido = $_SESSION['id_pedido'];
        $total = 0;
        $items_lista = obtenerListaPedido($id_pedido);?>

        <div class="conf_lista_inm">
          <div class="campo_lista_inm">
            <p>Articulo</p>
            <p>Cantidad</p>
            <p>precio p/u</p>
          </div>
          <?php
          foreach ($items_lista as $item) {
          ?>
          <!-- Lista de articulos -->
          <div class="campo_lista_inm">
            <p><?php echo $item['nombre']; ?></p>
            <p><?php echo $item['cantidad']; ?></p>
            <p><?php echo $item['costo']; ?></p>
          </div> <!--Fin del campo lista-->
          <?php
          $total += (float)$item['cantidad'] * (float)$item['costo'];
        }  //Final del Foreach
          ?>
          <div class="total_lista_inm">
            <p>Total= <span><?php echo $total; ?> </span> </p>
          </div>

          <div class="btn-acciones btn-lista-inm">

            <button type="button" class="cancelar_compra">Cancelar</button>
            <button type="button" class="confirmar_pago" id="<?php echo $_SESSION['id_pedido']; ?>">Confirmar Compra</button>
          </div>
        </div> <!--End Contenedor de la lista -->
        <img src="./img/pago_realizado.svg" style="display: none;" id="pago_realizado" alt="Pago Realizado">
    <?php
      include "./inc/templates/footer.php";
    ?>
  <?php }  ?>
