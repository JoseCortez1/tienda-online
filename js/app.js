window.onload = function(){


    eventeListeners();

    //leer los añadir al carrito
    
    
    function eventeListeners(){
        document.querySelector(".productos").addEventListener('click',function productos(e){
            e.preventDefault();
            if(e.target.classList.contains('btn')){
                let id = e.target.parentElement.id;
                addCarrito(id);
            }
        }); 
        
    }

    function addCarrito(id){
        let pedido = new FormData();
        pedido.append('id_producto', id);
        pedido.append('tipo', 'agregar');
        
        let xhr= new XMLHttpRequest();

        xhr.open('POST', 'inc/funciones/list.php', true);

        xhr.onload = function(){
            if(this.status == 200 ){
                console.log(xhr.responseText);
            }
        }

        xhr.send(pedido);
    }
    
}//Fin de la carga de pagina