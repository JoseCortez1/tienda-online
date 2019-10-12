
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready



        /**BTN SUBMIT CANCELAR */
        document.querySelector('#cancelar').addEventListener('click', function(e){
          e.preventDefault();
          if(form.getAttribute('id') === 'crear'){
            window.location.href = 'index.php';
          }else{
            window.location.href = 'listadoAdmin.php';
          }
          
        });
        
        var form = document.querySelector("form");
        form.addEventListener("blur", function( event ) {  //listener blur para evaluar el campo una vez fuera de el 
          
          let dato = event.target.value;
          if(dato.trim() != ''){
            //the target has data
            notEmptyData(event.target);
            if(event.target.getAttribute('id') == "password"){

              passwordValidate(event.target);
            }

          }else{
            
            
            if(form.getAttribute('id') === 'crear' ){
              //the target doesn't have data
              showMessage(event.target, "campo vacio");
            }else{
              //En caso de que sea edicion
              if((event.target.getAttribute('id') === 'imagen_archivo') && (event.target.value === '')){
                console.log('Imagen Vacia en editar');
              }else{
                showMessage(event.target, "campo vacio");
              }

            }
            

          }
          
        }, true);

        //funciones

        form.addEventListener('submit', (e)=>{
          e.preventDefault();
          let nombre = document.querySelector('#nombre').value,
              correo = document.querySelector('#correo').value,
              password = document.querySelector('#password'),
              apellido = document.querySelector('#apellido').value,
              rol = document.querySelector('#rol').value,
              imagen_archivo = document.querySelector('#imagen_archivo');
              console.log(nombre.trim() === '');
              console.log(apellido.trim() === '');
              console.log(correo.trim() === '');
              console.log(!passwordValidate(password));
              console.log(rol.trim() === '');
              console.log(imagen_archivo.value.trim() === '') ;
          if( (nombre.trim() === '') || (apellido.trim() === '') || (correo.trim() === '') || (!(passwordValidate(password))) ||  (rol.trim() === '') ){
            
            showMessage(null, "campo vacio ");
          }  
          else{
            if((imagen_archivo.value.trim() === '') && (form.getAttribute('id') === 'actualizar')){
              //Si Nos encontramos actualizando la foto puede quedar sin informacion ya que pondremas la previamente almacenada
              Swal.fire({
                //Mostramos un mensaje para que se confirme la no addicion de la foto
                title: 'La foto de perfil no fue seleccionada!',
                text: "Esto no realizara cambios en su foto actual",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'No cambiar foto!'
              }).then((result) => {
                if (result.value) {
                  form.action = "inc/funciones/act-admin.php";
                  form.submit();
                  Swal.fire(
                    'Sin cambios!',
                    'La foto actual no se modifico',
                    'success'
                  )
                  form.action = "inc/funciones/act-admin.php";
                  form.submit();
                }
              })
            }else{
              //EN caso de no encnontrarnos en actualizar peidremos una imagene
              if((imagen_archivo.value.trim() === '')){
                showMessage(null, "campo vacio ");
              }else{
                //Al tener todos los datos verificamosel formato correcto de la imagen esto nos sirve en caso de que se quiera modificar la imagene en actualizar y crear

                if(correctFormat(imagen_archivo)){
                  if(form.getAttribute('id') === 'crear'){
                    form.action = "inc/funciones/add-admin.php";
                  }else{
                    form.action = "inc/funciones/act-admin.php";
                  }
                  form.submit();
                }
              }
            }

          }

        });

        function correctFormat(element){ 
          let dato = element.value;
          if(element.getAttribute('id') === 'imagen_archivo'){  //Validando que sea el input de imagen
            
            let extension = dato.split('.').pop();  //Separando la extencion para validar
            if(extension == 'jpg'){   //Validando la extension correcta
              notEmptyData(element);
              return true;
            }else{
              showMessage(element, "formato invalido");
            }
            return false;
          }
        }

        function emptyData(element){
          element.classList.add("error");
        }
        function notEmptyData(element){
          element.classList.remove("error");            
        }

        
        function showMessage(element, texto){ //Mostrar MEnsaje
    
          if(element != null){

            emptyData(element);
          }

          setTimeout(() => {
            if(!document.querySelector('#errorEncontrado')){
              let p = document.createElement('p');
              p.setAttribute('id', 'errorEncontrado');
              p.innerHTML = "Error: " + texto;
          
              document.querySelector('#campoError').appendChild(p); 
              document.querySelector('#campoError').classList.add('error'); 
            }
            let strError = document.querySelector('#errorEncontrado').textContent;
            if(strError.indexOf(texto) < 0){
              document.querySelector('#errorEncontrado').textContent += ", " + texto;
            }

            setTimeout(() =>{
              document.querySelector('#campoError').classList.remove('error'); 
                setTimeout(() => {

                  document.querySelector('#errorEncontrado').remove(); 
                }, 500);    
            },3000);
        },100);
            
        }
        
        function passwordValidate(pass){
          
          if(pass.value.length >= 8){
            notEmptyData(pass);
            console.log("passValidate: true");
            return true;
          }
          showMessage(pass, "contraseña debe contener al menos 8 caracteres");        
          return false;
        }



    }  //Documneto Cargado Final
  }, 100);
