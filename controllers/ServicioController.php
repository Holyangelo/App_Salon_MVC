<?php
/*Namespace */
namespace Controllers;
/*Imports */
use MVC\Router;
use Model\Servicio as Servicio;

class ServicioController{
    public static function crear( Router $router ){
        /*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
        /*Zona de informacion*/
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['nombre'] !== '' && $_POST['precio'] !== ''  && $_POST['nombre'] !== null && $_POST['precio'] !== null){
			$nuevo_servicio = new Servicio($_POST);
			if($nuevo_servicio->guardar()){
                header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=1');
            }
			}else{
                header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=2');
			}
		}
    }

    public static function actualizar( Router $router ){
        /*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
        /*Zona de informacion*/
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id_servicios'];
            if($id === '' || $id === null){
                return header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=4');
            }
            $existe_servicio = Servicio::find($id);
            if($existe_servicio){
			if(
                $_POST['id_servicios'] !== '' && $_POST['nombre_servicios'] !== '' 
                && $_POST['precio_servicios'] !== ''  && $_POST['nombre_servicios'] 
                !== null && $_POST['precio_servicios'] !== null && $_POST['id_servicios'] !== null){
                $args = [];
                $args['nombre'] = $_POST['nombre_servicios'] ?? null;
                $args['precio'] = $_POST['precio_servicios'] ?? null;
                $existe_servicio->sincronizar($args);
			if($existe_servicio->actualizar()){
                header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=1');
            }
			}else{
                header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=2');
			}
		}else{
            header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=3');
        }
    }
    }

    public static function eliminar(){
        /*iniciamos sesion*/
		session_start();
		//verifica si existe una session iniciada
		isAuth();
		//Verifica si es admin
		isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//recibimos el id
			$id = filter_var($_POST['id_servicios_eliminar'], FILTER_VALIDATE_INT);
			//verificamos si el $ID es valido
			if ($id){
				//llamamos la funcion de validarTipo
					try {
						//buscamos el objeto completo por su id
						$existe_servicio = Servicio::find($id);
						//llamamos el metodo eliminar 
						$delete = $existe_servicio->eliminar();
						if ($delete) {
							header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=5');
						}else{
                            header('Location: ' . $_SERVER['HTTP_REFERER'].'?alerta=6');
                        }
					} catch (\Exception $e) {
						$e->getMessage();
					}
			}
		}
    }

    public static function GET_Servicio(){
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $existe_servicio = Servicio::find($id);
        if($existe_servicio !== null || $existe_servicio !== ''){
            echo json_encode($existe_servicio);
        }else{
            echo json_encode(["code"=>400,"msg"=> "failed to find servicio"]);
        }
    }
}
?>