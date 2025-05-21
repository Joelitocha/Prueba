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
        $currentURL = $request->getUri()->getPath();
        
        // Excluir rutas públicas
        $publicRoutes = ['/', '/login', '/register', '/verify'];
        
        if (!in_array($currentURL, $publicRoutes)) {
            if ($session->get('logged_in')) {
                // Forzar actualización de tiempo de vida de la cookie
                setcookie(
                    config('Session')->cookieName,
                    session_id(),
                    [
                        'expires' => time() + config('Session')->expiration,
                        'path' => config('Session')->cookiePath,
                        'domain' => config('Session')->cookieDomain,
                        'secure' => config('Session')->cookieSecure,
                        'httponly' => config('Session')->cookieHTTPOnly,
                        'samesite' => config('Session')->cookieSameSite
                    ]
                );
                
                // Verificar integridad de la sesión
                if (!$session->has('user_id') || !$session->has('ID_Rol')) {
                    $session->destroy();
                    return redirect()->to('/login');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario implementar
    }
}