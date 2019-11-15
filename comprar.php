<?php
  include "./inc/templates/header.php"
?>

  <main>
    <div class="contenedor">
      <div class="titulo carrito_titulo">
        <h2>Mi Carrito de Compras</h2>
      </div>

      <div class="cuerpo_carrito">
        <div class="btn-acciones">
          <button type="button" id="vaciar" name="vaciar">Vaciar</button>
        </div>
        <form class="form_carrito" action="#" method="post">
          <div class="campo">
              <label for="cantidad_producto">Cubo</label>
              <input type="number" id="cantidad_producto" name="cantidad_producto" value="0">
              <div class="borrar">
                <svg class="btn-borrar" width="114" height="115" viewBox="0 0 114 115" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="100.487" y="114.422" width="142" height="19" rx="9.5" transform="rotate(-135 100.487 114.422)" fill="#AF1D09"/>
                <rect y="100.409" width="142" height="19" rx="9.5" transform="rotate(-45 0 100.409)" fill="#AF1D09"/>
                </svg>
              </div>
          </div>
        </form> <!-- End Form campo -->

        <div class="btn-acciones">
          <button type="button" id="pedir" name="pedir">Pedir</button>
        </div>
      </div> <!--End cuerpo_carrito -->
    </div> <!-- End contenedor -->
  </main>
</body>
</html>
