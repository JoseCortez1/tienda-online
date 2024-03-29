let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready
        document.querySelector('#carga').style.display = 'none';
        /**Index  */
        document.querySelector('#registro').addEventListener('click', function(e){
            e.preventDefault();
            let correo = document.querySelector('#correo');
            let pass = document.querySelector('#pass');
            
            if(correo.value.trim() != ''  && pass.value.trim() != ''){
              verificarUsuario(correo.value, pass.value);
            }else{
  
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'No puedes dejar campos vacios!'
              });        
            }
  
          });

          function verificarUsuario(correo, pass){
            let datos = new FormData();

            datos.append('correo' , correo);
            datos.append('pass' , pass);
            datos.append('tipo' , 'verificar');

            let xhr = new XMLHttpRequest(); //creando un xhr

            xhr.open('POST', 'inc/funciones/modelo-registro.php', true); //Abriendo la conexion

            xhr.onload = function(){
              if(this.status === 200){ //verificando la conexion
                console.log(xhr.responseText);
                let respuesta = JSON.parse(xhr.responseText);
                if(respuesta.respuesta === 'correcto'){
                  window.location.href = 'principal.php';
                }else{
                  console.log(respuesta.respuesta);
                  Swal.fire({
                    type: 'error',
                    title: 'Error: ',
                    text: "El correo o la contraseña son incorrectos"
                  });        
                
                }
              }
            }

            xhr.send(datos); //enviando los datos

          }




        }  //Documneto Cargado Final
        else{
          document.querySelector('#carga').style.display = 'block';
      }
    }, 100);  