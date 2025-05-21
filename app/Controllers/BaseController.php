<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'session'];

    /**
     * Session instance
     * 
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Current user data
     * 
     * @var array
     */
    protected $userData;

    /**
     * Current user role
     * 
     * @var int
     */
    protected $userRole;

    /**
     * Initialize the controller
     * 
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    
        // Excluir rutas públicas de verificación
        if (!$request instanceof CLIRequest && !$this->isAuthRoute()) {
            $this->checkSessionConsistency();
        }
    
        // Cargar datos de usuario si está autenticado
        if ($this->session->get('logged_in')) {
            $this->loadUserData();
        }
    }

    /**
     * Check if user is authenticated
     * 
     * @throws \CodeIgniter\Router\Exceptions\RedirectException
     */
    protected function checkAuthentication()
    {
        if (!$this->session->get('logged_in')) {
            // Store intended URL before redirecting
            $currentURL = current_url();
            if (!in_array($currentURL, [site_url('/login'), site_url('/')])) {
                $this->session->set('redirect_url', $currentURL);
            }

            return redirect()->to('/login')
                ->with('error', 'Por favor inicia sesión para acceder a esta página');
        }
    }
    protected function checkSessionConsistency()
{
    // Verificar que todos los datos requeridos existen
    $requiredKeys = ['logged_in', 'user_id', 'ID_Rol', 'username'];
    foreach ($requiredKeys as $key) {
        if (!$this->session->has($key)) {
            $this->session->destroy();
            return redirect()->to('/login')
                   ->with('error', 'Sesión incompleta, por favor ingresa nuevamente');
        }
    }

    // Verificar que logged_in es booleano true
    if ($this->session->get('logged_in') !== true) {
        $this->session->destroy();
        return redirect()->to('/login')
               ->with('error', 'Sesión inválida');
    }
}
    protected function loadUserData()
    {
        $this->userData = [
            'id' => $this->session->get('user_id'),
            'username' => $this->session->get('username'),
            'role' => $this->session->get('ID_Rol'),
            'tarjeta' => $this->session->get('ID_tarjeta')
        ];
        $this->userRole = $this->session->get('ID_Rol');
    }
    /**
     * Check if user has required role
     * 
     * @param array|int $requiredRoles
     * @throws \CodeIgniter\Router\Exceptions\RedirectException
     */
    protected function checkRole($requiredRoles)
    {
        if (!is_array($requiredRoles)) {
            $requiredRoles = [$requiredRoles];
        }

        if (!in_array($this->userRole, $requiredRoles)) {
            return redirect()->back()
                ->with('error', 'No tienes permisos para acceder a esta sección');
        }
    }

    /**
     * Check if current route is authentication-related
     * 
     * @return bool
     */
    protected function isAuthRoute()
    {
        $currentPath = $this->request->getPath();
        $authRoutes = ['/', '/login', '/register', '/verify', '/set-password', '/complete-registration'];

        return in_array($currentPath, $authRoutes);
    }

    /**
     * Render view with common data
     * 
     * @param string $view
     * @param array $data
     * @return string
     */
    protected function renderView($view, $data = [])
    {
        // Add common data to all views
        $data['userData'] = $this->userData;
        $data['currentUrl'] = current_url();

        return view($view, $data);
    }
}