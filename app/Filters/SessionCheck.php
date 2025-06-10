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
        
        // Excluir rutas públicas
        $publicRoutes = ['login', 'register', '', 'verify'];

        if (!in_array($currentPath, $publicRoutes)) {
            if (!$session->get('logged_in')) {
                return redirect()->to('/login');
            }

            // Verificar integridad de la sesión
            if (!$session->has('user_id') || !$session->has('ID_Rol')) {
                $session->destroy();
                return redirect()->to('/login');
            }

            // Verificar inactividad (15 minutos)
            $timeout = 900;
            if ($session->has('last_activity') && (time() - $session->get('last_activity')) > $timeout) {
                $session->destroy();
                return redirect()->to('/login')->with('error', 'Sesión expirada por inactividad.');
            }

            // Actualizar actividad
            $session->set('last_activity', time());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada que hacer aquí
    }
}
