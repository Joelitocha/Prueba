<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas públicas
$routes->get('/', 'AuthController::inicio'); // login form
$routes->post('/login', 'AuthController::loginUser');
$routes->get('/verify', 'AuthController::verifyEmail');
$routes->get('/set-password', 'AuthController::showSetPassword');
$routes->post('/complete-registration', 'AuthController::completeRegistration');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/logout', 'AuthController::logout');

// Ruta protegida principal (dashboard para usuarios logueados)
$routes->group('', ['filter' => '\App\Filters\AuthFilter'], function($routes) {
    $routes->get('/bienvenido', 'AuthController::welcome'); // solo accesible si hay sesión válida

    // Admin (rol 5)
    $routes->group('', ['filter' => 'authfilter:5'], function($routes) {
        $routes->get('/modificar-usuario', 'UserController::VistaModificar');
        $routes->post('/modificar-usuario2', 'UserController::VistaModificar2');
        $routes->get('/eliminar-usuarios', 'UserController::VistaEliminar');
        $routes->post('/actualizar-usuario', 'UserController::actualizarUsuario');
        $routes->post('/eliminar-usuarios', 'UserController::eliminarUsuario');
        $routes->get('/register', 'AuthController::registro');
        $routes->post('/register2', 'AuthController::registerUser');
        $routes->get('/modificar-tarjeta', 'TarjetaController::VistaModificar');
        $routes->post('/modificar-tarjeta2', 'TarjetaController::VistaModificar2');
        $routes->post('/actualizar-tarjeta', 'TarjetaController::update');
        $routes->get('/eliminar-tarjeta', 'TarjetaController::gestionar');
        $routes->post('/eliminar-tarjeta', 'TarjetaController::delete');
        $routes->get('/crear-tarjeta', 'CrearTarjetaController::index');
        $routes->post('/crear-tarjeta', 'CrearTarjetaController::store');
    });

    // Admin y Supervisor (roles 5 y 6)
    $routes->group('', ['filter' => 'authfilter:5,6'], function($routes) {
        $routes->get('/ver-alertas', 'ViewsControllers::VistaAlertas');
        $routes->get('/ver-accesos-tarjeta', 'RegistrosAccesoController::verRegistros');
        $routes->get('/historial-cambios', 'HistorialController::index');
        $routes->post('/historial-cambios/ver', 'HistorialController::verArchivo');
    });

    // Todos los usuarios autenticados (roles 5, 6, 7)
    $routes->get('/consultar-rfid', 'ViewsControllers::VistaConsultar');
    $routes->post('/consultar-rfid', 'TarjetaController::verEstadoTarjeta');
    $routes->post('/bloquear-tarjeta', 'TarjetaController::bloquearTarjeta');
    $routes->post('/desbloquear-tarjeta', 'TarjetaController::desbloquearTarjeta');
});

// Rutas públicas para ESP32
$routes->post('/cargar_acceso', 'esp32controller::insertar_registro');

// Ruta para errores 404
$routes->set404Override(function () {
    return view('errors/html/error_404');
});
