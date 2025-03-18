<?php

namespace App\Controllers;

use CodeIgniter\Session\Session; // Importa la clase de sesión de CodeIgniter
use App\Models\UserModel; // Importa el modelo de usuario

class UserController extends BaseController
{
    // Función para registrar cambios en el historial
    private function registrarCambio($mensaje)
{
    $logPath = WRITEPATH . 'logs/cambios/';
    if (!is_dir($logPath)) {
        if (!mkdir($logPath, 0755, true)) {
            echo "Error al crear el directorio de cambios.";
            return;
        }
    }

    // Nombre del archivo con la fecha actual
    $nombreArchivo = $logPath . 'historial_cambios_' . date('Y-m-d') . '.txt';

    // Formato del mensaje con la hora actual
    $registro = "[" . date('H:i:s') . "] " . $mensaje . PHP_EOL;

    // Intentar escribir en el archivo
    if (file_put_contents($nombreArchivo, $registro, FILE_APPEND) === false) {
        echo "Error al escribir en el archivo de cambios.";
    }
}


    // Función para cargar la vista de modificación de usuario
    public function Modificar($id = null)
    {
        $session = \Config\Services::session();
        $userModel = new UserModel();

        // Buscar el usuario por ID
        $usuario = $userModel->find($id);

        // Validar si el usuario tiene permiso para modificar (Rol 5)
        if ($session->get('ID_Rol') != 5) {
            return $this->response->redirect('/usuarios')->with('error', 'No tienes permiso para modificar el rol de otro usuario.');
        }

        $data = [
            'user_id' => $usuario
        ];

        return view('modificar-usuario', $data);
    }

    // Función para actualizar los datos del usuario
    public function actualizarUsuario()
    {
        $userModel = new UserModel();
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $rol = $this->request->getPost('ID_Rol');
        $tarjeta = $this->request->getPost('ID_Tarjeta');

        $data = [
            'ID_Usuario' => $id,
            'Nombre' => $nombre,
            'Email' => $email,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $tarjeta,
        ];

        // Actualizar los datos del usuario
        if ($userModel->updateUser($id, $data)) {
            // Registrar el cambio en el historial
            $mensaje = "CTU: Se modificaron los privilegios de \"{$nombre}\" al estado de \"{$rol}\".";
            $this->registrarCambio($mensaje);
            return redirect()->to(site_url('/modificar-usuario'))->with('success', 'Usuario actualizado correctamente');
        } else {
            return redirect()->to(site_url('/modificar-usuario'))->with('error', 'Hubo un problema al actualizar el usuario.');
        }
    }

    // Función para mostrar la vista de modificar usuarios
    public function VistaModificar()
    {
        $userModel = new UserModel();
        $user = $userModel->getUser();
        return view("modificar-usuario", ['user' => $user]);
    }

    // Función para mostrar la vista de modificación de un usuario específico
    public function VistaModificar2()
    {
        $id = $this->request->getPost('id');
        $userModel = new UserModel();
        $tarjetaModel = new \App\Models\TarjetaModel();
        
        $user = $userModel->getUserbyid($id);
        $tarjetas = $tarjetaModel->getAllTarjetas();

        return view("modificar-usuario2", ['user' => $user, 'tarjetas' => $tarjetas]);
    }

    // Función para eliminar un usuario
    public function eliminarUsuario()
    {
        $userModel = new UserModel();
        $id = $this->request->getPost('id');
        $usuario = $userModel->find($id);

        if ($usuario && $userModel->delete($id)) {
            // Registrar el cambio en el historial
            $mensaje = "EU: El usuario \"{$usuario['Nombre']}\" ha sido eliminado.";
            $this->registrarCambio($mensaje);
            return redirect()->to('/modificar-usuario')->with('success', 'El usuario ha sido eliminado correctamente.');
        } else {
            return redirect()->to('/modificar-usuario')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }
}
