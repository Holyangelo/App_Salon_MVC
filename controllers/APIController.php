<?php
/*Creamos el namespace*/
namespace Controllers;

/*Importamos */
use Model\Servicio;
use Model\Cita as Cita;
use Model\CitaServicio as CitaServicio;

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
			if(!isset($_POST["usuarioId"])){
				$respuesta = [
					"code" => 400,
					"operation" => false,
					"status" => "Error",
					"msg" => "Debes estar logueado para hacer esta peticion"
				];
				echo json_encode($respuesta, JSON_THROW_ON_ERROR);
				exit;
			}else if(!isset($_POST["nombre"])){
				$respuesta = [
					"code" => 400,
					"operation" => false,
					"status" => "Error",
					"msg" => "El nombre debe ser enviado en el formato"
				];
				echo json_encode($respuesta, JSON_THROW_ON_ERROR);
				exit;
			}else if(!isset($_POST["hora"])){
				$respuesta = [
					"code" => 400,
					"operation" => false,
					"status" => "Error",
					"msg" => "La hora debe ser enviada en el formato"
				];
				echo json_encode($respuesta, JSON_THROW_ON_ERROR);
				exit;
			}else if(!isset($_POST["fecha"])){
				$respuesta = [
					"code" => 400,
					"operation" => false,
					"status" => "Error",
					"msg" => "La fecha debe ser enviada en el formato"
				];
				echo json_encode($respuesta, JSON_THROW_ON_ERROR);
				exit;
			}else if(!isset($_POST["servicios"])){
				$respuesta = [
					"code" => 400,
					"operation" => false,
					"status" => "Error",
					"msg" => "El/Los servicio(s) deben ser enviado en el formato"
				];
				echo json_encode($respuesta, JSON_THROW_ON_ERROR);
				exit;
			}
			$cita = new Cita($_POST);
			//intentamos guardar, Almacena la cita y devuelve el id
			$resultado = $cita->guardar();
			//leemos el ID que retorna resultado
			$id = $resultado["id"];
			//Almacena la cita y el servicio
			$idServicios = explode(",", $_POST["servicios"]);
			$citaServicioAlmacenado = 0;
			//recorremos el array creado con explode
			foreach ($idServicios as $servicios){
				//creamos un nuevo array asociativo para almacenar el id de cita
				// y el id de servicios
				$args = [
					"citasId" => $id,
					"serviciosId" => $servicios
				];
				//instanciamos el modelo de citaservicio y le enviamos el array
				$citaServicio = new CitaServicio($args);
				//guardamos en la db
				$idCitaServicio = $citaServicio->guardar();
				$citaServicioAlmacenado = $idCitaServicio;
			}
			$respuesta = [
				"code" => 200,
				"status" => "success",
				"operation" => true,
				"resultado" => $resultado,
				"citaServicio" => $citaServicioAlmacenado
			];
			// codificamos a formato JSON
			//enviamos respuesta codificada en json
			echo json_encode($respuesta);
		}
	}
}
?>