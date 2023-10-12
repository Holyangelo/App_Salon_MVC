<?php

/*Declaramos el namespace*/
namespace Controllers;

/*Imports*/
use MVC\Router;


/*Creamos la clase de cita*/
class CitaController{

	/*Main Method Cita*/
	public static function index( Router $router){
		/*iniciamos session en la vista*/
		session_start();
		$router->render('cita/index', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'email' => $_SESSION['email']
		]);
	}
}
?>