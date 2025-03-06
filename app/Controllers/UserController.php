<?php

namespace App\Controllers;

use CodeIgniter\Session\Session; // Importa la clase de sesión de CodeIgniter
use App\Models\UserModel; // Importa el modelo de usuario

class UserController extends BaseController
{
    // Función para cargar la vista de modificación de usuario
    public function Modificar($id = null)
    {
        $session = \Config\Services::session(); // Inicializa el servicio de sesión
        $userModel = new UserModel(); // Crea una instancia del modelo de usuario

        // Buscar el usuario por ID
        $usuario = $userModel->find($id);

        // Validar si el usuario tiene permiso para modificar (Rol 5)
        if ($session->get('ID_Rol') != 5) {
            return $this->response->redirect('/usuarios')->with('error', 'No tienes permiso para modificar el rol de otro usuario.');
        }

        $data = [
            'user_id' => $usuario // Prepara los datos del usuario para la vista
        ];

        // Cargar la vista de modificación
        return view('modificar-usuario', $data);
    }

    // Función para actualizar los datos del usuario
    public function actualizarUsuario()
    {
        $userModel = new UserModel(); // Instancia del modelo de usuarios
    
        // Obtener los datos del formulario
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $rol = $this->request->getPost('ID_Rol');
        $tarjeta = $this->request->getPost('ID_Tarjeta');
    
        // Crear un arreglo con los datos que quieres actualizar
        $data = [
            'ID_Usuario' => $id,
            'Nombre' => $nombre,
            'Email' => $email,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $tarjeta,
        ];
    
        // Actualizar los datos del usuario
        $userModel->updateUser($id, $data);
    
        // Redirigir a la vista de modificación
        return redirect()->to(site_url('/modificar-usuario'))->with('success', 'Usuario actualizado correctamente');
    }
    

    // Función para mostrar la vista de modificar usuarios
    public function VistaModificar()
    {
        $userModel = new UserModel(); // Instancia del modelo de usuario
        $user = $userModel->getUser(); // Obtiene todos los usuarios
        return view("modificar-usuario", ['user' => $user]); // Carga la vista con los usuarios
    }

    // Función para mostrar la vista de modificación de un usuario específico
    public function VistaModificar2()
    {
        $id = $this->request->getPost('id'); // Obtiene el ID del usuario
        $userModel = new UserModel(); // Instancia del modelo de usuario
        $tarjetaModel = new \App\Models\TarjetaModel(); // Instancia del modelo de tarjeta
    
        // Obtén el usuario por ID
        $user = $userModel->getUserbyid($id);
    
        // Obtén todas las tarjetas
        $tarjetas = $tarjetaModel->getAllTarjetas();
    
        // Pasa los datos del usuario y las tarjetas a la vista
        return view("modificar-usuario2", ['user' => $user, 'tarjetas' => $tarjetas]);
    }
    

    // Función para cargar la vista de eliminación de usuarios
    public function VistaEliminar()
    {
        $userModel = new UserModel(); // Instancia del modelo de usuario
        $user = $userModel->getUser(); // Obtiene todos los usuarios
        return view("eliminar-usuarios", ['user' => $user]); // Carga la vista de eliminación con los usuarios
    }

    // Función para eliminar un usuario
    public function eliminarUsuario()
    {
        $userModel = new UserModel();
        $id = $this->request->getPost('id');
    
        if ($userModel->delete($id)) {
            // Establecer un mensaje de éxito en la sesión
            return redirect()->to('/eliminar-usuarios')->with('success', 'El usuario ha sido eliminado correctamente.');
        } else {
            // Establecer un mensaje de error en caso de fallo
            return redirect()->to('/eliminar-usuarios')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }
    
}