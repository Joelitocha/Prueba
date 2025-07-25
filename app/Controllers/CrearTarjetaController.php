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

    // Método para almacenar una nueva tarjeta en la base de datos
    public function store()
    {
        $model = new TarjetaModel();
    
        // Obtener datos del formulario
        $data = [
            'Estado' => $this->request->getPost('Estado'),
            'UID' => $this->request->getPost('UID'),
            'id_empresa' => session()->get('id_empresa'),
            'Intentos_Fallidos' => $this->request->getPost('Intentos_Fallidos') ?? 0,
            'Bloqueada' => 0
        ];
    
        // Manejar Fecha_Expiracion (convertir vacío a null)
        $fechaExpiracion = $this->request->getPost('Fecha_Expiracion');
        $data['Fecha_Expiracion'] = empty($fechaExpiracion) ? null : $fechaExpiracion;
    
        // Manejar Horario_Uso (convertir vacío a null)
        $horarioUso = trim($this->request->getPost('Horario_Uso'));
        $data['Horario_Uso'] = empty($horarioUso) ? null : $horarioUso;
    
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
            return redirect()->back()->with('success', 'Tarjeta creada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la tarjeta: ' . $e->getMessage());
        }
    }
}

?>