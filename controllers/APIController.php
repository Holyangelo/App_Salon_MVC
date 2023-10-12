<?php
/*Creamos el namespace*/
namespace Controllers;

/*Importamos */
use MVC\Router;
use Model\Servicio;

/*Main Class*/
class APIController{
	// index function
	public static function index(){
		// metodos static heredados no requerimos instanciarlos
		$servicios = Servicio::all();
		//codificamos a formato JSON
		echo json_encode($servicios);
	}
}
?>