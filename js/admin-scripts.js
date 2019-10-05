

let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
        // document ready

        /**BTN SUBMIT ALTA DE ADMIN */
        document.querySelector("#alta-admin").addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = 'alta.php';
        });

        document.querySelector('.body-admin').addEventListener('click', function(e){
            console.log(e.target);
            if(e.target.classList.contains('eliminar')){
                
                let id= e.target.parentElement.getAttribute('id');
                console.log(id);
                let form = new FormData;
                form.append('id', id);
                
                //ELIMINADO DE LA BASE
                
                let xhml = new XMLHttpRequest;  //creado el objeto
    
    
                xhml.open('POST','inc/funciones/remove-admin.php',true); //Abriendo la conexion
    
                xhml.onload = function(){ //verificando que se acceda corretamente
                    if(this.status === 200){
                        console.log(xhml.responseText);
                        let respuesta = JSON.parse(xhml.responseText);
                        if(respuesta.respuesta === 'correcto'){
                            e.target.parentElement.remove();
                        }
                    }
                }
                xhml.send(form); //enviando datos
            }
        });

    }
}, 100);