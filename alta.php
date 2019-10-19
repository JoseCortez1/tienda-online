<?php 
    session_start();
    if(!(isset($_SESSION['id']))){
        header('location: index.php');
    }
    
    include 'inc/templates/header.php';
    include 'inc/templates/navegacion.php';
    
?>
    <header class="hero alta_user">
        <h2>Formulario para ALTA</h2>
    </header>
    <main>
        <form action="#" id="crear" method="post" enctype= "multipart/form-data" data-user="<?php  echo $_SESSION['id']; ?>">
            <div class="contenedores">
                <label for="nombre">
                    <p>Nombre: </p>
                    <input type="text"  name="nombre" id="nombre" >
                </label>
    
                <label for="apellido">
                    <p>Apellido: </p>
                    <input type="text"  name="apellido" id="apellido" >
                </label>
            </div>
            <div class="contenedores">
                
                <label for="correo">
                    <p>Correo: </p>
                    <input type="email"  name="correo" id="correo" >
                </label>
    
                <label for="password">
                    <p>Contraseña: </p>
                    <input type="password"  name="password" id="password" >
                </label>    
            </div>
            <div class="contenedores f">
                <label for="rol">
                 <p>Rol</p>
                    <select name="rol" id="rol">
                        <option value="">Tipo De Rol</option>
                        <option value="admin">Administrar</option>
                        <option value="consul">Consultar</option>
                    </select>
                </label>
                <label for="archivo">
                    <p>Foto de perfil</p>
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
                
                <input  id="enviar" class="boton-submit YES" type="submit" value="SALVAR INFORMACION" >
                <input id="cancelar" type="submit" class="boton-submit NOT" value="CANCELAR">
                
                
            </div>
        </form>
        
        <div  id ="campoError" class="campoError">
        </div>
    </main>
    <script src="js/script.js"></script>
    
</body>
</html>