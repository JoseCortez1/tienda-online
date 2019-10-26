
<?php 
    session_start();
    if(!(isset($_GET['producto_id']))){
        header('location: index.php');
    }
    
    
    $id = (int)$_GET['producto_id'];
    //echo $id;
    include 'inc/funciones/list.php';
    $productos = obtenerProducto($id);
   
    if($productos){
        include 'inc/templates/header.php';    
        include 'inc/templates/navegacion.php';

        foreach($productos as $producto){
            /*
            echo "<pre>";
            var_dump($producto);
            echo "</pre>"; 
            */
        
    ?>

        <div class="info-contacto__div" >
            <img src="archivos_productos/<?php echo $producto['archivo']; ?>" alt="Imagen User" class="info-contacto__img">
            <div class="">
                
                <div class="info-contacto-datos__div">
                    <h3><span>Codigo:</span> <?php echo $producto['codigo']; ?></h3>
                    <p><?php echo $producto['nombre']; ?></p>
                </div>

                
                <div class="">
                    <p>stock: <?php echo $producto['stock']; ?></p>
                    <p>costo: <?php echo $producto['costo']; ?></p>
                    <p>descripcion: <?php echo $producto['descripcion']; ?></p>
                </div>

                <div class="info-button-back__cont">
                    <a href="listado-productos.php" id="" >Regresar</a> 
                </div>
            </div>
        </div>
    <?php
        }
    }else{
        echo "Error";
    }
?>
    
</body>
</html>
