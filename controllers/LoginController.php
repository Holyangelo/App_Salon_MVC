<?php
//Creamos el namespace
namespace Controllers;

/*Importamos Controladores y Metodos*/
use MVC\Router;
use Model\Usuario;

//Creamos una clase con el nombre del controlador
class LoginController{
	//Creamos un metodo de inicio de sesion
	public static function login(Router $router){

		/*verificamos el request method*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			debug($_POST);
		}

		/*Renderizamos la vista*/
		$router->render('auth/login',[
		]);
	}

	//Creamos el metodo para cerrar sesion
	public static function logout(Router $router){
		echo "Logout";
	}

	//Creamos el metodo para cuando olvide el password
	public static function olvide(Router $router){
		$router->render('auth/olvide-cuenta', [
		]);
	}

	//Creamos el metodo para recuperar password
	public static function recuperar(Router $router){
		echo "Recuperar Password";
	}

	//Creamos el metodo para crear cuenta
	public static function crear(Router $router){
		/*verificamos el request method*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			debug($_POST);
		}
		/*Renderizamos la vista*/
		$router->render('auth/crear-cuenta', [
		]);
	}
}
?>