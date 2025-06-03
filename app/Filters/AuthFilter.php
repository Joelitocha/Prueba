<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            // Redirección sin activar sesión: pasamos el mensaje por query string
            return redirect()->to('/login?error=1');
        }

        if ($arguments) {
            $userRole = $session->get('ID_Rol');
            if (!in_array($userRole, explode(',', $arguments))) {
                return redirect()->back()
                    ->with('error', 'No tienes permisos para acceder a esta sección');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada que hacer aquí
    }
}

