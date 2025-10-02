<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FotoController extends Controller
{
    public function mostrar($filename)
    {
        $session = session();

        // Validar login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Validar rol (5 = Admin, 6 = Supervisor)
        $rol = $session->get('ID_Rol');
        if (!in_array($rol, [5, 6])) {
            return $this->response->setStatusCode(403, 'Acceso denegado');
        }

        // Buscar archivo en writable/fotos
        $path = WRITEPATH . 'fotos/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Devolver imagen
        return $this->response
                    ->setHeader('Content-Type', mime_content_type($path))
                    ->setBody(file_get_contents($path));
    }
}

