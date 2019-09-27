console.log("Antes");
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready


        var form = document.querySelector("form");
        form.addEventListener("blur", function( event ) {  //listener blur para evaluar el campo una vez fuera de el 
          
          let dato = event.target.value;
          if(dato.trim() != ''){//quitando los campos vacioss 
            if(event.target.getAttribute('id') === 'imagen_archivo'){  //Validando que sea el input de imagen
              console.log("this is the document");
              let extension = dato.split('.').pop();  //Separando la extencion para validar
              if(extension == 'jpg'){   //Validando la extension correcta
                console.log("it is a valid format");
              }else{
                console.log("it isn't valid format");
              }
            }
          }else{
            console.log("sin datos");
          }
          
        }, true);

    }
  }, 100);
