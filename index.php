<?php include "inc/templates/header.php"; ?>

    <main class="main-grid-principal">

        <section class="section-principal">
            <h2 class="titulo">Nuestros Productos</h2>
            <pre>

            <?php
            //var_dump($_SESSION)
            ?>
            </pre>
            <div class="productos">
                <?php
                    include "./inc/pedidos_modelos.php";
                    $resultado = obtenerProductos();

                    foreach($resultado as $producto):
                     /*   var_dump($producto);*/
                ?>

                    <div class="producto" id="<?php echo  $producto['id']; ?>">
                        <div class="imagen">
                            <img src="./archivos_productos/<?php echo  $producto['archivo']; ?>" alt="imagen producto">
                        </div>
                        <p> <?php echo  $producto['nombre']; ?> </p>
                        <p> <?php echo  $producto['costo']; ?> c/u </p>
                        <a href="#" class="btn btn-add" >Añadir</a>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>
    </main>
    <footer class="footer-main">
        <p>By: JEVC (Jose Eduardo Vazquez Cortez)</p>
    </footer>
    <script src="./js/app.js"></script>

</body>
</html>
