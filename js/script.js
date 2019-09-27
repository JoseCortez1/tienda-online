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
    form.addEventListener("focus", function( event ) {
    event.target.style.background = "pink";    
    }, true);

    }
  }, 100);
