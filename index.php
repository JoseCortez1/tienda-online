<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Formulario</title>
</head>
<body>
    <header class="hero">
        <h2>Formulario para ALTA</h2>
    </header>
    <main>
        <form action="#" method="post" enctype= "multipart/form-data">
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
                    <select>
                        <option value="admin">Administrar</option>
                        <option value="consul">Consultar</option>
                    </select>
                </label>
                <label for="archivo">
                    <p>Foto de perfil</p>
                    <input type="file"  id="imagen_archivo" name="imagen_archivo" accept=".jpg">
                </label>
    
                <input  id="#enviar"class="boton-submit"type="submit" value="enviar" >
                
            </div>
        </form>
        
        <div class="" id ="campoError" style="display: none">
            <h3>Hubo un error, comprueba los datos ingresados</h3>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>
</html>