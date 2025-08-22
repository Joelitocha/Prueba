<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FotoController extends Controller
{
    public function mostrar($nombreArchivo)
    {
        $ruta = WRITEPATH . 'uploads/fotos/' . $nombreArchivo;

        if (!file_exists($ruta)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Archivo no encontrado");
        }

        // Detectar mime automáticamente
        $mime = mime_content_type($ruta);

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($ruta));
    }
}
