<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Fascinate+Inline&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c7473a21c8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style_tienda.css">
    <title>Tiendita de la esquina</title>
</head>
<body>
    <?php
    session_start();

    if(isset($_GET['close'])){
        if($_GET['close'] == true){
            $_SESSION = array();
            header('location:./index.php');
        }
    }

    if(!isset($_SESSION['user'])){
        $cad1 = substr(str_shuffle("1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"),0,5);
        $cad2 = substr(md5(microtime()),1,10);
        $user = $cad1.$cad2;
        $_SESSION['user'] = $user;
        $_SESSION['tipo_user'] = "anonimo";
        $_SESSION['carrito_art']= 0;
        $_SESSION['carrito_total'] = 0;
    }else{
        if($_SESSION['tipo_user'] == "anonimo"){
            $user = $_SESSION['user'];

        }
    }


    ?>
    <header>
        <div class="hero">
            <img class="hero-img" src="./img/mike-petrucci-c9FQyqIECds-unsplash.jpg" alt="imagen principal">
        </div>
    </header>
    <nav class="navegacion-principal">
        <a href="index.php">Inicio</a>
        <a href="#">Ofertas</a>
        <a href="comprar.php">Comprar</a>
        <a href="index.php?close=1">Contactanos</a>

        <div class="carrito">
            <input type="hidden" name="" value="<?php echo $user ?>" id="_user">
            <a href="comprar.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="numero_items_carrito" id="numero_items_carrito">
                    <?php echo $_SESSION['carrito_art']; ?>

                </span>
            </a>
            <p id="total-compra">
                $<span id="total">
                    <?php echo $_SESSION['carrito_total']; ?>
                </span>
            </p>

            </span>
        </div>
        <div class="login_container">
          <img src="./img/user-solid.svg" alt="usuario">
          <p><?php echo $_SESSION['user']; ?></p>
        </div>
    </nav>
