<?php 

namespace App\Controllers;

class HistorialController extends BaseController
{
    // Método para mostrar la lista de archivos de historial
    public function index()
    {
        $session = session();
        
        // Verificar si la sesión está activa
        if (!$session->has('username')) {
            return redirect()->to('/')->with('error', 'Sesión no iniciada.');
        }

        $logPath = WRITEPATH . 'logs/cambios/';
        
        // Verificar si el directorio existe, si no, crearlo
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }

        $archivos = glob($logPath . 'historial_cambios_*.txt');
        rsort($archivos); // Ordenar de más reciente a más antiguo

        $data = ['archivos' => $archivos];
        return view('HistorialCambios', $data);
    }

    // Método para mostrar el contenido de un archivo específico
    public function verArchivo()
    {
        $session = session();

        // Verificar si la sesión está activa
        if (!$session->has('username')) {
            return redirect()->to('/')->with('error', 'Sesión no iniciada.');
        }

        // Obtener el nombre del archivo desde la solicitud POST
        $nombreArchivo = $this->request->getPost('nombreArchivo');
        $logPath = WRITEPATH . 'logs/cambios/';
        $archivo = $logPath . $nombreArchivo;

        // Verificar si el archivo existe
        if (!file_exists($archivo)) {
            return $this->response->setStatusCode(404)->setBody('Archivo no encontrado');
        }

        // Leer el contenido del archivo y devolverlo como texto
        $contenido = file_get_contents($archivo);
        return $this->response->setHeader('Content-Type', 'text/plain')->setBody($contenido);
    }
}

