<?php

namespace App\Controllers; // Define el espacio de nombres del controlador en el proyecto

use App\Models\TarjetaModel; // Importa el modelo TarjetaModel para interactuar con la base de datos de tarjetas

class TarjetaController extends BaseController
{
    private function registrarCambio($mensaje)
    {
        $logPath = WRITEPATH . 'logs/cambios/';
        if (!is_dir($logPath)) {
            if (!mkdir($logPath, 0755, true)) {
                log_message('error', 'Error al crear el directorio de cambios: ' . $logPath);
                return;
            }
        }

        // Nombre del archivo con la fecha actual
        $nombreArchivo = $logPath . 'historial_cambios_' . date('Y-m-d') . '.txt';

        // Formato del mensaje con la hora actual
        $registro = "[" . date('H:i:s') . "] " . $mensaje . PHP_EOL;

        // Intentar escribir en el archivo y verificar el resultado
        if (file_put_contents($nombreArchivo, $registro, FILE_APPEND) === false) {
            log_message('error', 'Error al escribir en el archivo de cambios: ' . $nombreArchivo);
        } else {
            log_message('info', 'Cambio registrado correctamente: ' . $registro);
        }
    }
    // Muestra la vista para modificar tarjetas
    public function VistaModificar()
    {
        $tarjetaModel = new TarjetaModel();
        $idEmpresa = session()->get('id_empresa');
        $tarjetas = $tarjetaModel->getTarjetasPorEmpresa($idEmpresa);
    
        return view('modificar-tarjeta', ['tarjetas' => $tarjetas]);
    }
    

    // Muestra una tarjeta específica en la vista de modificación
    public function VistaModificar2()
    {
        $id = $this->request->getPost('ID_Tarjeta'); // Obtiene el ID de la tarjeta enviada por POST
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        
        // Obtiene los datos de la tarjeta con el ID especificado
        $tarjeta = $tarjetaModel->find($id);
        
        // Pasa los datos de la tarjeta a la vista 'modificar-tarjeta2'
        return view('modificar-tarjeta2', ['tarjeta' => $tarjeta]);
    }

    // Muestra la vista para crear una nueva tarjeta
    public function crear()
    {
        return view('crear-tarjeta');
    }

    // Muestra la vista para gestionar (eliminar) tarjetas
    public function gestionar()
    {
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        $tarjetas = $tarjetaModel->getAllTarjetas(); // Obtiene todas las tarjetas para la gestión

        // Pasa las tarjetas a la vista 'eliminar-tarjeta'
        return view('eliminar-tarjeta', ['tarjetas' => $tarjetas]);
    }

    public function delete()
    {
        $session = session();
        $rol = $session->get("ID_Rol");
    
        if ($rol != 5) {
            return redirect()->to('/modificar-tarjeta')->with('error', 'No tienes permiso para eliminar tarjetas');
        }
    
        $id = $this->request->getPost('ID_Tarjeta');
        $tarjetaModel = new TarjetaModel();
        $tarjeta = $tarjetaModel->find($id);
    
        if (!$tarjeta) {
            return redirect()->to('/modificar-tarjeta')->with('error', 'Tarjeta no encontrada');
        }
    
        $tarjetaModel->delete($id);
    
        $detalle = json_encode($tarjeta, JSON_UNESCAPED_UNICODE);
        $this->registrarCambio("Se eliminó la tarjeta con ID {$id}. Datos previos: {$detalle}");
    
        return redirect()->back();
    }
    


    // Carga la vista para editar una tarjeta específica
    public function editar($id)
    {
        $session = session(); // Inicia o recupera la sesión actual
        $rol = $session->get("ID_Rol"); // Obtiene el rol del usuario de la sesión

        // Verifica si el usuario tiene permiso para modificar tarjetas (solo el rol 5)
        if ($rol != 5) {
            return redirect()->to('/gestionar-tarjeta')->with('error', 'No tienes permiso para modificar tarjetas');
        }

        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        $tarjeta = $tarjetaModel->getTarjetaById($id); // Obtiene la tarjeta con el ID especificado

        // Verifica si la tarjeta existe
        if (!$tarjeta) {
            return redirect()->to('/gestionar-tarjeta')->with('error', 'Tarjeta no encontrada');
        }

        // Carga la vista de modificación con los datos de la tarjeta
        return view('modificar-tarjeta', ['tarjeta' => $tarjeta]);
    }

    // Ver el estado de una tarjeta específica
    public function verEstadoTarjeta()
    {
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        
        // Captura el ID de la tarjeta desde el formulario
        $idTarjeta = $this->request->getPost('id_tarjeta');
        
        // Verifica que el ID no esté vacío
        if (!empty($idTarjeta)) {
            // Obtiene el estado de la tarjeta con el ID especificado
            $tarjeta = $tarjetaModel->obtenerEstado($idTarjeta);

            if ($tarjeta) {
                // Si se encuentra la tarjeta, muestra su estado en la vista 'consultar-rfid'
                return view('consultar-rfid', ['estado' => $tarjeta[0]['Estado']]);
            } else {
                // Si no se encuentra la tarjeta, muestra un mensaje de error
                return view('consultar-rfid', ['error' => 'Tarjeta no encontrada']);
            }
        } else {
            // Si el ID_Tarjeta está vacío, muestra un mensaje de error
            return view('consultar-rfid', ['error' => 'ID de tarjeta no proporcionado']);
        }
    }
    // En TarjetaController.php

public function bloquearTarjeta()
{
    $id = $this->request->getPost('ID_Tarjeta');
    $model = new TarjetaModel();

     $model->updateTarjeta($id, [
         'Estado' => 0,
         'Intentos_Fallidos' => 3 // Forzar bloqueo
     ]);
     $this->registrarCambio("Se bloqueó la tarjeta con ID {$id}");
    
     return redirect()->to('/modificar-tarjeta')->with('success', 'Tarjeta bloqueada exitosamente');
}

public function desbloquearTarjeta()
{
    $id = $this->request->getPost('ID_Tarjeta');
    $model = new TarjetaModel();
    
    $model->updateTarjeta($id, [
        'Estado' => 1,
        'Intentos_Fallidos' => 0 // Resetear intentos
    ]);
    $this->registrarCambio("Se desbloqueó la tarjeta con ID {$id}");
    
    return redirect()->to('/modificar-tarjeta')->with('success', 'Tarjeta desbloqueada exitosamente');
}

public function update()
{
    $model = new TarjetaModel();
    $id = $this->request->getPost('ID_Tarjeta');
    
    $data = [
        'Estado' => $this->request->getPost('estado'),
        'Intentos_Fallidos' => $this->request->getPost('intentos_fallidos') ?? 0,
        'Bloqueada' => $this->request->getPost('bloqueada') ?? 0
    ];

    // Manejar Fecha_Expiracion
    $fechaExpiracion = $this->request->getPost('fecha_expiracion');
    $data['Fecha_Expiracion'] = empty($fechaExpiracion) ? null : $fechaExpiracion;

    // Manejar Horario_Uso
    $horarioUso = trim($this->request->getPost('horario_uso'));
    $data['Horario_Uso'] = empty($horarioUso) ? null : $horarioUso;

    $model->update($id, $data);
    return redirect()->to('/modificar-tarjeta')->with('success', 'Tarjeta actualizada exitosamente');
}
}

?>