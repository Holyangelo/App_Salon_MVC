//1- verificamos que el contenido este cargado
document.addEventListener("DOMContentLoaded", function () {
    //2- llamamos a iniciar App
    iniciarApp();
});

//3- Creamos la funcion de iniciar la app
function iniciarApp() {
    //4 - llamamos la funcion que buscara por fecha
    buscarPorFecha();
}

function buscarPorFecha() {
    //5 - Creamos el selector para fecha
    const fecha = document.querySelector('#fecha');
    //6 - creamos el evento para la fecha
    fecha.addEventListener('input', (e) => {
        const fechaSeleccionada = e.target.value;
        window.location = `?fecha=${fechaSeleccionada}`;
    });
}