<?php 
    session_start();
    if(!(isset($_SESSION['id']))){
        header('location: index.php');
    }
    
    include 'inc/templates/header.php';
    include 'inc/templates/navegacion.php';
    
?>
    <header class="header-productos add-products" >
        <h2>Añadir producto</h2>
    </header>
    <main>
        <form action="#" id="crear" method="post" enctype= "multipart/form-data" class="contenedor flex-align" >

                <label class="productos-add__label" for="nombre">
                    <p>Nombre: </p>
                    <input type="text"  name="nombre" id="nombre" >
                </label>
                <label class="productos-add__label" for="codigo">
                    <p>codigo: </p>
                    <input type="number"  name="codigo" id="codigo" min="0">
                </label>
                <label class="productos-add__label" for="descripcion">
                    <p>descripcion: </p>
                    <input type="text"  name="descripcion" id="descripcion" >
                </label>
                <label class="productos-add__label" for="costo">
                    <p>costo: </p>
                    <input type="number"  name="costo" id="costo" min="0" step="0.5">
                </label>
                <label class="productos-add__label" for="stock">
                    <p>stock: </p>
                    <input type="number"  name="stock" id="stock" >
                </label>
    
                <label class="productos-add__label" for="archivo">
                    <p>Foto de perfil</p>
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
                
                <div class="productos-add__label btn-acciones">
                    <input  id="enviar" class="" type="submit" value="Añadir" >
                    <input id="cancelar" type="submit" class="" value="Cancelar">

                </div>
               
        </form> 

        <div  id ="campoError" class="">
            
        </div>

    </main>
    <script src="js/productos.js"> </script>
</body>
</html>