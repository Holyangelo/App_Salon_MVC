//2- variable paso
let paso = 1;
//3- esto se crea despues de paginasiguiente y anterior
const inicial = 1;
const final = 3;

//5- creamos el objeto de la cita
const cita = {
	id: "",
	nombre: '',
	fecha: '',
	hora: '',
	servicios: []
}

/*DOMContentLoaded – el navegador HTML está completamente cargado y 
el árbol DOM está construido, pero es posible que los recursos externos como <img> 
y hojas de estilo aún no se hayan cargado.*/
document.addEventListener("DOMContentLoaded", () => {
	iniciarApp();
});

const iniciarApp = () => {
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
	//21 - guardamos el id 
	idCliente();
	//9 - Nombre del cliente
	nombreCliente();
	//10- añade la fecha de la cita en el objeto
	seleccionarFecha();
	//11 - añade la hora a la cita en el objeto
	seleccionarHora();
	//13 - mostrar resumen
	//mostrarResumen();
}

const mostrarSeccion = () => {
	//ocultar la seccion que tenga la clase de mostrar
	const seccionAnterior = document.querySelector('.mostrar');
	//si la clase de mostrar existe, entonces agrega el remove
	if (seccionAnterior) {
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

const tabs = () => {
	//querySelectorAll(".tabs button") seleccionamos todos los botones de la clase tabs
	// que tengan la etiqueta html button
	const botones = document.querySelectorAll(".tabs button");
	//iteramos sobre el querySelectorAll
	botones.forEach((boton) => {
		//procedemos a agregarle un evento a cada boton del array
		// e = evento que se va a registrar
		boton.addEventListener("click", (e) => {
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

const botonesPaginador = () => {
	//seleccionamos el elemento por el ID
	const paginaSiguiente = document.querySelector("#siguiente");
	const paginaAnterior = document.querySelector("#anterior");
	//verificamos el paso
	if (paso === 1) {
		paginaAnterior.classList.add("ocultar");
		paginaAnterior.setAttribute("disabled", "");
		paginaSiguiente.classList.remove("ocultar");
		paginaSiguiente.removeAttribute("disabled", "");
	} else if (paso === 3) {
		paginaAnterior.classList.remove("ocultar");
		paginaAnterior.removeAttribute("disabled", "");
		paginaSiguiente.classList.add("ocultar");
		paginaSiguiente.setAttribute("disabled", "");
		//15 - si el pase es resumen, mandamos a llamar la funcion
		if (paso === 3) {
			mostrarResumen();
		};
	} else if (paso === 2) {
		paginaAnterior.classList.remove("ocultar");
		paginaAnterior.removeAttribute("disabled", "");
		paginaSiguiente.classList.remove("ocultar");
		paginaSiguiente.removeAttribute("disabled", "");
	}

	//esto se hace despues de crear la logica de paginasiguiente y pagina anterior
	mostrarSeccion();
}

//esto se crea despues de botones paginador
const paginaSiguiente = () => {
	const paginaSiguiente = document.querySelector("#siguiente");
	paginaSiguiente.addEventListener("click", () => {
		if (paso >= final) return;// si paso es mayor al valor 
		//final entonces termina la ejecucion
		paso++; //incrementa el paso
		//llamamos a la funcion para comprobar el tab
		botonesPaginador();
	});
}

const paginaAnterior = () => {
	const paginaAnterior = document.querySelector("#anterior");
	paginaAnterior.addEventListener("click", () => {
		if (paso <= inicial) return; // si paso es menor al valor 
		//inicial entonces termina la ejecucion
		paso--; //decrementa el paso
		//llamamos a la funcion para comprobar el tab
		botonesPaginador();
	});
}

const consultarAPI = async () => {
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
	} catch (e) {
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
}

//4- mostramos los servicios en el html de la api
const mostrarServicios = (servicios) => {
	/*iteramos sobre el json*/
	servicios.forEach((e) => {
		/*desestructuramos*/
		const { id, nombre, precio } = e;
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

const idCliente = () => {
	const idUsuario = document.querySelector("#id").value;
	cita.id = idUsuario;
}

const nombreCliente = () => {
	//Creamos el selector para el atributo y su valor
	const nombre = document.querySelector("#nombre").value;
	//asignamos el valor al objeto 
	cita.nombre = nombre;
}

const seleccionarFecha = () => {
	const fecha = document.querySelector("#fecha");
	fecha.addEventListener("input", (e) => {
		//condicionar la seleccion de la fecha
		const dia = new Date(e.target.value).getUTCDay();
		if ([0].includes(dia)) {
			fecha.classList.add("bg-danger", "text-white");
			mostrarAlerta(false, "Los dias domingo no trabajamos");
			e.target.value = "";
		} else {
			//evitar reservar dia anterior
			//instanciamos DATE con el valor de de la fecha seleccionada
			/*const diaSeleccionado = new Date(e.target.value);
			//creamos el objeto con la fecha actual
			const tiempoTranscurrido = Date.now();
			//formateamos el objeto con la fecha actual
			const hoy = new Date(tiempoTranscurrido);
			//comprobamos si la fecha seleccionada es menor a la fecha actual
			if (diaSeleccionado < hoy) {
				return mostrarAlerta(false, 
					"No puedes seleccionar una fecha anterior al dia de hoy");
			};*/
			//Si la fecha no es domingo, agregamos al objeto
			fecha.classList.remove("bg-danger", "text-white");
			cita.fecha = e.target.value;
		}
		//agregar el valor al objeto
		//cita.fecha = fecha.value;
	});
}

//12- creamos la funcion para seleccionar la hora
const seleccionarHora = () => {
	const hora = document.querySelector("#hora");
	hora.addEventListener("input", (e) => {
		//tomamos el valor de la hora
		const horaSeleccionada = e.target.value;
		const horaSeparada = horaSeleccionada.split(':');
		if (horaSeparada[0] >= 17 || horaSeparada[0] < 8) {
			e.target.value = "";
			mostrarAlerta(false, "Solo trabajamos de 8AM hasta 5PM");
		} else {
			cita.hora = e.target.value;
		}
	});
}

//14 - creamos el mostrar resumen
const mostrarResumen = () => {
	const resumen = document.querySelector(".contenido-resumen");
	//16 - limpiamos el HTML
	limpiarHTML(resumen);
	const { servicios } = cita;
	if (Object.values(cita).includes("") || servicios.length === 0) {
		return mostrarAlerta(false, "Debes llenar todos los datos");
	}

	//17 - formatear el div de resumen
	const { nombre, fecha, hora } = cita;
	const dl = document.createElement("dl");
	dl.classList.add("row");
	const nombreCliente = document.createElement("dt");
	nombreCliente.classList.add("col-sm-3", "title-resume");
	nombreCliente.textContent = "Nombre del Cliente:";
	const nombreDescription = document.createElement("dd");
	nombreDescription.classList.add("col-sm-9", "data-resume");
	nombreDescription.textContent = nombre;
	const fechaCliente = document.createElement("dt");
	fechaCliente.classList.add("col-sm-3", "title-resume");
	fechaCliente.textContent = "Fecha de Reserva:";
	//formateamos la fecha en español
	const fechaObj = new Date(fecha);
	//obtengo el mes
	const mes = fechaObj.getMonth();
	//cada vez que use new date debo sumarle 1
	//como lo usare 2 veces se le suma 2
	//obtengo el dia
	const dia = fechaObj.getDate() + 2;
	//obtengo el año
	const year = fechaObj.getFullYear();
	//creo un nuevo objeto de fecha para poder formatearlo
	const fechaUTC = new Date(Date.UTC(year, mes, dia));
	//añado las opciones, long = completo numeric = numero
	const opciones = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
	//una vez creo las opciones para cada dato, elijo el idioma es-ES, en-US, es-MX
	const fechaFormateada = fechaUTC.toLocaleDateString('es-ES', opciones);
	const fechaDescription = document.createElement("dd");
	fechaDescription.classList.add("col-sm-9", "data-resume");
	fechaDescription.textContent = fechaFormateada;
	const horaCliente = document.createElement("dt");
	horaCliente.classList.add("col-sm-3", "title-resume");
	horaCliente.textContent = "Hora de Reserva:";
	const horaDescription = document.createElement("dd");
	horaDescription.classList.add("col-sm-9", "data-resume");
	horaDescription.textContent = hora;
	const serviciosCliente = document.createElement("dt");
	serviciosCliente.classList.add("col-sm-3", "title-resume");
	serviciosCliente.textContent = "Servicios adquiridos:";
	const contenedorServicios = document.createElement("dd");
	contenedorServicios.classList.add("col-sm-9");
	const serviciosLista = document.createElement("ul");
	serviciosLista.classList.add("list-group");
	let totalServicios = 0;
	servicios.forEach(element => {
		let el = document.createElement("li");
		el.classList.add("list-group-item");
		el.textContent = element.nombre + " $" + element.precio;
		totalServicios = totalServicios + parseInt(element.precio);
		serviciosLista.appendChild(el);
	});
	const totalLista = document.createElement("li");
	totalLista.classList.add("list-group-item", "fw-bold");
	totalLista.textContent = "Total: $" + totalServicios;
	serviciosLista.appendChild(totalLista);

	//18 - boton para reservar una cita
	const reservarBtn = document.createElement("button");
	reservarBtn.classList.add("btn", "btn-default", "boton");
	reservarBtn.textContent = "Reservar";
	reservarBtn.onclick = () => {
		reservarCita();
	}
	dl.appendChild(nombreCliente);
	dl.appendChild(nombreDescription);
	dl.appendChild(fechaCliente);
	dl.appendChild(fechaDescription);
	dl.appendChild(horaCliente);
	dl.appendChild(horaDescription);
	contenedorServicios.appendChild(serviciosLista);
	dl.appendChild(serviciosCliente);
	dl.appendChild(contenedorServicios);
	resumen.appendChild(dl);
	resumen.appendChild(reservarBtn);
}

//19 - creamos la funcion
const reservarCita = async () => {
	//desestructuramos
	const { id, nombre, hora, fecha, servicios } = cita;
	//iteramos sobre los servicios para enviarlos
	//usamos map para seleccionar las coincidencias y almacenarlas
	const idServicios = servicios.map((servicio) => servicio.id);
	const url = "http://localhost:3000/api/citas";
	//creo los datos
	const data = new FormData();
	data.append("usuarioId", id);
	data.append("nombre", nombre);
	data.append("hora", hora);
	data.append("fecha", fecha);
	data.append("servicios", idServicios);
	const options = {
		method: "POST", // *GET, POST, PUT, DELETE, etc.
		/*mode: "cors", // no-cors, *cors, same-origin
		cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
		//credentials: "same-origin", // include, *same-origin, omit
		headers: {
			"Content-Type": "application/json",
			// 'Content-Type': 'application/x-www-form-urlencoded',
		},
		//redirect: "follow", // manual, *follow, error
		//referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
		*/
		body: data // body data type must match "Content-Type" header
	}

	const response = await fetch(url, options);
	const resultado = await response.json();
	if (resultado.resultado === true) {
		mostrarAlerta(true, "Cita Reservada");
		const btn = document.querySelector(".boton");
		btn.remove();
		//btn.setAttribute("disabled", "");
		setTimeout(() => {
			window.location.reload();
		}, 3000);
	}
}

const mostrarAlerta = (status, msg = "") => {
	const toast = document.querySelector(".info");
	if (toast) {
		return;
	};
	const color =
		status === true ? "linear-gradient(to right, #a2f5b8, #47ff78)"
			: "linear-gradient(to right, #f5768d, #e03857)";
	Toastify({
		text: msg,
		className: "info",
		style: {
			background: color,
			color: "#fff"
		},
		duration: 2000
	}).showToast();
}

const mostrarAlertaDeprecated = (tipo, mensaje, elemento, desaparece = true) => {
	const alertaPrevia = document.querySelector(".alerta");
	if (alertaPrevia) {
		alertaPrevia.remove();
	};
	const alerta = document.createElement("div");
	alerta.classlist.add("alerta", tipo);
	alerta.textContent = mensaje;

	const referencia = document.querySelector(elemento);
	referencia.appendChild(alerta);

	if (desaparece) {
		setTimeout(() => {
			alerta.remove();
		}, 3000);
	};
}

const limpiarHTML = (selector) => {
	while (selector.firstChild) {
		selector.removeChild(selector.firstChild);
	}
}