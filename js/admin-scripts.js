

let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready

        /**BTN SUBMIT ALTA DE ADMIN */
        document.querySelector("#alta-admin").addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = 'alta.php';
        });

        document.querySelector('.body-admin').addEventListener('click', function(e){
            console.log(e.target);
            if(e.target.classList.contains('eliminar')){
                Swal.fire({
                    title: '¿Estas seguro(a)?',
                    text: "No puedes revertir esta opción!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrar!'
                  }).then((result) => {
                    if (result.value) {
                        eliminarElemento(e.target);
                      Swal.fire(
                        'Eliminado!',
                        'El Administrador fue eliminado',
                        'success'
                      )
                    }
                  })


                

            }

        });

        function eliminarElemento(elemento){
            let id= elemento.parentElement.getAttribute('id');
            console.log(id);
            let form = new FormData;
            form.append('id', id);
            
            //ELIMINADO DE LA BASE
            
            let xhml = new XMLHttpRequest;  //creado el objeto


            xhml.open('POST','inc/funciones/remove-admin.php',true); //Abriendo la conexion

            xhml.onload = function(){ //verificando que se acceda corretamente
                if(this.status === 200){
                    console.log(xhml.responseText);
                    let respuesta = JSON.parse(xhml.responseText);
                    if(respuesta.respuesta === 'correcto'){
                        elemento.parentElement.remove();
                    }
                }
            }
            xhml.send(form); //enviando datos
        }

    }//Fin de revision de carga del Documento
}, 100);


            /**
             * AJAX Con JQUERY
             function(confirm('borrar registro ' + fila + '?')){
                 $.ajax({
                     url    : 'respuesta.txt',
                     type   : 'post',
                     dataType:'text',
                     data   :'id='+fila,
                     success:function(res){
                         if(res === 1){
                             $('#fila'+fila).hide();

                         }else{
                             alert('Error en la elimincion');
                         }
                     },error: function(){
                         alert('Error al conectar con el servidor')
                     }
                 }); //Terminacion del Ajax
             }

             */