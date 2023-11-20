<?php 

require_once __DIR__ . '/../includes/app.php';

/*importamos los metodos y controladores*/
use MVC\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServicioController;

/*Router instancia*/
$router = new Router();

/* 1.- LOGIN ROUTER - */

//GET
$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//POST
$router->post('/', [LoginController::class, 'login']);

/* 2.- RECOVERY - */

//GET
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);

//POST
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

/* 3.- CREATE ACCOUNT - */

//GET
$router->get('/crear-cuenta', [LoginController::class, 'crear']);

//POST
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

/* 4.- CONFIRMATE ACCOUNT */

//GET
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

//GET
$router->get('/mensaje', [LoginController::class, 'mensaje']);


/* AREA PRIVADA (SOLO CON LOGIN)*/
/* 5.- CITAS */

//GET
$router->get('/cita', [CitaController::class, 'index']);

/*AREA DE API - CITAS*/
/* 6.- CITAS API */
$router->get('/api/servicios', [APIController::class, 'index']);

//POST
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

/* 7.- ADMIN */
//GET
$router->get('/admin/', [AdminController::class, 'index']);
$router->get('/admin/citas', [AdminController::class, 'citas']);
$router->get('/admin/servicios', [AdminController::class, 'servicios']);
$router->get('/admin/usuarios', [AdminController::class, 'usuarios']);

//POST
$router->post('/admin/citas', [AdminController::class, 'citas']);
$router->post('/admin/servicios', [AdminController::class, 'servicios']);

/* 8.- SERVICIOS */
//GET
$router->get('/servicios/obtener', [ServicioController::class,'GET_Servicio']);
//POST
$router->post('/servicios/crear', [ServicioController::class,'crear']);
$router->post('/servicios/actualizar', [ServicioController::class,'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class,'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();