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
        
        // Verificar si el usuario no está logueado
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Por favor inicia sesión');
        }
        
        // Verificar rol si es necesario (para rutas específicas)
        if (!empty($arguments)) {
            $userRol = $session->get('ID_Rol');
            if (!in_array($userRol, $arguments)) {
                return redirect()->back()->with('error', 'No tienes permisos para acceder a esta sección');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario hacer nada después
    }
}