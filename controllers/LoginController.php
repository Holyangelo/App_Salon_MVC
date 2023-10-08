<?php
//Creamos el namespace
namespace Controllers;

/*Importamos Controladores y Metodos*/
use MVC\Router;
use Model\Usuario;
use Classes\Email;

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
		/*Instanciamos el modelo*/
		$usuario = new Usuario($_POST); // lo movemos primero que el request para conservar la referencia de los datos.
		/*Alertas vacias*/
		$alertas = [];
		/*verificamos el request method*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/* como la ya tenemos la referencia de los datos fuera del request, ahora colocaremos
			la referencia dentro con el POST usando sincronizar*/
			$usuario->sincronizar($_POST);
			/*validamos los campos de la cuenta a crear*/
			$alertas = $usuario->validarNuevaCuenta();
			/*si no hay errores*/
			if (empty($alertas)){
				/*verificamos si el usuario existe*/
				$resultado = $usuario->existeUsuario();
				/*si el usuario existe enviamos un error*/
				if($resultado->num_rows){
					/*llamamos al metodo estatico getAlertas de la clase Usuario*/
					$alertas = Usuario::getAlertas();
				}else{
					/*si no esta registrado procedemos a crear la nueva cuenta*/
					/*hasheamos el password*/
					$usuario->hashPassword();
					/*creamos un token unico*/
					$usuario->crearToken();
					/*Enviamos email con los datos de confirmacion y token, usamos la referencia
					almacenada en el modelo*/
					$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
					/*Enviamos el email*/
					if($email->enviarConfirmacion()){
						/*Si el email se logra enviar procedemos a guardar en la base de datos*/
					$save = $usuario->guardar();
					/*Si el usuario se guardo, disparamos la alerta*/
					if($save){
						/*redireccionamos*/
						header("Location:/mensaje");
					}
				}
				}
			}
		}
		/*Renderizamos la vista*/
		$router->render('auth/crear-cuenta', [
			/*Enviamos las variables u objetos a la vista*/
			'usuario' => $usuario,
			'alertas' => $alertas,
		]);
	}

	//Creamos el metodo para confirmar cuenta
	public static function confirmar(Router $router){
		$alertas = [];
		$usuarioExiste = false;
		/*Leemos el token*/
		$token = s($_GET['token']);
		/*Buscamos si el token existe*/
		$usuario = Usuario::where('token', $token);
		if(empty($usuario)){
			/*Mostramos mensaje de error*/
			$alertas = Usuario::setAlerta('error', 'Token no valido.');
		}else{
			/*Modificar a usuario confirmado*/
			if($usuario->confirmado){
				$alertas = Usuario::setAlerta('check', 'Usuario ya esta confirmado');
				$usuarioExiste = true;
			}else{
				/*Cambiamos los valores del objeto*/
				$usuario->confirmado = 1;
				$usuario->token = null;
				/*Guardamos, si el ID ya existe registrado entonces actualiza*/
				if($usuario->guardar()){
					$alertas = Usuario::setAlerta('check', 'Usuario Confirmado');
				}
			}
		}
		/*Mostramos las alertas*/
		$alertas = Usuario::getAlertas();
		/*Renderizamos*/
		$router->render('auth/confirmar-cuenta', [
			'existe' => $usuarioExiste,
			'alertas' => $alertas
		]);
	}

	//Creamos el metodo para recuperar password
	public static function mensaje(Router $router){
		$alertas = [];
		/*Seteamos la Alerta*/
		$alertas = Usuario::setAlerta('check', 'Usuario Registrado Correctamente');
		/*Llamamos la alerta*/
		$alertas = Usuario::getAlertas();
		/*Renderizamos*/
		$router->render('auth/mensaje', [
			'alertas' => $alertas
		]);
	}
}
?>