<?php 

namespace App\Controllers;

class HistorialController extends BaseController
{
    // Método para mostrar la lista de archivos de historial
    public function index()
    {
        $logPath = WRITEPATH . 'logs/';
        $archivos = glob($logPath . "historial_cambios_*.txt");
        rsort($archivos); // Ordenar de más reciente a más antiguo

        $data = ['archivos' => $archivos];
        return view('HistorialCambios', $data); // Actualizar el nombre de la vista
    }

    // Método para mostrar el contenido de un archivo específico
    public function verArchivo($nombreArchivo)
    {
        $logPath = WRITEPATH . 'logs/';
        $archivo = $logPath . $nombreArchivo;

        if (!file_exists($archivo)) {
            return redirect()->to('/historial-cambios')->with('error', 'Archivo no encontrado');
        }

        $cambios = file($archivo);
        return view('HistorialCambios', ['cambios' => $cambios, 'nombreArchivo' => $nombreArchivo]); // Actualizar el nombre de la vista
    }
}

?>
