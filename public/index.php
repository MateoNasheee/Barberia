<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use Controllers\MostrarInfoController;
use Controllers\CrearCitaController;

use MVC\Router;

$router = new Router();

// Iniciar Sesión
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuentaAdmin', [APIController::class, 'crearPorAdmin']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA
$router->get('/cita', [CitaController::class,  'index']);
$router->get('/',[MostrarInfoController::class, 'index']);
$router->get('/admin', [AdminController::class,  'index']);  
$router->get('/perfil-editar', [CitaController::class,   'editar']);
$router->post('/perfil-editar', [CitaController::class,  'editar']);
$router->post('/verificar-contra', [CitaController::class, 'verificarContra']);
$router->post('/actualizar-contra', [CitaController::class, 'actualizarContra']);
$router->post('/contactar', [CitaController::class, 'Contactar']);
$router->post('/suscripcion', [CitaController::class, 'Suscripcion']);

// API de Citas

$router->get('/api/servicios', [APIController::class, 'index']);
$router->get('/api/servicios-agregar', [APIController::class, 'indexAgregar']);
$router->get('/api/servicios-edicion', [APIController::class, 'indexEdicion']);
$router->get('/api/ListaServicios', [APIController::class, 'listaServicio']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->get('/api/historial-citas', [APIController::class, 'obtenerHistorialCitas']);
$router->post('/api/guardar-cita-en-sesion', [APIController::class, 'guardarCitaEnSesion']);
$router->post('/api/guardar-servicio-en-sesion', [APIController::class, 'guardarServicioEnSesion']);
$router->get('/api/historial-citas/detalles-servicio', [APIController::class, 'obtenerDetallesServicioDeSesion']);
$router->get('/api/historial-citas/detalles', [APIController::class, 'obtenerDetallesCitaDeSesion']);
$router->post('/api/anularCita', [APIController::class, 'anularTurnoAdmin']);
$router->post('/api/actualizarturno', [APIController::class, 'actualizarcita']);
$router->post('/api/agregarServicio', [APIController::class, 'AgregarServicio']);
$router->post('/api/posponerFechaAdmin', [APIController::class, 'PosponerFecha']);
$router->post('/api/consultarHorarios', [APIController::class, 'consultarHorarios']);
$router->post('/api/actualizarservicioeditable', [APIController::class, 'actualizarServicioEditable']);
$router->post('/api/anularservicio', [APIController::class, 'anularServicio']);
$router->post('/api/anularturnocompleto', [APIController::class, 'anularTurnoCompleto']);

// Ruta para marcar la cita como realizada
$router->post('/api/realizado', [APIController::class, 'RealizarCita']);
$router->get('/crearCita', [CrearCitaController::class, 'index']);

// CRUD de Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);
// Ruta para acceder a la vista de cita








// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();