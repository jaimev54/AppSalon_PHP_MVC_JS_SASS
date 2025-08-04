<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../includes/app.php';

use Controllers\Citacontroller;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();

// INICIAR SESIÓN
$router->get('/',[LoginController::class, 'Login']);
$router->post('/',[LoginController::class, 'Login']);
$router->get('/logout',[LoginController::class, 'Logout']);

//recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);

//crear un nuevo usuario
$router->get('/crear-cuenta',[LoginController::class, 'crear']);
$router->post('/crear-cuenta',[LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta',[LoginController::class, 'confirmar']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

// Área Privada
$router->get('/cita',[CitaController::class, 'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();