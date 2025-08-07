<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// RUTAS PÚBLICAS (SIN AUTENTICACIÓN)
// =======================
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::inicio');
$routes->post('/login', 'AuthController::loginUser');
$routes->get('/verify', 'AuthController::verifyEmail');
$routes->get('/set-password', 'AuthController::showSetPassword');
$routes->post('/complete-registration', 'AuthController::completeRegistration');
$routes->post('/logout', 'AuthController::logout'); // Se recomienda solo POST por seguridad

// Rutas para ESP32 (públicas o con autenticación alternativa si es necesario)
$routes->post('cargar_acceso', 'esp32controller::insertar_registro');
$routes->post('vincular_esp', 'esp32controller::vincular');

// =======================
// RUTAS PROTEGIDAS POR ROL
// =======================

// RUTAS PARA TODOS LOS USUARIOS AUTENTICADOS (roles 5, 6 y 7)

    $routes->get('/bienvenido', 'AuthController::welcome', ['filter' => 'authfilter:5,6,7']);
    $routes->get('/consultar-rfid', 'ViewsControllers::VistaConsultar');
    $routes->post('/consultar-rfid', 'TarjetaController::verEstadoTarjeta');


// RUTAS PARA ADMIN Y SUPERVISOR (roles 5 y 6)
$routes->group('', ['filter' => 'authfilter:5,6'], function($routes) {
    $routes->get('/ver-alertas', 'ViewsControllers::VistaAlertas');
    $routes->get('/ver-accesos-tarjeta', 'RegistrosAccesoController::verRegistros');
    $routes->get('/historial-cambios', 'HistorialController::index');
    $routes->post('/historial-cambios/ver', 'HistorialController::verArchivo');
});

// RUTAS SOLO PARA ADMINISTRADOR (rol 5)
$routes->group('', ['filter' => 'authfilter:5'], function($routes) {
    // Gestión de usuarios
    $routes->get('/modificar-usuario', 'UserController::VistaModificar');
    $routes->post('/modificar-usuario2', 'UserController::VistaModificar2');
    $routes->get('/eliminar-usuarios', 'UserController::VistaEliminar');
    $routes->post('/actualizar-usuario', 'UserController::actualizarUsuario');
    $routes->post('/eliminar-usuarios', 'UserController::eliminarUsuario');
    $routes->get('/register', 'AuthController::registro');
    $routes->post('/register2', 'AuthController::registerUser');

    // Gestión de tarjetas
    $routes->get('/modificar-tarjeta', 'TarjetaController::VistaModificar');
    $routes->post('/modificar-tarjeta2', 'TarjetaController::VistaModificar2');
    $routes->post('/actualizar-tarjeta', 'TarjetaController::update');
    $routes->get('/eliminar-tarjeta', 'TarjetaController::gestionar');
    $routes->post('/eliminar-tarjeta', 'TarjetaController::delete');
    $routes->post('/bloquear-tarjeta', 'TarjetaController::bloquearTarjeta');
    $routes->post('/desbloquear-tarjeta', 'TarjetaController::desbloquearTarjeta');
    $routes->get('/crear-tarjeta', 'CrearTarjetaController::index');
    $routes->post('/crear-tarjeta', 'CrearTarjetaController::store');

    // Gestión de dispositivos
    $routes->get('/dispositivo', 'DispositivoController::vistadisp');
    $routes->get('/configurar-dispositivo', 'DispositivoController::nuevo');
    $routes->post('/guardar-dispositivo', 'DispositivoController::guardar');
    $routes->get('/configurar-dispositivo/(:num)', 'DispositivoController::configurar/$1');
    $routes->post('/actualizar-dispositivo/(:num)', 'DispositivoController::actualizar/$1');
    $routes->get('/eliminar-dispositivo/(:num)', 'DispositivoController::eliminar/$1');
});

// =======================
// ERROR 404 PERSONALIZADO
// =======================
$routes->set404Override(function() {
    return view('errors/html/error_404');
});
