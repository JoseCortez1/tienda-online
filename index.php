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
    }else{
        if($_SESSION['tipo_user'] == "anonimo"){
            $user = $_SESSION['user'];
        }
    }
    var_dump($_SESSION)

    ?>
    <header> 
        <div class="hero">
            <img class="hero-img" src="./img/mike-petrucci-c9FQyqIECds-unsplash.jpg" alt="imagen principal">
        </div>
    </header>
    <nav class="navegacion-principal">
        <a href="index.php?close=true">Inicio</a>
        <a href="#">Ofertas</a>
        <a href="#">Comprar</a>
        <a href="#">Contactanos</a>
        
        <div class="carrito">
            <input type="hidden" name="" value="<?php echo $user ?>" id="_user">
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
                <span class="numero_items_carrito" id="numero_items_carrito">
                    0
                </span>
            </a>
            <p id="total-compra"> 
                $<span id="total">
                    0
                </span>
            </p>

            </span>
        </div>
    </nav>

    <main class="main-grid-principal">

        <section class="section-principal">
            <h2 class="titulo">Nuestros Productos</h2>
            <pre>
            <?php  
            if(isset($_SESSION['pedido_actual']))
                var_dump($_SESSION['pedido_actual']);
            ?>
            </pre>
            <div class="productos">
                <?php 
                    include "./inc/pedidos_modelos.php";
                    $resultado = obtenerProductos();
                    
                    foreach($resultado as $producto):
                     /*   var_dump($producto);*/
                ?>
                
                    <div class="producto" id="<?php echo  $producto['id']; ?>">
                        <div class="imagen">
                            <img src="./archivos_productos/<?php echo  $producto['archivo']; ?>" alt="imagen producto">
                        </div>
                        <p> <?php echo  $producto['nombre']; ?> </p>
                        <p> <?php echo  $producto['costo']; ?> c/u </p>
                        <a href="#" class="btn btn-add" >Añadir</a>
                        
                    </div>

                <?php endforeach; ?>

            </div>

        </section>
    </main>
    <footer class="footer-main">
        <p>By: JEVC (Jose Eduardo Vazquez Cortez)</p>
    </footer>
    </footer>


    <script src="./js/app.js"></script>

</body>
</html>