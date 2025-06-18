<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Configuración de grupos de rutas con filtros
$routes->group('', ['filter' => '\App\Filters\AuthFilter'], function($routes) {
    // Rutas que requieren autenticación (cualquier rol)
    $routes->get('/bienvenido', 'AuthController::welcome');
    
    // Rutas para gestión de usuarios (solo admin - rol 5)
        $routes->get('/modificar-usuario', 'UserController::VistaModificar');
        $routes->post('/modificar-usuario2', 'UserController::VistaModificar2');
        $routes->get('/eliminar-usuarios', 'UserController::VistaEliminar');
        $routes->post('/actualizar-usuario', 'UserController::actualizarUsuario');
        $routes->post('/eliminar-usuarios', 'UserController::eliminarUsuario');
        $routes->get('/register', 'AuthController::registro');
        $routes->post('/register2', 'AuthController::registerUser');
        
        // Rutas para gestión de tarjetas (solo admin)
        $routes->get('/modificar-tarjeta', 'TarjetaController::VistaModificar');
        $routes->post('/modificar-tarjeta2', 'TarjetaController::VistaModificar2');
        $routes->post('/actualizar-tarjeta', 'TarjetaController::update');
        $routes->get('/eliminar-tarjeta', 'TarjetaController::gestionar');
        $routes->post('/eliminar-tarjeta', 'TarjetaController::delete');
        $routes->get('/crear-tarjeta', 'CrearTarjetaController::index');
        $routes->post('/crear-tarjeta', 'CrearTarjetaController::store');
        $routes->get('/dispositivo', 'DispositivoController::index');
    
    // Rutas para admin y supervisor (roles 5 y 6)
        $routes->get('/ver-alertas', 'ViewsControllers::VistaAlertas');
        $routes->get('/ver-accesos-tarjeta', 'RegistrosAccesoController::verRegistros');
        $routes->get('/historial-cambios', 'HistorialController::index');
        $routes->post('/historial-cambios/ver', 'HistorialController::verArchivo');
    
    // Rutas para todos los usuarios autenticados (roles 5, 6 y 7)
    $routes->get('/consultar-rfid', 'ViewsControllers::VistaConsultar');
    $routes->post('/consultar-rfid', 'TarjetaController::verEstadoTarjeta');
    $routes->post('bloquear-tarjeta', 'TarjetaController::bloquearTarjeta');
    $routes->post('desbloquear-tarjeta', 'TarjetaController::desbloquearTarjeta');
});

// Rutas públicas (sin autenticación)
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::loginUser');
$routes->get('/login', 'AuthController::inicio');
$routes->get('/verify', 'AuthController::verifyEmail');
$routes->get('/set-password', 'AuthController::showSetPassword');
$routes->post('/complete-registration', 'AuthController::completeRegistration');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/logout', 'AuthController::logout');

// Rutas para ESP32 (públicas o con autenticación alternativa si es necesario)
$routes->post('cargar_acceso', 'esp32controller::insertar_registro');

// Ruta de fallback para páginas no encontradas
$routes->set404Override(function() {
    return view('errors/html/error_404');
});


