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
		/*Alertas*/
		$alertas = [];
		$auth = new Usuario();
		/*verificamos el request method*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/*Instanciamos el objeto de usuario y le pasamos el valor del POST*/
			$auth = new Usuario($_POST);
			/*Validamos los datos introducidos en login*/
			$alertas = $auth->validarLogin();
			/*Validamos si el email existe*/
			if(empty($alertas)){
				//comprobamos que exista el usuario
				$usuario = Usuario::where('email', $auth->email);
				if ($usuario) {
					//comprobamos el password
					//enviamos el password que escribio el usuario
					if($usuario->validarPasswordAndConfirmado($auth->password)){
						/*INICIAMOS LA SESION*/
						session_start();
						/*Guardamos los datos en variables de sesion*/
						$_SESSION['id'] = $usuario->id;
						$_SESSION['nombre'] = $usuario->nombre;
						$_SESSION['apellidos'] = $usuario->apellido;
						$_SESSION['email'] = $usuario->email;
						$_SESSION['login'] = true;
						/*Redireccionamos*/
						if($usuario->admin == "1"){
							/*Si es admin debemos guardar el valor en session*/
							$_SESSION['admin'] = $usuario->admin ?? null;
							/*Redireccionamos a admin*/
							header("Location:/admin");
						}else{
							/*Redireccionamos a citas si es cliente*/
							header("Location:/cita");
						}

					}
				}else{
					//seteamos una alerta en caso de no existir el usuario
					Usuario::setAlerta('error', 'Usuario no existe');
				}
			}
		}

		/*Mostramos las alertas*/
		$alertas = Usuario::getAlertas();

		/*Renderizamos la vista*/
		$router->render('auth/login',[
			'alertas' => $alertas,
			//'auth' => $auth
		]);
	}

	//Creamos el metodo para cerrar sesion
	public static function logout(Router $router){
		session_start();
		if($_SESSION['login']){
			$_SESSION['login'] = false;
			$_SESSION = [];
			session_destroy();
			header('Location:/');
		}else{
		header('Location:/cita');
	}
	}

	//Creamos el metodo para cuando olvide el password
	public static function olvide(Router $router){
		/*creamos el arreglo de las alertas*/
		$alertas = [];
		/*REQUEST METHOD*/
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/*Instanciamos el modelo con la informacion del POST*/
			$auth = new Usuario($_POST);
			/*Validamos si escribio un email*/
			$alertas = $auth->validarEmail();
			/*Si escribio un email*/
			if (empty($alertas)) {
				/*Llamamos al metodo WHERE para verificar si el email existe*/
				$usuario = Usuario::where('email', $auth->email);
				/*verificarmos que email sea correcto y usuario este confirmado*/
				if ($usuario && $usuario->confirmado) {
					if($usuario->token){
					//Alerta de error
					Usuario::setAlerta('error', 'Ya existe un token pendiente para el usuario');
				}else{
					//Generamos un nuevo token
					$usuario->crearToken();
					//guardamos el usuario con el token actualizado
					$usuario->guardar();
					//Enviar Email
					$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
					//Enviamos el Email
					if($email->enviarInstrucciones()){
					//Alerta de exito
						Usuario::setAlerta('check', 'Instrucciones enviadas al correo');
					}
				}
				}else{
					//Alerta de error
					Usuario::setAlerta('error', 'Email no existe o no esta confirmado');
				}
			}
		}
		$alertas = Usuario::getAlertas();
		/*Renderizamos*/
		$router->render('auth/olvide-cuenta', [
			'alertas' => $alertas
		]);
	}

	//Creamos el metodo para recuperar password
	public static function recuperar(Router $router){
		$alertas = [];
		/*error*/
		$error = false;
		/*Leemos el token*/
		$token = s($_GET['token']);
		/*Buscamos si el token existe*/
		$usuario = Usuario::where('token', $token);
		if(empty($usuario)){
			/*Mostramos mensaje de error*/
			$alertas = Usuario::setAlerta('error', 'Token no valido.');
			$error = true;
		}
		/*REQUEST METHOD*/
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$password = new Usuario($_POST);
			//validamos password
			$alertas = $password->validarPassword();
			//Si alertas esta vacio 
			if (empty($alertas)) {
				//seteamos null el password anterior
				$usuario->password = null;
				//seteamos el nuevo password introducido por el usuario
				$usuario->password = $password->password;
				//hasheamos el password nuevo
				$usuario->hashPassword();
				//seteamos null el token 
				$usuario->token = null;
				//guardamos o actualizamos
				if($usuario->guardar()){
					Usuario::setAlerta('check', 'Password actualizado correctamente');
					Usuario::setAlerta('check', 'Redireccionando...');
					header('refresh:3; url=/');
				}else{
					Usuario::setAlerta('error', 'Error al intentar actualizar el password');
				}
			}
		}
		/*Mostramos las alertas*/
		$alertas = Usuario::getAlertas();
		/*Renderizamos*/
		$router->render('auth/recuperar', [
			'error' => $error,
			'alertas' => $alertas
		]);
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


	//creamos el metodo para renderizar cita
}
?>