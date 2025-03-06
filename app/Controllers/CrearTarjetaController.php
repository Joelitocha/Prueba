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
        $model = new TarjetaModel(); // Crea una instancia de TarjetaModel para interactuar con la base de datos

        // Obtiene los datos ingresados en el formulario
        $estado = $this->request->getPost('Estado'); // Obtiene el estado de la tarjeta desde el formulario
        $fecha_emision = $this->request->getPost('Fecha_emision'); // Obtiene la fecha de emisión desde el formulario
        $uid_tarjeta = $this->request->getPost('UID'); // Obtiene el UID de la tarjeta desde el formulario

        // Verifica si una tarjeta con el mismo UID ya existe en la base de datos
        $existingTarjeta = $model->where('UID', $uid_tarjeta)->first();

        if ($existingTarjeta) {
            // Si la tarjeta ya está registrada, redirige a la misma página con un mensaje de error
            return redirect()->back()->with('error', 'La tarjeta ya está registrada');
        }

        // Inserta una nueva tarjeta en la base de datos con los datos ingresados
        $model->insert([
            'Estado' => $estado, // Guarda el estado de la tarjeta 
            'UID' => $uid_tarjeta // Guarda el UID de la tarjeta
        ]);

        return redirect()->back(); // Redirige nuevamente a la misma página después de la inserción
    }
}

?>