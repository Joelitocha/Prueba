<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Si no hay sesión activa
        if (! $session->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Por favor inicia sesión para acceder a esta página');
            return redirect()->to('/login');
        }

        // Validación de rol
        $userRol = $session->get('ID_Rol');
        if ($arguments && ! in_array($userRol, $arguments)) {
            session()->setFlashdata('error', 'No tenés permiso para acceder a esta sección.');
            return redirect()->to('/bienvenido');
        }

        // Si pasa ambas validaciones, continua
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada aquí por ahora
    }
}