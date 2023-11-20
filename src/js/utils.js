$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  });

document.addEventListener('DOMContentLoaded', function() {
  const btnActualizar = document.querySelectorAll('#actualizar_servicio');
  btnActualizar.forEach(value => {
    value.addEventListener('click', (e) => {
      obtenerServicio(value.getAttribute('data-id'));
    });
  });

  const btnEliminar = document.querySelectorAll('#eliminar_servicio');
  btnEliminar.forEach(value => {
    value.addEventListener('click', (e) => {
      obtenerServicio(value.getAttribute('data-id'));
    });
  });
});

async function obtenerServicio(value) {
  await fetch('http://localhost:3000/servicios/obtener?id='+value)
  .then(response => response.json())
  .then(res => llenarCampos(res))
  .catch(err => console.log(err));
}

function llenarCampos(res){
  const idServicioActualizar = document.querySelector('#id_servicios').value = res.id;
  const nombreServicioActualizar = document.querySelector('#nombre_servicios').value = res.nombre;
  const precioServicioActualizar = document.querySelector('#precio_servicios').value = res.precio;
  const idServicioEliminar = document.querySelector('#id_servicios_eliminar').value = res.id;
  const nombreServicioEliminar = document.querySelector('#nombre_servicios_eliminar').value = res.nombre;
  const precioServicioEliminar = document.querySelector('#precio_servicios_eliminar').value = res.precio;
  /*llenamos los campos */
}

//22 - limpiamos HTML
const limpiarHTML = () => {
  while(resultado.firstChild){
      resultado.removeChild(resultado.firstChild);
  }
}