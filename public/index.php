<?php 

require_once __DIR__ . '/../includes/app.php';
use Controllers\authController;
use Controllers\CoordinadorController;
use Controllers\adminUsuariosController;
use Controllers\userController;
use Controllers\verificadorController;
use Controllers\adminEventosController;
use Controllers\StaffUserController;
use MVC\Router;


$router = new Router();
//INDEX 
$router->get('/',[userController::class, 'index']);
$router->get('/calendar',[userController::class, 'calendar']);
$router->get('/evento',[userController::class, 'evento']);
$router->get('/profile',[userController::class, 'profile']);

//auth
$router->get('/login',[authController::class, 'login']);
$router->post('/login',[authController::class, 'login']);
$router->get('/logout',[authController::class, 'logout']);
$router->get('/usuariotipo',[authController::class, 'usuariotipo']);


//Vistas Coordinador
$router->get('/Coordinador',[CoordinadorController::class, 'index']);
$router->get('/Coordinador/apidivisiones',[CoordinadorController::class, 'divisiones']);
$router->post('/crearevento',[CoordinadorController::class, 'crearevento']);
$router->get('/Coordinador/obtenerlugares',[CoordinadorController::class, 'lugares']);
$router->get('/Coordinador/eventos',[CoordinadorController::class, 'eventos']);
$router->get('/Coordinador/revisionEventos',[CoordinadorController::class, 'revisionEventos']);
$router->post('/Coordinador/revisionEventos',[CoordinadorController::class, 'revisionEventos']);
$router->get('/Coordinador/editarevento',[CoordinadorController::class, 'editarevento']);
$router->post('/Coordinador/editarevento',[CoordinadorController::class, 'editarevento']);
$router->post('/Coordinador/actualizarEvento',[CoordinadorController::class, 'actualizarEvento']);
$router->post('/Coordinador/eventosPublicados',[CoordinadorController::class, 'eventospublicados']);
$router->get('/Coordinador/verevento',[CoordinadorController::class, 'verevento']);
 
//Staff
$router->get('/Coordinador/staff',[CoordinadorController::class, 'staff']);
$router->post('/Coordinador/staff',[CoordinadorController::class, 'staff']);
$router->post('/Coordinador/staffelimnar',[CoordinadorController::class, 'eliminarstaff']);
$router->get('/Coordinador/usuarioenstaff',[CoordinadorController::class, 'usuarioenstaff']);
$router->post('/registraraevento',[userController::class, 'registraraevento']);

//Subeventos
$router->get('/CoordinadorSubeventos',[CoordinadorController::class, 'subeventos']);
$router->post('/Coordinador/crearsubevento',[CoordinadorController::class, 'crearsubevento']);
$router->get('/Coordinador/apisubeventos',[CoordinadorController::class, 'apisubeventos']);
$router->post('/Coordinador/actualizarsubevento',[CoordinadorController::class, 'actualizarsubevento']);

//ViceRector
$router->get('/Vicerector',[verificadorController::class, 'index']);
$router->get('/Vicerector/revisareventos',[verificadorController::class, 'eventosrevisar']);
$router->post('/Vicerector/revisareventos',[verificadorController::class, 'eventosrevisar']);
$router->post('/ViceRector/mandarRetroalimentacion',[verificadorController::class, 'mandarRetroalimentacion']);

//AdminEventos
$router->get('/AdminEventos',[adminEventosController::class, 'index']);
$router->get('/AdminEventos/eventosrevisar',[adminEventosController::class, 'eventosrevisar']);
$router->post('/AdminEventos/eventosrevisar',[adminEventosController::class, 'eventosrevisar']);


//Staff
$router->get('/staff/apigeteventosforstaff',[StaffUserController::class, 'getEventosforstaff']);
$router->post('/staff/verifyQr',[StaffUserController::class, 'verifyQr']);
$router->post('/staff/ingresarAsistencia',[StaffUserController::class, 'ingresarAsistencia']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();