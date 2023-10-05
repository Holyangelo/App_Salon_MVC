<?php 

require_once __DIR__ . '/../includes/app.php';

/*importamos los metodos y controladores*/
use MVC\Router;
use Controllers\LoginController;

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


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();