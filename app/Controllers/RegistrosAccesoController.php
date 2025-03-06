<?php

namespace App\Controllers; // Define el espacio de nombres de los controladores en el proyecto

use App\Models\RegistroAccesoModel; // Importa el modelo RegistroAccesoModel para interactuar con los registros de acceso en la base de datos

class RegistrosAccesoController extends BaseController
{
    public function resultado(){
        
    }
    // Método para ver los registros de acceso
    public function verRegistros()
    {
        $session = session(); // Inicia o recupera la sesión actual
        $rol = $session->get("ID_Rol"); // Obtiene el rol del usuario desde la sesión

        // Verifica si el usuario tiene los permisos adecuados para ver los registros
        if ($rol != 5 && $rol != 6) { 
            // Si el rol no es 5 ni 6, redirige al usuario con un mensaje de error
            return redirect()->back()->with('error', 'No tienes permiso para ver los registros de acceso.');
        }

        // Si el usuario tiene los permisos necesarios:
        $registroModel = new RegistroAccesoModel(); // Crea una instancia de RegistroAccesoModel para interactuar con la base de datos
        $data['registros'] = $registroModel->getAllRecords(); // Obtiene todos los registros de acceso y los guarda en el array $data

        return view('ver-accesos-tarjeta', $data); // Carga la vista 'ver-accesos-tarjeta', pasando los datos de registros para mostrarlos
    }
}

?>