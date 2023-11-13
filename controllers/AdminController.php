<?php
/*Creamos el namespace*/
namespace Controllers;

/*Importamos los modelos a usar*/
use MVC\Router;
use Model\Usuario;
use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;
use Model\AdminCita;
/* instances*/

class AdminController{

	/*creamos la Ruta de Admin*/
	public static function index(Router $router){
		/*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//numero de usuarios activos
		$usuarios_activos = Usuario::countActiveUser();
		//Numero de citas entre todos los usuarios
		$citas_activas = Cita::countCita();
		$citas_no_activas = Cita::countCitaOut();
		//numero de servicios registrados
		$servicios_registrados = Servicio::countServices();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// todas las citas reservadas consultar la base de datos con modelos
			$todas_las_citas = AdminCita::obtenerCitaServicio($fecha);
		}
		/*Renderizamos la vista*/
		$router->render('admin/index', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'usuarios_activos' => $usuarios_activos,
			'citas_activas' => $citas_activas,
			'citas_no_activas' => $citas_no_activas,
			'servicios_registrados' => $servicios_registrados,
			'todas_las_citas' =>  $todas_las_citas ?? ''
		]);
	}
}
?>