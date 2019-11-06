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
    <header> 
        <div class="hero">
            <img class="hero-img" src="./img/mike-petrucci-c9FQyqIECds-unsplash.jpg" alt="imagen principal">
        </div>
    </header>
    <nav class="navegacion-principal">
        <a href="#">Inicio</a>
        <a href="#">Ofertas</a>
        <a href="#">Comprar</a>
        <a href="#">Contactanos</a>
        
        <div class="carrito">
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
                <span class="numero_items_carrito">
                    15
                </span>
            </a>
            <p id="total-compra">
                $500.00
            </p>
        </div>
    </nav>

    <main class="main-grid-principal">
        <!--Ofertar
        <aside class="aside-principal">
            <h3>Oferta del dia</h3>
            <ul>
                <li>  adipisicing elit a $12</li>
                <li>  adipisicing elit a $56</li>
                <li>  adipisicing elit a $65</li>
                <li>  adipisicing elit a $98</li>
            </ul>
        </aside>-->
        <section class="section-principal">
            <h2 class="titulo">Nuestros Productos</h2>
            <div class="productos">
                
                <div class="producto">
                    <div class="imagen">
                        <img src="./img/Todo-sobre-los-periféricos-4.jpg" alt="imagen producto">
                    </div>
                    <p> Nombre producto </p>
                    <p>precio $50 c/u </p>
                    <div class="formacion">
                        <a href="#" class="btn btn-add" id="id-producto:1">Añadir</a>
                        
                    </div>
                </div>

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