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

        // Obtener datos del formulario con los nuevos campos
        $data = [
            'Estado' => $this->request->getPost('Estado'),
            'UID' => $this->request->getPost('UID'),
            'Fecha_Expiracion' => $this->request->getPost('Fecha_Expiracion'),
            'Horario_Uso' => $this->request->getPost('Horario_Uso'),
            'Intentos_Fallidos' => 0, // Por defecto, 0 intentos fallidos
            'Bloqueada' => 0 // Por defecto, no bloqueada
        ];

        // Validar que el UID no esté vacío
        if (empty($data['UID'])) {
            return redirect()->back()->with('error', 'El UID de la tarjeta es requerido');
        }

        // Verificar si la tarjeta ya existe
        $existingTarjeta = $model->where('UID', $data['UID'])->first();

        if ($existingTarjeta) {
            return redirect()->back()->with('error', 'La tarjeta ya está registrada');
        }

        // Insertar la nueva tarjeta
        try {
            $model->insert($data);
            return redirect()->back()->with('success', 'Tarjeta creada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la tarjeta: ' . $e->getMessage());
        }
    }
}

?>