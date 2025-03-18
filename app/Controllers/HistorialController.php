<?php 

namespace App\Controllers;

class HistorialController extends BaseController
{
    // Método para mostrar la lista de archivos de historial
    public function index()
    {
        // Verificar y crear el directorio si no existe
        $logPath = WRITEPATH . 'logs/cambios/';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
    
        // Obtener la lista de archivos de historial
        $archivos = glob($logPath . "historial_cambios_*.txt");
        rsort($archivos); // Ordenar de más reciente a más antiguo
    
        $data = [
            'archivos' => $archivos,
            'logPath' => $logPath // Pasar la ruta a la vista
        ];
        return view('historialCambios', $data); 
    }
    
    

    // Método para mostrar el contenido de un archivo específico
    public function verArchivo()
{
    $nombreArchivo = $this->request->getPost('nombreArchivo');
    $logPath = WRITEPATH . 'logs/cambios/';
    $archivo = $logPath . $nombreArchivo;

    if (!file_exists($archivo)) {
        return $this->response->setStatusCode(404)->setBody('Archivo no encontrado');
    }

    $contenido = file_get_contents($archivo);
    return $this->response->setBody($contenido);
}


private function registrarCambio($mensaje)
{
    $logPath = WRITEPATH . 'logs/cambios/';
    if (!is_dir($logPath)) {
        mkdir($logPath, 0755, true);
    }

    // Nombre del archivo con la fecha actual
    $nombreArchivo = $logPath . 'historial_cambios_' . date('Y-m-d') . '.txt';

    // Formato del mensaje con la hora actual
    $registro = "[" . date('H:i:s') . "] " . $mensaje . PHP_EOL;

    // Escribir el mensaje en el archivo (añadir al final)
    file_put_contents($nombreArchivo, $registro, FILE_APPEND);
}
public function modificarRol($userId, $nuevoRol)
{
    $model = new UserModel();
    $usuario = $model->find($userId);

    if ($usuario) {
        $model->update($userId, ['ID_Rol' => $nuevoRol]);
        $mensaje = "CTU: Se modificaron los privilegios de \"{$usuario['Nombre']}\" al estado de \"{$nuevoRol}\".";
        $this->registrarCambio($mensaje);
        return redirect()->back()->with('success', 'Rol modificado correctamente.');
    } else {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }
}

}

?>
