
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready





        var form = document.querySelector("form");
        form.addEventListener("blur", function( event ) {  //listener blur para evaluar el campo una vez fuera de el 
          
          let dato = event.target.value;
          if(dato.trim() != ''){
            //the target has data
            notEmptyData(event.target);
            correctFormat(event.target);
            if(event.target.getAttribute('id') == "password"){
              console.log("pass: ");
              let pass = event.target.value + '';
              console.log(pass.length);
              passwordValidate(event.target.value);
            }

          }else{
            //the target doesn't have data
            emptyData(event.target);
            
          }
          
        }, true);

        //funciones

        form.addEventListener('submit', (e)=>{
          e.preventDefault();
          let nombre = document.querySelector('#nombre').value,
              correo = document.querySelector('#correo').value,
              password = document.querySelector('#password').value,
              apellido = document.querySelector('#apellido').value,
              rol = document.querySelector('#rol').value,
              imagen_archivo = document.querySelector('#imagen_archivo');

          console.log(password.length);
          if( (nombre.trim() === '') || (apellido.trim() === '') || (correo.trim() === '') || (password.trim() === '') || (rol.trim() === '') || (imagen_archivo.value.trim() === '') ){
            console.log(nombre.trim());
            console.log(apellido.trim());
            console.log(correo.trim());
            console.log(passwordValidate(password));
            console.log(password.trim());
            console.log(rol.trim());
            console.log(imagen_archivo.value.trim());
            console.log("data incomplete".trim());
          }else{
            if(correctFormat(imagen_archivo)){
              console.log("Final step");
              form.action = "bienvenido.php";
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
              emptyData(element);
            }
            return false;
          }
        }

        function emptyData(element){
          element.classList.add("error");
          createElement(element);

        }
        function notEmptyData(element){
          let removeElement = document.querySelector("#" + element.getAttribute('id') + "error");
          if(removeElement){
            removeElement.remove();
          }
            
        }


        function createElement(element){
          
          let exist = document.querySelector("#" + element.getAttribute('id') + 'error');
          console.log(exist);
          if(exist === null){
            console.log("No existe un campo eror");
            let p = document.createElement('p');
            p.innerHTML = `Informacion incompleta o erronea : ${element.getAttribute('name')}`;
            let valueId = element.getAttribute('id') + "error";
  
            let contenedorE = document.createElement('div');
            
            contenedorE.appendChild(p);
            contenedorE.setAttribute('id', valueId);
            contenedorE.classList.add('error', 'campoError');
        
            document.querySelector('#campoError').appendChild(contenedorE);  
          }
        }
        function passwordValidate(pass){
          console.log("passValidate");
          if(pass.length >= 8){
            return true;
          }
          let password = document.querySelector('#password');
          
          let exist = document.querySelector("#" + password.getAttribute('id') + 'error');
          if(exist === null){
            let p = document.createElement('p');
            p.innerHTML = "La contraseña debe contener al menos 8 caracteres";
            let valueId = "passworderror";
  
            let contenedorE = document.createElement('div');
            
            contenedorE.appendChild(p);
            contenedorE.setAttribute('id', valueId);
            contenedorE.classList.add('error', 'campoError');
        
            document.querySelector('#campoError').appendChild(contenedorE);  
          }
          return false;
        }

    }
  }, 100);
