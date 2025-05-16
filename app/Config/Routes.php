<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('', ['filter' => 'authfilter'], function($routes) {

    // Rutas que requieren autenticación (cualquier rol)
    $routes->get('/bienvenido', 'AuthController::welcome');

    // Rutas para gestión de usuarios (solo admin - rol 5)
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

    // Rutas para admin y supervisor (roles 5 y 6)
    $routes->group('', ['filter' => 'authfilter:5,6'], function($routes) {
        $routes->get('/ver-alertas', 'ViewsControllers::VistaAlertas');
        $routes->get('/ver-accesos-tarjeta', 'RegistrosAccesoController::verRegistros');
        $routes->get('/historial-cambios', 'HistorialController::index');
        $routes->post('/historial-cambios/ver', 'HistorialController::verArchivo');
    });

    // Rutas para todos los usuarios autenticados
    $routes->get('/consultar-rfid', 'ViewsControllers::VistaConsultar');
    $routes->post('/consultar-rfid', 'TarjetaController::verEstadoTarjeta');
    $routes->post('bloquear-tarjeta', 'TarjetaController::bloquearTarjeta');
    $routes->post('desbloquear-tarjeta', 'TarjetaController::desbloquearTarjeta');
});
