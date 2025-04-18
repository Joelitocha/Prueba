<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Ruta para la página de inicio de sesión
$routes->get('/', 'AuthController::index');  // Página de login

// Proceso de login
$routes->post('/login', 'AuthController::loginUser');  // Iniciar sesión
$routes->get('/login', 'AuthController::inicio');  // Página de bienvenida

// Ruta para la página de bienvenida después de iniciar sesión
$routes->get('/bienvenido', 'AuthController::welcome');  // Página de bienvenida

// Rutas para registro y verificación de usuario
$routes->get('/register', 'AuthController::registro');  // Formulario de registro
$routes->post('/register2', 'AuthController::registerUser');  // Proceso de registro
$routes->get('/verify', 'AuthController::verifyEmail'); // Verificación de email (GET)

// Nuevas rutas para el flujo de establecimiento de contraseña
$routes->get('/set-password', 'AuthController::showSetPassword'); // Mostrar formulario para establecer contraseña
$routes->post('/complete-registration', 'AuthController::completeRegistration'); // Procesar contraseña

// Rutas para cerrar sesión
$routes->get('/logout', 'AuthController::logout');  // Cerrar sesión (GET)
$routes->post('/logout', 'AuthController::logout');  // Cerrar sesión (POST)

// Rutas protegidas (protegidas por el filtro 'auth')
$routes->get('/modificar-usuario', 'UserController::VistaModificar');  // Vista para modificar usuario
$routes->post('/modificar-usuario2', 'UserController::VistaModificar2');  // Proceso de modificación de usuario
$routes->get('/eliminar-usuarios', 'UserController::VistaEliminar');  // Vista para eliminar usuarios
$routes->get('/consultar-rfid', 'ViewsControllers::VistaConsultar');  // Vista para consultar RFID
$routes->get('/ver-alertas', 'ViewsControllers::VistaAlertas');  // Vista para ver alertas

// Otras rutas protegidas
$routes->post('/actualizar-usuario', 'UserController::actualizarUsuario');  // Proceso de actualización de usuario
$routes->post('/eliminar-usuarios', 'UserController::eliminarUsuario');  // Proceso de eliminación de usuario

// Rutas para gestión de tarjetas
$routes->get('/gestionar-tarjeta', 'TarjetaController::store-tarjeta');  // Vista para gestionar tarjetas
$routes->post('/store-tarjeta', 'TarjetaController::store');  // Proceso de creación de tarjeta
$routes->get('/modificar-tarjeta', 'TarjetaController::VistaModificar');  // Vista para modificar tarjeta
$routes->post('/modificar-tarjeta2', 'TarjetaController::VistaModificar2');  // Proceso de modificación de tarjeta
$routes->post('/actualizar-tarjeta', 'TarjetaController::update');  // Proceso de actualización de tarjeta
$routes->get('/eliminar-tarjeta', 'TarjetaController::gestionar');  // Vista para eliminar tarjeta
$routes->post('/eliminar-tarjeta', 'TarjetaController::delete');  // Proceso de eliminación de tarjeta
$routes->post('bloquear-tarjeta', 'TarjetaController::bloquearTarjeta');
$routes->post('desbloquear-tarjeta', 'TarjetaController::desbloquearTarjeta');

// Rutas para el registro de accesos a través de tarjeta
$routes->get('/ver-accesos-tarjeta', 'RegistrosAccesoController::verRegistros');  // Ver registros de acceso por tarjeta

// Rutas para ver los registros 
$routes->get('/historial-cambios', 'HistorialController::index');
$routes->post('/historial-cambios/ver', 'HistorialController::verArchivo');

// Rutas adicionales
$routes->get('/crear-tarjeta', 'CrearTarjetaController::index');  // Vista para crear tarjeta
$routes->post('/crear-tarjeta', 'CrearTarjetaController::store');  // Proceso de creación de tarjeta

$routes->post('/consultar-rfid', 'TarjetaController::verEstadoTarjeta');  // Consultar estado de la tarjeta

// Rutas para ESP32
$routes->post('cargar_acceso', 'esp32controller::insertar_registro');  // Registrar acceso desde ESP32



