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

        if (!$session->has('user_id')) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Sesión inválida o expirada');
        }
        
        // Verificar consistencia de la sesión
        if ($session->get('logged_in') !== true) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Sesión corrupta');
        }

        // Si todo está correcto, deja pasar
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos lógica post-request en este filtro
    }
}

