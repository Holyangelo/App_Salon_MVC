<?php require_once __DIR__ . '/../templates/nav.php' ?>
<h2 class="nombre-pagina">¿Quieres crear una nueva cita? <br></h2>

<p class="descripcion-pagina">Elige tus servicios</p>

<div id="app">
	<nav class="tabs">
		<button type="button" data-paso="1">Servicios</button>
		<button type="button" data-paso="2">Información Cita</button>
		<button type="button" data-paso="3">Resumen</button>
	</nav>
	<div id="paso-1" class="seccion">
		<h2>Servicios</h2>
		<p class="text-center">Elige tus servicios a continuación</p>
		<div id="servicios" class="listado-servicios"></div>
	</div>
	<div id="paso-2" class="seccion">
		<h2>Tus Datos y Cita</h2>
		<p class="text-center">Coloca tus datos y fecha de tu cita</p>
		<!--Formulario-->
		<form class="formulario">
			<div class="campo">
				<label for="nombre">Nombre</label>
				<input 
				type="text" 
				id="nombre" 
				name="nombre" 
				pattern="[a-zA-Z]*" 
				oninvalid="setCustomValidity('Please enter on alphabets only. ')" 
				required 
				placeholder="Nombre"
				value="<?php echo $nombre ?>"
				disabled>
			</div>
			<div class="campo">
				<label for="fecha">Fecha</label>
				<input 
				type="date" 
				id="fecha" 
				name="fecha"
				min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>" 
				required="">
			</div>
			<div class="campo">
				<label for="hora">Hora</label>
				<input 
				type="time" 
				id="hora" 
				name="hora"
				required="">
			</div>
			<input type="hidden" name="id" id="id" value ="<?php echo $_SESSION["id"]; ?>" disabled>
		</form>
	</div>
	<div id="paso-3" class="seccion contenido-resumen">
		<h2>Resumen</h2>
		<p class="text-center">Verifica que la informacion sea correcta</p>
	</div>

	<div class="paginacion">
		<button id="anterior" class="boton">&laquo; Anterior</button>
		<button id="siguiente" class="boton">Siguiente &raquo;</button>
	</div>
</div>


<?php
$script = "<script src='build/js/app.js'></script>";
?>