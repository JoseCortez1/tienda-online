window.onload = function(){


    eventeListeners();

    //leer los añadir al carrito
    
    
    function eventeListeners(){
        document.querySelector(".productos").addEventListener('click',function productos(e){
            e.preventDefault();
            if(e.target.classList.contains('btn')){
                let id = e.target.parentElement.id;
                carritoFuncion(id);
            }
        }); 
        
    }

    function carritoFuncion(id){
        
        let pedido = new FormData();
        pedido.append('id_producto', id);
    
        if(parseFloat(document.querySelector('#total').textContent) == 0){
            pedido.append('tipo', 'crear');    
        }else{
            pedido.append('tipo', 'agregar');
        }
        
        let xhr= new XMLHttpRequest();

        xhr.open('POST', './inc/pedidos_modelos.php', true);

        xhr.onload = function(){
            if(this.status == 200 ){

                console.log(xhr.responseText);
                /*
                //console.log(JSON.parse(xhr.responseText));
                let listaPedido =  JSON.parse(xhr.responseText);
                let costo = 0;

                id_pedido.value = listaPedido.id_pedido;
                //console.log(listaPedido.productos);
                costo = listaPedido.productos.pop()['costo'];
                addCarrito(costo);*/
            }
        }

        xhr.send(pedido);
    }



    function addCarrito(precio){
        //console.log(nuevoArticulo);
        let total_compra = document.querySelector('#total');     //Elemento que contiene el total de la compra
        let total_actual = parseFloat(total_compra.textContent);        //Valor total de la compra        
        let costo_nuevoArticulo = parseFloat(precio);   //Costo del nuevo articulo
        total_actual += costo_nuevoArticulo;     //Suma del precio anterior y el nuevo
        total_compra.textContent = total_actual; //Añadiendo precio actual y el nuevo    


        
        let articulos_carrito = document.querySelector('#numero_items_carrito');
        let numero_articulos = parseInt(articulos_carrito.textContent);
        numero_articulos += 1;
        articulos_carrito.textContent = numero_articulos;
    }
    
}//Fin de la carga de pagina