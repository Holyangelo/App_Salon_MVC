<?php 

require_once __DIR__ . '/../includes/app.php';

/*importamos los metodos y controladores*/
use MVC\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;

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

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();