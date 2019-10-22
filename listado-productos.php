<?php 
    include "inc/funciones/sesiones.php";
    include "inc/funciones/list.php";
    $respuesta = obtenerProductos();
    include "inc/templates/header.php";

    /*echo "<pre>";
        
        foreach($respuesta as $producto){
            var_dump($producto);   
        }
    echo "</pre>";*/
    
    ?>
    <header id="usuario_logeado:<?php echo $_SESSION['id'];?>" class="usuarioLog">
        <?php
            include 'inc/templates/navegacion.php';
        ?>
        <div class="info-header__">
            <h2>Productos</h2>
                <div class="agregar-producto">
                    <a href="add-product.php">
                        Añadir Producto
                    </a>
                </div>
            
        </div>
    </header>
    <main class="contenedor-md">
        <div class="producto transition-none">
            <div class="detalles">
                <p>Foto</p>
            </div>

            <div class="detalles">
                <p>Nombre</p>
            </div>  

            <div class="detalles">
                <p>descripcion</p>
            </div>

            <div class="detalles">
                <p>Costo</p>
            </div>
            <div class="detalles">
                <p>Stock</p>
            </div>

            <div class="detalles iconos">
                <p>Ver</p>
                <p>Editar</p>
                <p>Eliminar</p>
                
            </div>
        </div> 
        <?php 
            if($respuesta->num_rows > 0){

                foreach($respuesta as $producto){ ?>
                <form action="#"  method="post" class="form-admin">
                    <div class="producto" id="<?php echo $producto['id']; ?>">
                        <div class="detalles">
                            <img class="img-admin consultar-info" src="archivos_productos/<?php echo $producto['archivo'];?>" alt="foto usuario">
                        </div>

                        <div class="detalles">
                            <p>
                                <?php echo  $producto['nombre']; ?>
                            </p>
                        </div>  
            
                        <div class="detalles">
                            <label for="descripcion-toogle">
                                <input type="checkbox" id="descripcion-toogle" class="des-toogle__input">
                                <span class="des-toogle__button"></span>
                            </label>
                        </div>

                        <div class="detalles">
                            <p>
                            <?php echo  $producto['costo']; ?>
                            </p>
                        </div>
                        <div class="detalles">
                            <p>
                                <?php echo  $producto['stock']; ?>
                            </p>
                        </div>

                        <div class="detalles iconos">
                            <?php 
                                if( $_SESSION['id'] == $producto['id']){
                                    $bandera = true;
                                }
                                else{
                                    $bandera = false;
                                }
                            ?>
                            <img  src="img/eye-regular.svg" class="icono vista" alt="imagen vista">
                            <img  src="img/vista.svg" class="icono editar" alt="imagen editar">
                            <img  src="img/trash.svg" class="icono" alt=" imagen basura">    
                        </div>

                        <input type="hidden"  name="id-user" value="<?php echo $producto['id']; ?>">
                    </div> 
                    <div id="descripcion-producto" class="">
                        <p><?php echo  $producto['descripcion']; ?></p>
                    </div>
                </form>
            <?php } 
            
            }else{
                echo "<h3 class='empty-query'> No hay ningun producto añadido </h3>";
            }
            ?>

    </main>
    <script src="js/productos.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</body>
</html>