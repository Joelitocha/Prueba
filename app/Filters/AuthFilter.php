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
        
        // Debug: Verificar contenido completo de la sesión
        // var_dump($session->get()); exit;
    
        // Verificar autenticación
        if (!$session->has('logged_in') || $session->get('logged_in') !== true) {
            return redirect()->to('/login')
                   ->with('error', 'Por favor inicia sesión para acceder a esta página');
        }
    
        // Verificar roles si se especifican
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

