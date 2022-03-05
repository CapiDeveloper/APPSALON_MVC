<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

//Iniciar seccion
$router->get('/',[loginController::class,'login']);
$router->post('/',[loginController::class,'login']);
//Cerrar session
$router->get('/logout',[loginController::class,'logout']);

//Recuperar password
$router->get('/olvide',[loginController::class,'olvide']);
$router->post('/olvide',[loginController::class,'olvide']);
$router->get('/recuperar',[loginController::class,'recuperar']);
$router->post('/recuperar',[loginController::class,'recuperar']);

//Crear Cuentas
$router->get('/crear-cuenta',[loginController::class,'crear']);
$router->post('/crear-cuenta',[loginController::class,'crear']);

//Confirmar cuenta
$router->get('/confirmar-cuenta',[loginController::class,'confirmar']);
$router->get('/mensaje',[loginController::class,'mensaje']);

//*Area Privada*
$router->get('/cita',[CitaController::class,'index']);
$router->get('/admin',[AdminController::class,'index']);

//API
$router->get('/api/servicios',[ApiController::class,'index']);
$router->post('/api/citas',[ApiController::class,'guardar']);
$router->post('/api/eliminar',[ApiController::class,'eliminar']);

//CRUD para servicios (administrador)
$router->get('/servicios',[ServicioController::class,'index']);
$router->get('/servicios/crear',[ServicioController::class,'crear']);
$router->post('/servicios/crear',[ServicioController::class,'crear']);
$router->get('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/eliminar',[ServicioController::class,'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();