//2- variable paso
let paso = 1;
//3- esto se crea despues de paginasiguiente y anterior
const inicial = 1;
const final = 3;

//5- creamos el objeto de la cita
const cita = {
	nombre: '',
	fecha: '',
	hora: '',
	servicios: []
}

/*DOMContentLoaded – el navegador HTML está completamente cargado y 
el árbol DOM está construido, pero es posible que los recursos externos como <img> 
y hojas de estilo aún no se hayan cargado.*/
document.addEventListener("DOMContentLoaded", () =>{
	iniciarApp();
});

const iniciarApp = () =>{
	//2- mostramos las secciones
	mostrarSeccion();
	// 1- registramos las funciones que utilizaremos
	tabs(); //cambia la seccion cuando se presionan los tabs
	//3- agrega o quita los botones del paginador
	botonesPaginador();
	//3- incrementar el valor de paso y pasa la siguiente pagina
	paginaSiguiente();
	//3- decrementa el valor de paso y devuelve a lpagina anterior
	paginaAnterior();
	//4 - ESTO SE CREA LUEGO DE QUE CREARAMOS EL CONTROLADOR DE LA API
	consultarAPI(); //consulta la api en el backend php

}

const mostrarSeccion = () => {
	//ocultar la seccion que tenga la clase de mostrar
	const seccionAnterior = document.querySelector('.mostrar');
	//si la clase de mostrar existe, entonces agrega el remove
	if(seccionAnterior){
		seccionAnterior.classList.remove("mostrar");
	}
	//si la clase de actual existe, entonces agrega el remove
	const tabAnterior = document.querySelector('.actual');
	if (tabAnterior) {
		tabAnterior.classList.remove("actual");
	};
	//creamos un template para seleccionar la variable de forma dinamica
	const pasoSelector = `#paso-${paso}`;
	//Seleccionar la seccion con el paso
	const seccion = document.querySelector(pasoSelector);
	//añadimos la clase mostrar
	seccion.classList.add("mostrar");
	//Resalta el tab actual
	const tab = document.querySelector(`[data-paso="${paso}"]`);
	tab.classList.add("actual");
}

const tabs = () =>{
	//querySelectorAll(".tabs button") seleccionamos todos los botones de la clase tabs
	// que tengan la etiqueta html button
	const botones = document.querySelectorAll(".tabs button");
	//iteramos sobre el querySelectorAll
	botones.forEach((boton)=>{
		//procedemos a agregarle un evento a cada boton del array
		// e = evento que se va a registrar
		boton.addEventListener("click", (e)=>{
			//dataset nos indica la informacion del atributo data del elemento html
			//con esto podemos saber a cual estamos dando click
			//paso esta siendo leido como un string, debemos convertirlo a entero
			paso = parseInt(e.target.dataset.paso);
			//llamamos a la funcion de mostrar seccion
			mostrarSeccion();
			//esto se manda a llamar despues de crear la funcion de mostrarSeccion
			//esto se crea mucho despues 
			botonesPaginador();
		})
	})
}

const botonesPaginador = () =>{
	//seleccionamos el elemento por el ID
	const paginaSiguiente = document.querySelector("#siguiente");
	const paginaAnterior = document.querySelector("#anterior");
	//verificamos el paso
	if(paso === 1){
		paginaAnterior.classList.add("ocultar");
		paginaAnterior.setAttribute("disabled", "");
		paginaSiguiente.classList.remove("ocultar");
		paginaSiguiente.removeAttribute("disabled", "");
	}else if(paso === 3){
		paginaAnterior.classList.remove("ocultar");
		paginaAnterior.removeAttribute("disabled", "");
		paginaSiguiente.classList.add("ocultar");
		paginaSiguiente.setAttribute("disabled", "");
	}else if(paso === 2){
		paginaAnterior.classList.remove("ocultar");
		paginaAnterior.removeAttribute("disabled", "");
		paginaSiguiente.classList.remove("ocultar");
		paginaSiguiente.removeAttribute("disabled", "");
	}

	//esto se hace despues de crear la logica de paginasiguiente y pagina anterior
	mostrarSeccion();
}

//esto se crea despues de botones paginador
const paginaSiguiente = () =>{
	const paginaSiguiente = document.querySelector("#siguiente");
	paginaSiguiente.addEventListener("click", () =>{
		if(paso >= final) return;// si paso es mayor al valor 
		//final entonces termina la ejecucion
		paso++; //incrementa el paso
		//llamamos a la funcion para comprobar el tab
		botonesPaginador();
	});
}

const paginaAnterior = () =>{
	const paginaAnterior = document.querySelector("#anterior");
	paginaAnterior.addEventListener("click", () =>{
		if(paso <= inicial) return; // si paso es menor al valor 
		//inicial entonces termina la ejecucion
		paso--; //decrementa el paso
		//llamamos a la funcion para comprobar el tab
		botonesPaginador();
	});
}

const consultarAPI = async() =>{
	/*siempre se debe usar trycatch al momento de consultar DB o API*/
	try {
		// statements
		/*creamos la url o endpoint*/
		const url = "http://localhost:3000/api/servicios";
		/*usamos fetch para consultar, usamos await para esperar que se complete*/
		const resultado = await fetch(url);
		/*mostramos resultado*/
		const servicios = await resultado.json();
		/*mostramos el HTML*/
		mostrarServicios(servicios)
	} catch(e) {
		// statements
		console.log(e);
	}
}

//6 - creamos el metodo de seleccion de servicio
const seleccionarServicio = (servicio) => {
	//7- crear un selector para el id de servicio
	const { id } = servicio;
	//6-desestructuramos el arreglo de servicios para proceder a llenarlo
	const { servicios } = cita;
	/*8-movemos el selector de divServicio */
	const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
	/*8- comprobar si un servicio ya fue agregado */
	/*usamos el metodo some(clave => clave (comparador) valor a comparar) */
	if (servicios.some(agregado => agregado.id === id)) {
		//eliminar servicios de la seleccion o filtrarlo
		cita.servicios = servicios.filter(agregado => agregado.id !== id);
		divServicio.classList.remove("seleccionado");
	} else {
		/* 8 - Movemos agregar a esta condicion */
		cita.servicios = [...servicios, servicio];
		/*8-movemos el classlist add */
		divServicio.classList.add("seleccionado");
	}
	//6-IMPORTANTE! reescribo el arreglo de servicios en cita
	//pero debo generar una copia de los servicios agregados usando "..."
	// y luego le agrego el nuevo servicio
	//cita.servicios = [...servicios, servicio];
	//7- creamos un queryselecto para el id de servicio
	//const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
	//divServicio.classList.add("seleccionado");
			console.log(cita);
	}

//4- mostramos los servicios en el html de la api
const mostrarServicios = (servicios) =>{
	/*iteramos sobre el json*/
	servicios.forEach((e) =>{
		/*desestructuramos*/
		const {id, nombre, precio} = e;
		/*creamos los elementos del html*/
		/*Nombre*/
		const nombreServicio = document.createElement("P");
		nombreServicio.classList.add("nombre-servicio");
		nombreServicio.textContent = nombre;
		/*Precio*/
		const precioServicio = document.createElement("P");
		precioServicio.classList.add("precio-servicio");
		precioServicio.textContent = `$${precio}`;
		/*creamos el contenedor*/
		const servicioDiv = document.createElement("DIV");
		servicioDiv.classList.add("servicio");
		servicioDiv.dataset.idServicio = id;
		//5 - agregar al objeto de cita
		servicioDiv.onclick = () => { //debemos hacerlo mediante un callback
			seleccionarServicio(e); //enviamos el servicio "e"
		};
		/*colocamos los atributos dentro del contenedor*/
		servicioDiv.appendChild(nombreServicio);
		servicioDiv.appendChild(precioServicio);
		/*Inyectamos el HTML*/
		document.querySelector("#servicios").appendChild(servicioDiv);

	});
}