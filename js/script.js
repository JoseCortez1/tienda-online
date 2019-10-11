
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready



        /**BTN SUBMIT CANCELAR */
        document.querySelector('#cancelar').addEventListener('click', function(e){
          e.preventDefault();

          window.location.href = 'listadoAdmin.php';
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
            //the target doesn't have data
            showMessage(event.target, "campo vacio");
            
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
          if( (nombre.trim() === '') || (apellido.trim() === '') || (correo.trim() === '') || (!(passwordValidate(password))) ||  (rol.trim() === '') || (imagen_archivo.value.trim() === '') ){

            showMessage(null, "campo vacio ");
          }  
          else{
            if(correctFormat(imagen_archivo)){
              form.action = "inc/funciones/add-admin.php";
              form.submit();
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

    }
  }, 100);
