console.log("Antes");
let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready
        console.log("Cargado 1");

        let nombre = document.querySelector('#nombre');
        let apellido = document.querySelector('#apellido');
        let correo = document.querySelector('#correo');
        let password = document.querySelector('#password');

        let rol = document.querySelector('#rol');
        let imagen_archivo = document.querySelector('#imagen_archivo');

        var form = document.querySelector("form");
        form.addEventListener("blur", function( event ) {
          
          console.log(event.target.value);
          let dato = event.target.value;
          if(dato.trim() != ''){
            console.log("con datos");
          }else{
            console.log("sin datos");
          }
          
        }, true);

    }
  }, 100);
