<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FotoController extends Controller
{
    public function mostrar($filename)
    {
        $session = session();
        $rol = $session->get('ID_Rol');
    
        // Solo roles válidos
        if (!in_array($rol, [5, 6, 7])) {
            return redirect()->to('/no-autorizado');
        }
    
        $registroModel = new RegistroAccesoModel();
        $registro = $registroModel->find($idAcceso);
    
        if (!$registro || empty($registro['Foto'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    
        $ruta = WRITEPATH . 'fotos/' . $registro['Foto'];
    
        if (!is_file($ruta)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    
        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setBody(file_get_contents($ruta));
    }
}

