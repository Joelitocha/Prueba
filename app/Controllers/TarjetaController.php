<?php

namespace App\Controllers; // Define el espacio de nombres del controlador en el proyecto

use App\Models\TarjetaModel; // Importa el modelo TarjetaModel para interactuar con la base de datos de tarjetas

class TarjetaController extends BaseController
{
    // Muestra la vista para modificar tarjetas
    public function VistaModificar()
    {
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        
        // Obtiene todas las tarjetas de la base de datos
        $tarjetas = $tarjetaModel->findAll(); 

        // Pasa las tarjetas a la vista 'modificar-tarjeta'
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

    // Elimina una tarjeta
    public function delete()
    {
        $session = session(); // Inicia o recupera la sesión actual
        $rol = $session->get("ID_Rol"); // Obtiene el rol del usuario de la sesión

        // Verifica si el usuario tiene permiso para eliminar tarjetas (solo el rol 5 puede eliminar)
        if ($rol != 5) {
            return redirect()->to('/gestionar-tarjeta')->with('error', 'No tienes permiso para eliminar tarjetas');
        }

        // Obtiene el ID de la tarjeta desde el formulario
        $id = $this->request->getPost('ID_Tarjeta');

        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        $tarjeta = $tarjetaModel->find($id); // Busca la tarjeta con el ID especificado

        // Verifica si la tarjeta existe antes de intentar eliminarla
        if (!$tarjeta) {
            return redirect()->to('/gestionar-tarjeta')->with('error', 'Tarjeta no encontrada');
        }
        $session->setFlashdata('success','Tarjeta eliminada correctamente');
        // Elimina la tarjeta de la base de datos
        $tarjetaModel->delete($id);
        return redirect()->back(); // Redirige a la misma página
    }

    // Crea y guarda una nueva tarjeta en la base de datos
    public function store()
    {
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas
        
        // Prepara los datos para la nueva tarjeta con la información del formulario
        $data = [
            'ID_Tarjeta' => $this->request->getPost('ID_Tarjeta'),
            'Estado' => $this->request->getPost('Estado'),
            'Fecha_emision' => $this->request->getPost('Fecha_emision'),
            'UID' => $this->request->getPost('UID')
        ];

        // Inserta la nueva tarjeta en la base de datos
        $tarjetaModel->insertTarjeta($data);

        // Redirige a la vista de creación de tarjetas con un mensaje de éxito
        return redirect()->to('/crear-tarjeta')->with('success', 'Tarjeta creada exitosamente');
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

    // Actualiza los datos de una tarjeta en la base de datos
    public function update()
    {
        $tarjetaModel = new TarjetaModel(); // Crea una instancia del modelo de tarjetas

        // Obtiene los datos del formulario para actualizar la tarjeta
        $id = $this->request->getPost('ID_Tarjeta');
        $data = [
            'Estado' => $this->request->getPost('estado') 

        ];

        // Actualiza la tarjeta en la base de datos
        $tarjetaModel->update($id, $data);

        // Redirige a la vista de modificación con un mensaje de éxito
        return redirect()->to('/modificar-tarjeta')->with('success', 'Tarjeta actualizada exitosamente');
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
}

?>