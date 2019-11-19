<?php
  session_start();

//var_dump($_SESSION);
  if($_SESSION['tipo_user'] != "anonimo"){
    header('location:index.php');
  }else{
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style_tienda.css">
        <title>Usuario</title>
      </head>
      <body>
        <div class="bg_pagina">
          <img class="img_blur" src="./img/pink-tulips-on-wood-texture.jpg"alt="">

            <div class="contenedor_usuario_acceso contenedor_login">
              <form class="" id="login_usuario" action="#" method="post">
                <div class="login_campo">
                  <label for="correo_login">
                    <img src="./img/at-solid.svg" alt="">
                  </label>
                  <input type="email" name="correo" id="correo_login" value="" placeholder="correo@ejemplo.com">
                </div><!--login_campo-->

                <div class="login_campo">
                  <label for="pass_login">
                    <img src="./img/key-solid.svg" alt="key">
                  </label>
                  <input type="password" id="pass_login" name="pass" value="" placeholder="Contraseña">
                </div><!--login_campo-->

                <input type="submit" name="login" value="Login">

                <p class="toogle" id="entrar_mensaje">¿aun no tienes cuenta?, regitrate</p>

              </form>
            </div>


          <div class="contenedor_usuario_acceso contenedor_create displayNone" >
              <form class="" id="crear_usuario" action="#" method="post">
                <div class="login_campo">
                  <label for="nombre_create">
                    <img src="./img/user-solid-white.svg" alt="">
                  </label>
                  <input type="text" name="nombre" id="nombre_create" value="" placeholder="Nombre Ejemplo">
                </div><!--login_campo-->

                <div class="login_campo">
                  <label for="correo_create">
                    <img src="./img/at-solid.svg" alt="">
                  </label>
                  <input type="email" name="correo" id="correo_create" value="" placeholder="correo@ejemplo.com">
                </div><!--login_campo-->

                <div class="login_campo">
                  <label for="pass_create">
                    <img src="./img/key-solid.svg" alt="key">
                  </label>
                  <input type="password" id="pass_create" name="pass" value="" placeholder="Contraseña">
                </div><!--login_campo-->

                <div class="login_campo">
                  <label for="pass_confirm">
                    <img src="./img/key-solid.svg" alt="key">
                  </label>
                  <input type="password" id="pass_confirm" value="" placeholder="Confirmar Contraseña">
                </div><!--login_campo-->

                <input type="submit" name="create" value="Crear">

                <p class="toogle" id="acceder_mensaje">¿ya tienes cuenta?, accede</p>

              </form>
          </div>
        </div>
        <script src="./js/login.js" charset="utf-8"></script>
        <script src="./js/sweetalert2.all.min.js" charset="utf-8"></script>
      </body>
    </html>
<?php
  }
 ?>
