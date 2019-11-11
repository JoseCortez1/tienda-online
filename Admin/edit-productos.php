<?php 
    session_start();
    if(!(isset($_GET['producto_id']))){
        header('location: index.php');
    }
    
    
    $id_producto_editar = (int)$_GET['producto_id'];
    
    include 'inc/funciones/list.php';
    $productos = obtenerProducto( $id_producto_editar);
    
    include 'inc/templates/header.php';
    include 'inc/templates/navegacion.php';
    foreach($productos as $producto){
    
?>
    <header class="header-productos edit-products" id="<?php echo  $id_producto_editar; ?>">
        <h2>Editar producto</h2>
    </header>
    <main>
        <form action="#" id="crear" method="post" enctype= "multipart/form-data" class="contenedor flex-align" >

                <label class="productos-add__label" for="nombre">
                    <p>Nombre: </p>
                    <input value="<?php echo $producto['nombre'];?>" type="text"  name="nombre" id="nombre" >
                </label>
                <label class="productos-add__label" for="codigo">
                    <p>codigo: </p>
                    <input value="<?php echo $producto['codigo'];?>" type="number"  name="codigo" id="codigo" min="0">
                </label>
                <label class="productos-add__label" for="descripcion">
                    <p>descripcion: </p>
                    <input value="<?php echo $producto['descripcion'];?>" type="text"  name="descripcion" id="descripcion" >
                </label>
                <label class="productos-add__label" for="costo">
                    <p>costo: </p>
                    <input value="<?php echo $producto['costo'];?>" type="number"  name="costo" id="costo" min="0" step="0.5">
                </label>
                <label class="productos-add__label" for="stock">
                    <p>stock: </p>
                    <input value="<?php echo $producto['stock'];?>" type="number"  name="stock" id="stock" >
                </label>
    
                <label class="productos-add__label" for="archivo">
                    <p>Foto de producto</p>
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
                
                <div class="productos-add__label btn-acciones">
                    <input  id="editar" class="" type="submit" value="Actualizar" >
                    <input id="cancelar" type="submit" class="" value="Cancelar">

                </div>
               
        </form> 

        <div  id ="campoError" class="">
            
        </div>

    </main>
    <?php 
    }
    ?>
    <script src="js/productos.js"> </script>
</body>
</html>