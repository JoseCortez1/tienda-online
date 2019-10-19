<?php 
    session_start();
    if(isset($_GET['cerrar_sesion'])){
        $_SESSION = array();
    }
    if(isset($_SESSION['login'])){
        header('location:principal.php');
    }
    include "inc/templates/header.php";
?>

    <div class="card-body contenedor">
        <div class="register">
            <h2 style="text-align: center">LOGIN</h2>
            <input type="text" placeholder="Correo" id="correo">
            <input type="password" placeholder="Contraseña" id="pass">
        </div>
        
        <div class="register-btn register">
            <a href="#" id="registro" >Entrar</a> 
        </div>
    </div>
    <script src="js/index-script.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
</body>
</html>