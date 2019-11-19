window.onload = function(){


    eventeListeners();

    //leer los añadir al carrito


    function eventeListeners(){
      if(document.querySelector(".productos")){
        document.querySelector(".productos").addEventListener('click',function productos(e){
            e.preventDefault();
            if(e.target.classList.contains('btn')){
                let id = e.target.parentElement.id;
                carritoFuncion(id);
            }
        });
      }
      if(document.querySelector('.cuerpo_carrito')){
        console.log("Pagina compra");
        document.querySelector('.cuerpo_carrito').addEventListener('click', function clicks(e){
          e.preventDefault();
          if(e.target.classList.contains('btn-borrar')){
            e.target.parentElement.parentElement.remove();
          let id = e.target.parentElement.previousSibling.previousSibling.id;

          let numid = id.split(".");

            eliminarProductoLista(numid[1]);
          }
          if(e.target.id === 'vaciar'){
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Eliminaras todos los pedidos!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, vaciar carrito!'
              }).then((result) => {
                if (result.value) {
                  let ids = document.querySelectorAll('.item');
                  ids.forEach(item=>{
                    let id = item.id.split('.')[1];
                    item.parentElement.remove();
                    eliminarProductoLista(id);

                  });
                  modificar_total(0,0);
                  Swal.fire(
                    'Vacio!',
                    'El carrito se encuentra vacio',
                    'success'
                  )
                }

              })


          }
          if(e.target.id === 'pedir'){
            let form = document.querySelector("form");
            form.action = "confirmacion_venta.php";
            form.submit();
          }
        });
        document.querySelector('.cuerpo_carrito').addEventListener('change', function modificarCantidad(e){
          e.preventDefault();
          if(e.target.classList.contains('item')){
            let id = e.target.id.split(".");
            let cantidad = e.target.value;
            if(cantidad >= 0){
              if(document.querySelector(`#img_error${id[1]}`).classList.contains("img_error")){
                document.querySelector(`#img_error${id[1]}`).classList.remove("img_error");
              }
                actualizarCantidad(id[1],cantidad);
            }else{
              mensajeError("Los campos no pueden tener cantidades menores a 0", id[1]);
              e.target.value = 0;
            }

          }
        });

      }
      if(document.querySelector(".conf_lista_inm")){
        console.log("Confirmacion compra");
        document.querySelector(".btn-lista-inm").addEventListener('click',function(e){
          e.preventDefault();
          let elemento = e.target;
          if(elemento.classList.contains("cancelar_compra")){
            location.href = "index.php";
          }
          if(elemento.classList.contains("confirmar_pago")){
            pagarCompra(elemento.id);
          }
        });
      }
      if(document.querySelector(".imgs")){
        document.querySelector(".imgs").addEventListener("click", function usuarioFunciones(e){
          e.preventDefault();
          if(e.target.classList.contains("login_usuario_btn")){
              location.href = "login_usuario.php"
          }
          if(e.target.id == "cerrar_sesion"){
            location.href = "index.php?close=true";
          }

        })
      }
    }

    function carritoFuncion(id){
      /**
              Funcion carritoFuncion
              esta funcion incrementamos el numero de articulos en la fila del mismo articulo
              por lo cual solo se necesita el id del producto que se acaba de agregar o
              modificar en el caso de compras, para hacer el UPDATE a la tabla

        **/

        let pedido = new FormData();
        pedido.append('id_producto', id);
        pedido.append('pedido_iniciado', true);
        console.log("Antes de entrar a la condicion");
        if(parseFloat(document.querySelector("#total").textContent) == 0){
          console.log("crear");
            pedido.append('tipo', 'crear');
        }else{
          console.log("agregar");
            pedido.append('tipo', 'agregar');
        }


        let xhr= new XMLHttpRequest();

        xhr.open('POST', './inc/pedidos_modelos.php', true);

        xhr.onload = function(){
            if(this.status == 200 ){

                console.log(xhr.responseText);
                let costo = xhr.responseText;
                addCarrito(costo);
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

        actualizarSESSION(numero_articulos,total_actual);
    }
    function modificar_total(total, num_items){
      let total_compra = document.querySelector('#total');     //Elemento que contiene el total de la compra
      total_compra.textContent = total;
      document.querySelector("#total_carrito").textContent = total_compra.textContent;
      document.querySelector("#numero_items_carrito").textContent = parseInt(num_items);
      actualizarSESSION(num_items,total);
    }

    function actualizarCantidad(id, cantidad){
      let datos = new FormData();
      datos.append("tipo", "modificar");
      datos.append('id_producto', id);
      datos.append('cantidad', cantidad);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "./inc/pedidos_modelos.php", true);
      xhr.onload = function(){
        if(this.status == 200){
          console.log(xhr.responseText);
          let cadena = JSON.parse(xhr.responseText);
          if(cadena.respuesta === "exitoso"){
            let total = 0;
            let num_items = 0;

            let items = document.querySelectorAll(".item");
            items.forEach(item=>{
              total += parseFloat(item.value) * parseFloat(item.dataset.costo);
              num_items += parseInt(item.value);
            });
            modificar_total(total, num_items);
          }else{
            mensajeError("Hubo un error al modficiar la cantidad",0);
          }
        }
      }
      xhr.send(datos);
    }
    function eliminarProductoLista(id){
      let datos = new FormData();
      datos.append('tipo', 'eliminar');
      datos.append('id_producto',id);

      let xhr = new XMLHttpRequest();
      xhr.open('POST', './inc/pedidos_modelos.php', true);
      xhr.onload = function(){
        if(this.status == 200){
          console.log(xhr.responseText);
        }
      }
      xhr.send(datos);
    }

    function actualizarSESSION(numero_articulos, total_actual){
      let datos = new FormData();
      datos.append('carrito', true);
      datos.append('carrito_art', numero_articulos);
      datos.append('carrito_total', total_actual);

      let xhr = new XMLHttpRequest();
      xhr.open('POST', './inc/pedidos_modelos.php', true);
      xhr.onload = function(){
        if(this.status == 200){
          if(numero_articulos <= 0 || total_actual <= 0){
            location.reload();
          }
        }
      }
      xhr.send(datos);
    }
    function mensajeError(mensaje,id){
      let mensaje_error = document.querySelector("#mensaje_error");
      mensaje_error.textContent = mensaje;
      mensaje_error.classList.add("mostrar_error");
      document.querySelector(`#img_error${id}`).classList.add("img_error");
      setTimeout(()=>{
        mensaje_error.classList.remove("mostrar_error");
        document.querySelector(`#img_error${id}`).classList.remove("img_error");
      }, 3000)

    }
    function pagarCompra(id_pedido){
      let datos = new FormData();
      datos.append("tipo", "pagar");
      datos.append("id_pedido", id_pedido);
      let xhr = new XMLHttpRequest();

      xhr.open("POST", "./inc/pedidos_modelos.php", true);
      xhr.onload = function(){
        if(this.status === 200){
          if(xhr.responseText === "chingon" ){
            document.querySelector("#pago_realizado").classList.add("pago_confirmado");
            setTimeout(()=>{

                location.href = "index.php?close=true";
            }, 2000);
          }
        }
      }
      xhr.send(datos);
    }
}//Fin de la carga de pagina
