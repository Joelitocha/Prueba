<?php

namespace App\Controllers; // Define el espacio de nombres de los controladores en el proyecto

use App\Models\TarjetaModel; // Importa el modelo TarjetaModel para interactuar con la base de datos de tarjetas

class CrearTarjetaController extends BaseController
{
    // Método para mostrar la vista de creación de tarjeta
    public function index()
    {
        return view('crear-tarjeta'); // Carga la vista 'crear-tarjeta', donde se muestra el formulario para crear una nueva tarjeta
    }
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
    // Método para almacenar una nueva tarjeta en la base de datos
    public function store()
    {
        $model = new TarjetaModel();
    
        // Obtener datos del formulario
        $data = [
            'Estado'            => $this->request->getPost('Estado'),
            'UID'               => $this->request->getPost('UID'),
            'id_empresa'        => session()->get('id_empresa'),
            'Intentos_Fallidos' => $this->request->getPost('Intentos_Fallidos') ?? 0,
            'Bloqueada'         => 0
        ];
    
        // Manejar Fecha_Expiracion (convertir vacío a null)
        $fechaExpiracion = $this->request->getPost('Fecha_Expiracion');
        $data['Fecha_Expiracion'] = empty($fechaExpiracion) ? null : $fechaExpiracion;
    
        // Validar UID
        if (empty($data['UID'])) {
            return redirect()->back()->with('error', 'El UID de la tarjeta es requerido');
        }
    
        // Verificar si la tarjeta ya existe
        if ($model->where('UID', $data['UID'])->first()) {
            return redirect()->back()->with('error', 'La tarjeta ya está registrada');
        }
    
        try {
            $model->insert($data);
    
            // 🔹 Guardar en historial el detalle de la tarjeta creada
            $detalle = json_encode($data, JSON_UNESCAPED_UNICODE);
            $this->registrarCambio("Se creó una nueva tarjeta con UID {$data['UID']}. Datos: {$detalle}");
    
            return redirect()->back()->with('success', 'Tarjeta creada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la tarjeta: ' . $e->getMessage());
        }
    }
    
}

?>