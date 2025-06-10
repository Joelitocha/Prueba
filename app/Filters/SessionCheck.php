<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        $currentPath = trim($request->uri->getPath(), '/');

        // Rutas públicas donde no se requiere sesión
        $publicRoutes = ['login', 'register', '', 'verify'];

        // Si NO es ruta pública, aplicamos chequeo de sesión
        if (!in_array($currentPath, $publicRoutes)) {

            // Si no hay sesión activa, redirigir
            if (!$session->get('logged_in')) {
                return redirect()->to('/login?error=1');
            }

            // Verificación de integridad
            if (!$session->has('user_id') || !$session->has('ID_Rol')) {
                $session->destroy();
                return redirect()->to('/login?error=1');
            }

            // Control de inactividad (30 minutos)
            $timeout = 5; 
            if ($session->has('last_activity')) {
                $inactiveTime = time() - $session->get('last_activity');

                if ($inactiveTime > $timeout) {
                    $session->destroy();
                    return redirect()->to('/login?error=1');
                }
            }

            // Si todo OK, actualizar tiempo de actividad
            $session->set('last_activity', time());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario implementar nada acá por ahora
    }
}

