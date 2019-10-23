
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);

        // document ready
        document.querySelector('#carga').style.display = 'none';
       
       
     
/* =====================================================================================================        
                                    Llamado a funciones principales
===================================================================================================== */                                     
    

        if(document.querySelector('.list-productos')){
            if(!(document.querySelector('.empty-query'))){
                console.log("Ejecuando codigos de listado");
                allChecks();
                eventListenersListadoProductos();
            }    
        } else{
            eventListenersAddProductos();
               
        }  
        /* =====================================================
                            Listado Productos
        ===================================================== */                    
        function eventListenersListadoProductos(){
            document.querySelector('.contenedor-md').addEventListener('click', function(e){
                eventosDeProductos(e.target);
            });    

        }    
        function allChecks(){
            document.querySelector('#allCheckBoxes').addEventListener('click', function(e){
                e.preventDefault();

                let forms = document.querySelectorAll('input[type="checkbox"]');
                let i = forms.length;
                console.log(i);
                
                forms.forEach(function(check){
                    
                    if(check.checked == false){
                        check.checked = true;    
                    }else{
                        check.checked = false;
                    }
                    
                    
                    let selector = `#descripcion-producto${i}`;
                    document.querySelector(selector).classList.toggle('des-prod');
                    check.parentElement.parentElement.parentElement.classList.toggle('boxSin');
                    i--;
                });


            });
        }

        function eventosDeProductos(elemento){

            let idCompleto = elemento.id;
            let id = idCompleto.split(':');
            

            if(elemento.id == `descripcion-toogle:${id[1]}`){ //Boton para mostrar detalles
                let selector = `#descripcion-producto${id[1]}`;
                document.querySelector(selector).classList.toggle('des-prod');
                elemento.parentElement.parentElement.parentElement.classList.toggle('boxSin');
            }     
        
        }
                         
        /* =====================================================
                            Añadir  Productos
        ===================================================== */
        function eventListenersAddProductos(){
            /**BTN SUBMIT CANCELAR */
            document.querySelector('#cancelar').addEventListener('click', function(e){
                e.preventDefault();
                window.location.href = 'listado-productos.php';
            }); 
            document.querySelector('form').addEventListener('submit', function(e){
                e.preventDefault();
               
                let nombre = document.querySelector('#nombre');
                let codigo = document.querySelector('#codigo');
                let descripcion = document.querySelector('#descripcion');
                let costo = document.querySelector('#costo');
                let stock = document.querySelector('#stock');
                let imagen_archivo = document.querySelector('#imagen_archivo');
                
                console.log(nombre.value);
                console.log(codigo.value);
                console.log(descripcion.value);
                console.log(costo.value);
                console.log(stock.value);
                console.log(imagen_archivo.value);

                if((nombre.value.trim() != '') && (codigo.value.trim() != '') && (descripcion.value.trim() != '') && (costo.value.trim()  != '')&& (stock.value.trim()  != '') && (imagen_archivo.value.trim()  != '')){

                    if(correctFormat(imagen_archivo)){
                        /*let form = new FormData;
                        form.append('nombre', nombre.value);
                        form.append('codigo', codigo.value);
                        form.append('descripcion', descripcion.value);
                        form.append('costo', costo.value);
                        form.append('stock', stock.value);
                        form.append('imagen_archivo', imagen_archivo.value);
                        form.append('tipo', 'crear');*/
                        addProducto(new FormData(document.querySelector('form')));
                    }else{
                        showMessage("el formato de la imagen es incorrecto");
                    }


                }else{
                    showMessage("Nop uedes dejar campos vacios");
                }

                
            });
                   
        }
        function addProducto(datos){
            datos.append('tipo', 'crear');
            let xhr = new XMLHttpRequest();
            xhr.open('post','inc/funciones/producto.php',true);
            xhr.onload = function(){
                if(this.status === 200){
                    console.log(xhr.responseText);
                    console.log(JSON.parse(xhr.responseText));
                    let respuesta = JSON.parse(xhr.responseText);
                    if(respuesta.respuesta === 'correcto'){
                        document.querySelector('form').reset();
                        showMessageExito("Producto correctamente agregado");
                    }else{
                        showMessageExito("Error al agregar el producto");
                    }
                }
            }
            xhr.send(datos);

        }
    
        function correctFormat(element){ 
            let dato = element.value;
            if(element.getAttribute('id') === 'imagen_archivo'){  //Validando que sea el input de imagen
              
              let extension = dato.split('.').pop();  //Separando la extencion para validar
              if(extension == 'jpg'){   //Validando la extension correcta
                
                return true;
              }
              return false;
            }
        }
        function showMessage(texto){
            let error = document.querySelector('#campoError');
            if(!(error.classList.contains('campoError2'))){

                let p = document.createElement('p');
                p.textContent = texto;
                error.appendChild(p);
                error.classList.add('campoError2');
                setTimeout( ()=>{
                    p.remove();
                    error.classList.remove('campoError2');
                },3000);
            }
        }
        function showMessageExito(texto){
            let error = document.querySelector('#campoError');
            if(!(error.classList.contains('campoExito'))){

                let p = document.createElement('p');
                p.textContent = texto;
                error.appendChild(p);
                error.classList.add('campoExito');
                setTimeout( ()=>{
                    p.remove();
                    error.classList.remove('campoExito');
                },3000);
            }
        }

       

}  //Documneto Cargado Final
else{
  document.querySelector('#carga').style.display = 'block';
}
}, 100);