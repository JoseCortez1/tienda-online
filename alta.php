<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Alta</title>
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
                    <select name="rol" id="rol">
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