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
    $session = \Config\Services::session();
    
    // Limpiar mensajes de error previos no consumidos
    if ($session->has('error') && $session->get('error') === 'Por favor inicia sesión para acceder a esta página') {
        $session->remove('error');
    }

    // Verificar autenticación básica
    if (!$session->get('logged_in')) {
        // Solo establecer mensaje si no es una ruta de API
        if (!in_array($request->getPath(), ['/login', '/'])) {
            $session->setFlashdata('error', 'Por favor inicia sesión para acceder a esta página');
        }
        return redirect()->to('/login');
    }

    // Verificación de roles si se especifican
    if (!empty($arguments)) {
        $userRole = $session->get('ID_Rol');
        
        if ($userRole === null) {
            $session->destroy();
            return redirect()->to('/login')
                   ->with('error', 'Sesión inválida: rol no definido');
        }

        if (!in_array($userRole, $arguments)) {
            return redirect()->back()
                   ->with('error', 'No tienes permisos para esta sección');
        }
    }

    return null;
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos lógica post-request en este filtro
    }
}

