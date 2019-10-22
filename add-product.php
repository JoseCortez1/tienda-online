<?php 
    session_start();
    if(!(isset($_SESSION['id']))){
        header('location: index.php');
    }
    
    include 'inc/templates/header.php';
    include 'inc/templates/navegacion.php';
    
?>
    <header >
        <h2>Añadir productos</h2>
    </header>
    <main>
        <form action="#" id="crear" method="post" enctype= "multipart/form-data" >
            <div class="contenedores">
                <label for="nombre">
                    <p>Nombre: </p>
                    <input type="text"  name="nombre" id="nombre" >
                </label>
                <label for="codigo">
                    <p>codigo: </p>
                    <input type="text"  name="codigo" id="codigo" >
                </label>
                <label for="descripcion">
                    <p>descripcion: </p>
                    <input type="text"  name="descripcion" id="descripcion" >
                </label>
                <label for="costo">
                    <p>costo: </p>
                    <input type="text"  name="costo" id="costo" >
                </label>
                <label for="stock">
                    <p>stock: </p>
                    <input type="text"  name="stock" id="stock" >
                </label>
    
                <label for="archivo">
                    <p>Foto de perfil</p>
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
                
                <div class="btn-acciones">
                    <input  id="enviar" class="" type="submit" value="Añadir" >
                    <input id="cancelar" type="submit" class="" value="Cancelar">

                </div>
                
            </div>
        </form> 

        <div  id ="campoError" class="campoError">
        </div>

    </main>
    <script src="js/productos.js"></script>
</body>
</html>