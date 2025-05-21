<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session(); // Usamos el helper confiable de CodeIgniter

        // Verifica si el usuario ha iniciado sesión
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')
                ->with('error', 'Por favor inicia sesión para acceder a esta página');
        }

        // Si se especificaron roles permitidos, validarlos
        if ($arguments) {
            $userRole = $session->get('ID_Rol');

            // Si no tiene rol o no está permitido, redirige
            if ($userRole === null || !in_array($userRole, $arguments)) {
                return redirect()->back()
                    ->with('error', 'No tienes permisos para acceder a esta sección');
            }
        }

        // Si todo está correcto, deja pasar
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos lógica post-request en este filtro
    }
}

