window.onload = function(){

  eventeListeners();



  function eventeListeners(){
    document.querySelector("#login_usuario").addEventListener('submit', function envioInformacion(e){
      e.preventDefault();
      let correo = document.querySelector("#correo_login").value;
      let pass = document.querySelector("#pass_login").value;
      if(correo.trim() != ''  && pass.trim() != ''){
        verificarUsuario(correo, pass);
      }else{

        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'No puedes dejar campos vacios!'
        });
      }
    });
    document.querySelector("#crear_usuario").addEventListener('submit', function envioInformacion(e){
      e.preventDefault();
      let form = new FormData(document.querySelector("#crear_usuario"));
      let nombre = document.querySelector("#nombre_create").value;
      let correo = document.querySelector("#correo_create").value;
      let pass = document.querySelector("#pass_create").value;
      let pass_confirm = document.querySelector("#pass_confirm").value;

      if((nombre.trim() != "") && (correo.trim() != "") && (pass.trim() != "") && (pass_confirm.trim() != "")){
        
        if(pass.length >= 8 ){

          if(pass === pass_confirm){
            form.append("tipo", 'crear');
            regristrarUsuario(form);
          }else{
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Las contraseñas no coinciden!'
            });
          }
        }else{
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Lacontraseña debe tener al menos 8 caracteres!'
          });
        }
      }else{
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'No puedes dejar campos vacios!'
        });
      }
    });
    document.querySelector("body").addEventListener('click',function(e){
      if(!e.target.parentElement.parentElement.classList.contains("displayNone")){
        if(e.target.classList.contains("toogle")){
          document.querySelector(".displayNone").classList.remove("displayNone");
          e.target.parentElement.parentElement.classList.add("displayNone");
        }
      }
    });

  }

  function verificarUsuario(correo, pass){
    let datos = new FormData();

    datos.append('correo' , correo);
    datos.append('pass' , pass);
    datos.append('tipo' , 'verificar');

    let xhr = new XMLHttpRequest(); //creando un xhr

    xhr.open('POST', 'inc/modelo-usuarios.php', true); //Abriendo la conexion

    xhr.onload = function(){
      if(this.status === 200){ //verificando la conexion
        console.log(xhr.responseText);
        let respuesta = JSON.parse(xhr.responseText);
        if(respuesta.respuesta === 'correcto'){
          location.href = 'index.php';
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

  function regristrarUsuario(form){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./inc/modelo-usuarios.php", true);
    xhr.onload = function(){
      if(this.status === 200){
        console.log(JSON.parse(xhr.responseText));
        let respuesta = JSON.parse(xhr.responseText);
        if(respuesta.tipo == "error"){
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: respuesta.respuesta
          });
        }
        if(respuesta.tipo == "correcto"){
          Swal.fire({
            type: 'success',
            title: 'Yeii!!',
            text: respuesta.respuesta
          });
          document.querySelector("#crear_usuario").reset();
          location.href = 'index.php';
        }
      }
    }
    xhr.send(form);
  }

}//Documento cargado
