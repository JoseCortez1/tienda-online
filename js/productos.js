
console.log(document.querySelector('.empty-query'));

if(!(document.querySelector('.empty-query'))){
    console.log("Ejecuando codigos de listado");
    eventListenersListadoProductos();
}else{
    console.log("No Ejecuando codigos de listado");
}


function eventListenersListadoProductos(){
    let checkbox_toogle = document.querySelector('#descripcion-toogle');

    checkbox_toogle.addEventListener('click', function(){
        console.log(checkbox_toogle.value)
        document.querySelector('#descripcion-producto').classList.toggle('des-prod');
        
    });
}