
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


        function eventosDeProductos(elemento){
            console.log(elemento);
            let idCompleto = elemento.id;
            let id = idCompleto.split(':');
            if(elemento.classList.contains('eliminar')){
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "No puedes revertir esta opción!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrar!'
                  }).then((result) => {
                    if (result.value) {
               
                        eliminarElementoDom(elemento.parentElement.parentElement.parentElement);

                      Swal.fire(
                        'Eliminado!',
                        'El producto fue eliminado',
                        'success'
                      )
                    }
                  })
                   
            }
          
        
        }
                         
        /* =====================================================
                            Añadir  Productos
        ===================================================== */
        function eventListenersAddProductos(){
            console.log("hello");
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
                if((nombre.value.trim() != '') && (codigo.value.trim() != '') && (descripcion.value.trim() != '') && (costo.value.trim()  != '')&& (stock.value.trim()  != '') ){

                    if((imagen_archivo.value.trim()  != '') && (document.querySelector('.edit-productos') == null)){

                        if(correctFormat(imagen_archivo)){
                            /*let form = new FormData;
                            form.append('nombre', nombre.value);
                            form.append('codigo', codigo.value);
                            form.append('descripcion', descripcion.value);
                            form.append('costo', costo.value);
                            form.append('stock', stock.value);
                            form.append('imagen_archivo', imagen_archivo.value);
                            form.append('tipo', 'crear');*/
                            let datos = new FormData(document.querySelector('form'))
                            datos.append('tipo', 'crear');
                            addProducto(datos);
                        }else{
                            
                            showMessage("el formato de la imagen es incorrecto");
                        }
                    }else{
                        
                        if(document.querySelector('.edit-productos') != null){
                        let datos = new FormData(document.querySelector('form'));
                        
                        datos.append('tipo', 'actualizar');
                        datos.append('id_actualizar', document.querySelector('header').id);
                        addProducto(datos);
                            
                           
                        }else{
                            showMessage("Nop uedes dejar campos vacios");
                        }
                    }
                }               
                else{
                    
                    showMessage("Nop uedes dejar campos vacios");

                }
                    
                
            });
            if(document.querySelector('#crear')){

                document.querySelector('#crear').addEventListener('change', function(e){
                    if(e.target.value.trim() === ''){
                        inputError(e.target);
                        showMessage("No puedes dejar el campo vacio");
                    }else{
                        inputCorrecto(e.target);
                    }
                    console.log(e.target.value);
                    console.log("hello");
                });
            }
                   
        }
        function addProducto(datos){
            
            let xhr = new XMLHttpRequest();
            xhr.open('post','inc/funciones/producto.php',true);
            xhr.onload = function(){
                if(this.status === 200){
                    console.log(xhr.responseText);
                    console.log(JSON.parse(xhr.responseText));
                    let respuesta = JSON.parse(xhr.responseText);
                    if(datos.get('tipo') === 'crear'){
                        
                        if(respuesta.respuesta === 'correcto'){
                            document.querySelector('form').reset();
                            showMessageExito("Producto correctamente agregado");
                        }else{
                            showMessage(`Error al agregar el codigo: ${respuesta.respuesta}`);
                        }
                    }else if(datos.get('tipo') === 'actualizar'){
                        if((respuesta.respuesta === 'correcto') || (respuesta.respuesta === 'iguales')){
                            showMessageExito("Producto correctamente actualizado");
                            setTimeout( ()=>{
                                location.href = 'listado-productos.php';
                            },500);

                        }else{
                            showMessage(`Error al actualizar el codigo: ${respuesta.respuesta}`);
                        }
                    }else{
                        showMessage(`Error algo inesperado sucedio`);
                    }
                }
            }
            xhr.send(datos);

        }
        /* =====================================================
                            Funciones 
        ===================================================== */
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
        function inputError(elemento){         
            if(!(elemento.classList.contains('inputError'))){

                elemento.classList.add('inputError');
            } 
        }
        function inputCorrecto(elemento){         
            if((elemento.classList.contains('inputError'))){

                elemento.classList.remove('inputError');
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
        function eliminarElementoDom(elementoEliminado){
            
            let id_eliminado = elementoEliminado.id;
            elementoEliminado.remove();
            let datos = new FormData();
            datos.append('id_eliminar', id_eliminado);
            datos.append('tipo','eliminar');
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'inc/funciones/producto.php',true);

            xhr.onload = function(){
                if(this.status === 200){
                    console.log(xhr.responseText);
                }
            }

            xhr.send(datos);

        }

       

}  //Documneto Cargado Final
else{
  document.querySelector('#carga').style.display = 'block';
}
}, 100);



/**
 *           if(elemento.id == `descripcion-toogle:${id[1]}`){ //Boton para mostrar detalles
                
                let selector = `#descripcion-producto${id[1]}`;
                document.querySelector(selector).classList.toggle('des-prod');
                elemento.parentElement.parentElement.parentElement.classList.toggle('boxSin');
            }  
 *         function allChecks(){
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
 */