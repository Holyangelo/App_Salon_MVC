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

	public static function index(Router $router){
		/*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
		/*Zona de informacion*/
		//numero de usuarios activos
		$usuarios_activos = Usuario::countActiveUser();
		//Numero de citas entre todos los usuarios
		$citas_activas = Cita::countCita();
		//Numero de citas ya caducadas
		$citas_no_activas = Cita::countCitaOut();
		//numero de servicios registrados
		$servicios_registrados = Servicio::countServices();
		/*Zona de informacion*/
		$router->render('admin/index', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'location' => 'index',
			'usuarios_activos' => $usuarios_activos,
			'citas_activas' => $citas_activas,
			'citas_no_activas' => $citas_no_activas,
			'servicios_registrados' => $servicios_registrados
		]);
	}

	/*creamos la Ruta de Admin*/
	public static function citas(Router $router){
		/*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
		/*Zona de informacion*/
		//numero de usuarios activos
		$usuarios_activos = Usuario::countActiveUser();
		//Numero de citas entre todos los usuarios
		$citas_activas = Cita::countCita();
		//Numero de citas ya caducadas
		$citas_no_activas = Cita::countCitaOut();
		//numero de servicios registrados
		$servicios_registrados = Servicio::countServices();
		//fecha actual 
		$fecha = date('Y-m-d');
		/*Zona de informacion*/
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			if (isset($_GET['fecha'])) {
				$fechaArray = explode('-', $_GET['fecha']);
				/*checkdate es una funcion propia de php que nos permite verificar si una
				fecha es correcta*/
				$validarFecha = checkdate($fechaArray[1], $fechaArray[2], $fechaArray[0]);
				if($validarFecha){
					$fecha = $_GET['fecha'];
				// todas las citas reservadas consultar la base de datos con modelo
					$todas_las_citas = AdminCita::obtenerCitaServicio($fecha);
				}else{
					$todas_las_citas = AdminCita::obtenerCitaServicio($fecha);
				}
			}
		}
		/*Renderizamos la vista*/
		$router->render('admin/citas', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'location' => 'citas',
			'usuarios_activos' => $usuarios_activos,
			'citas_activas' => $citas_activas,
			'citas_no_activas' => $citas_no_activas,
			'servicios_registrados' => $servicios_registrados,
			'todas_las_citas' =>  $todas_las_citas ?? '',
			"fecha" => $fecha
		]);
	}

	public static function servicios(Router $router){
		/*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
		/*Zona de informacion*/
		//numero de usuarios activos
		$usuarios_activos = Usuario::countActiveUser();
		//Numero de citas entre todos los usuarios
		$citas_activas = Cita::countCita();
		//Numero de citas ya caducadas
		$citas_no_activas = Cita::countCitaOut();
		//numero de servicios registrados
		$servicios_registrados = Servicio::countServices();
		//obtenemos todos los servicios registrados
		$todos_los_servicios = Servicio::getAllServices();
		//obtener numero de ventas de cada servicio
		$serviciosArray = [];
		foreach($todos_los_servicios as $key => $value){
			$serviciosArray[] = CitaServicio::getCountServices($value->id);
		}
		/*Zona de informacion*/
		$alertas = Servicio::getAlertas();
		/*Renderizamos */
		$router->render('admin/servicios', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'location' => 'servicios',
			'usuarios_activos' => $usuarios_activos,
			'citas_activas' => $citas_activas,
			'citas_no_activas' => $citas_no_activas,
			'servicios_registrados' => $servicios_registrados,
			'todos_los_servicios' => $todos_los_servicios,
			'ventas_por_servicios' => $serviciosArray,
			'alertas' => $alertas
		]);
	}

	public static function usuarios(Router $router){
		/*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
		/*Zona de informacion*/
		//numero de usuarios activos
		$usuarios_activos = Usuario::countActiveUser();
		//Numero de citas entre todos los usuarios
		$citas_activas = Cita::countCita();
		//Numero de citas ya caducadas
		$citas_no_activas = Cita::countCitaOut();
		//numero de servicios registrados
		$servicios_registrados = Servicio::countServices();
		/*Zona de informacion*/
		$router->render('admin/usuarios', [
			'id' => $_SESSION['id'],
			'nombre' => $_SESSION['nombre'],
			'location' => 'usuarios',
			'usuarios_activos' => $usuarios_activos,
			'citas_activas' => $citas_activas,
			'citas_no_activas' => $citas_no_activas,
			'servicios_registrados' => $servicios_registrados
		]);
	}


}
?>