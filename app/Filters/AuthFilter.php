<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        $uri = service('uri');
        $role = $session->get('ID_Rol');

        if (!$session->get('logged_in') || !$role) {
            return redirect()->to('/login')->with('error', 'Acceso denegado.');
        }

        $segment = strtolower($uri->getSegment(1)); // e.g. "administrador"

        $roleMapping = [
            'administrador' => 5,
            'supervisor'    => 6,
            'usuario'       => 7,
        ];

        if (isset($roleMapping[$segment]) && $role != $roleMapping[$segment]) {
            return redirect()->to('/login')->with('error', 'No tenés permiso para entrar acá.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se usa
    }
}
