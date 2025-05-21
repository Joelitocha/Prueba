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
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Initialize session
        $this->session = \Config\Services::session();

        // Load common services
        $this->validation = \Config\Services::validation();

        // Check authentication for non-API and non-CLI requests
        if (!$request instanceof CLIRequest && !$this->isAuthRoute()) {
            $this->checkAuthentication();
        }

        // Set user data if logged in
        if ($this->session->get('logged_in')) {
            $this->userData = [
                'id' => $this->session->get('user_id'),
                'username' => $this->session->get('username'),
                'role' => $this->session->get('ID_Rol'),
                'tarjeta' => $this->session->get('ID_tarjeta')
            ];
            $this->userRole = $this->session->get('ID_Rol');
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