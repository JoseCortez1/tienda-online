console.log("Antes");
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

 
          }else{
            //the target doesn't have data
            emptyData(event.target);
          }
          
        }, true);

        //funciones
        function correctFormat(element){
          let dato = element.value;
          if(element.getAttribute('id') === 'imagen_archivo'){  //Validando que sea el input de imagen
            
            console.log("this is the document");
            let extension = dato.split('.').pop();  //Separando la extencion para validar
            if(extension == 'jpg'){   //Validando la extension correcta
              console.log("it is a valid format");
              notEmptyData(element);
            }else{
              console.log("it isn't valid format");
              emptyData(element);
            }
          }
        }

        function emptyData(element){
          element.classList.add('error');
          document.querySelector('#campoError').classList.add("campoError", "error");
        }
        function notEmptyData(element){
          element.classList.remove('error');
          document.querySelector('#campoError').classList.remove('campoError', 'error');
        }

    }
  }, 100);
