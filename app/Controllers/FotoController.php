<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FotoController extends Controller
{
    public function mostrar($idAcceso)
    {
        $session = session();
        $rol = $session->get('ID_Rol');
    
        if (!in_array($rol, [5, 6, 7])) {
            return redirect()->to('/no-autorizado');
        }
    
        $registroModel = new \App\Models\RegistroAccesoModel();
        $registro = $registroModel->find($idAcceso);
    
        try {
            if (!$registro || empty($registro['Archivo_Video'])) {
                throw new \Exception("Registro o archivo inexistente");
            }
    
            $ruta = WRITEPATH . 'uploads/fotos/' . $registro['Archivo_Video'];
    
            if (!is_file($ruta)) {
                throw new \Exception("Archivo físico no encontrado: $ruta");
            }
    
            $data = file_get_contents($ruta);
            if ($data === false) throw new \Exception("Error al leer el archivo");
    
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody($data);
    
        } catch (\Exception $e) {
            log_message('error', "[FotoController::mostrar] " . $e->getMessage());
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Foto no disponible");
        }
    }
    
}

