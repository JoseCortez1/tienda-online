let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready

        document.querySelector('#carga').style.display = 'none';


        /**BTN SUBMIT ALTA DE ADMIN */
        document.querySelector("#alta-admin").addEventListener('click', function(e){
            e.preventDefault();
            if(document.querySelector("#alta-admin").classList.contains("pag_usuario")){
              window.location.href = 'alta.php?usuario=true';
            }else{
              window.location.href = 'alta.php';
            }

        });


        //Eliminar Administrador
        document.querySelector('.body-admin').addEventListener('click', function(e){
            console.log(e.target);
            if(e.target.classList.contains('eliminar')){
                if(!eliminaLogeado(e.target.parentElement.parentElement.getAttribute('id'))){

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
                }else{
                    console.log("Esto se presiono en admin: ")
                    console.log(e.target);


                }
            }

            if(e.target.classList.contains('consultar-info')){
                let id= e.target.parentElement.getAttribute('id');
                if(document.querySelector(".pag_usuario")){
                    e.target.parentElement.parentElement.action = 'info-contacto.php?alta_usuario=true';
                }else{
                  e.target.parentElement.parentElement.action = 'info-contacto.php';
                }

                e.target.parentElement.parentElement.submit();
            }
            if(e.target.classList.contains('editar')){
                let id= e.target.parentElement.parentElement.getAttribute('id');
                if(document.querySelector(".pag_usuario")){
                    e.target.parentElement.parentElement.parentElement.action = 'editar.php?alta_usuario=true';
                }else{
                  e.target.parentElement.parentElement.parentElement.action = 'editar.php';
                }

                e.target.parentElement.parentElement.parentElement.submit();
            }
            if(e.target.classList.contains('vista')){
                let id= e.target.parentElement.parentElement.getAttribute('id');
                if(document.querySelector(".pag_usuario")){
                    e.target.parentElement.parentElement.parentElement.action = 'info-contacto.php?alta_usuario=true';
                }else{
                    e.target.parentElement.parentElement.parentElement.action = 'info-contacto.php';
                }
                e.target.parentElement.parentElement.parentElement.submit();
            }


        });

        function eliminarElemento(elemento){
            let id= elemento.parentElement.parentElement.getAttribute('id');
            console.log(id);
            let form = new FormData;
            form.append('id', id);

            //ELIMINADO DE LA BASE

            let xhml = new XMLHttpRequest;  //creado el objeto

            if(document.querySelector(".pag_usuario")){
                xhml.open('POST','inc/funciones/remove-admin.php?alta_usuario=true',true); //Abriendo la conexion
            }else{
                xhml.open('POST','inc/funciones/remove-admin.php',true); //Abriendo la conexion
            }


            xhml.onload = function(){ //verificando que se acceda corretamente
                if(this.status === 200){
                    console.log(xhml.responseText);
                    let respuesta = JSON.parse(xhml.responseText);
                    if(respuesta.respuesta === 'correcto'){
                        elemento.parentElement.parentElement.parentElement.remove();
                    }
                }
            }
            xhml.send(form); //enviando datos
        }

        function eliminaLogeado(id_eliminar){

            let etiquetaUserLogin = document.querySelector('.usuarioLog').getAttribute('id').split(':');
            let id_sesion = etiquetaUserLogin[1];
            if(id_eliminar === id_sesion){
                return true;
            }
            return false;
        }

        //Prevencion de eliminar el usuario logeado

        /**La siguiente funcion se agregara en el momneto de eliminar al elemento
         * preguntando si el elemento que se va a eliminar es igual al
         * elemento que se ha logeado en caso de que sa verdad se cierra la sesion
         * a su vez se manda una alerta de lo que pasara, caso contrario se
         * continua con la eliminacion normal
         */
       /* eliminarLogin('click', function(e){
            if(e.target.classList.contains('usuarioLog')){
                let id = e.target.id
            }
        });
        */

    }//Fin de revision de carga del Documento
    else{
        document.querySelector('#carga').style.display = 'block';
    }
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
