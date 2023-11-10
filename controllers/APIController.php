<?php
/*Creamos el namespace*/
namespace Controllers;

/*Importamos */
use Model\Servicio;
use Model\Cita as Cita;

/*Main Class*/
class APIController{
	// index function
	public static function index(){
		// metodos static heredados no requerimos instanciarlos
		$servicios = Servicio::all();
		//codificamos a formato JSON
		echo json_encode($servicios);
	}

	public static function guardar(){
		// metodos static heredados no requerimos instanciarlos
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$cita = new Cita($_POST);
			//intentamos guardar
			$resultado = $cita->guardar();
			// codificamos a formato JSON
			//enviamos respuesta codificada en json
			echo json_encode($resultado);
		}
	}
}
?>