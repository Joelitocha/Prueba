<?php

namespace App\Controllers;

use CodeIgniter\Session\Session;
use App\Models\UserModel;

class UserController extends BaseController
{
    // Función para registrar cambios en el historial
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

    // Función para registrar un nuevo usuario
    public function registerUser()
    {
        $userModel = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $password = password_hash($this->request->getPost('Contraseña'), PASSWORD_DEFAULT);
        $uid = $this->request->getPost('ID_Tarjeta');
        $rol = $this->request->getPost('ID_Rol');

        $data = [
            'Nombre' => $nombre,
            'Email' => $email,
            'Contraseña' => $password,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid,
            'Token' => null,
            'Verificado' => 1
        ];

        if ($userModel->insertUser($data)) {
            $mensaje = "CU: Se creó un nuevo usuario \"{$nombre}\" con rol \"{$rol}\" y tarjeta \"{$uid}\".";
            $this->registrarCambio($mensaje);
            return redirect()->to('/register')->with('success', 'Usuario creado correctamente');
        } else {
            return redirect()->to('/register')->with('error', 'Hubo un problema al crear el usuario');
        }
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

        // Obtener los datos previos del usuario
        $usuarioAnterior = $userModel->find($id);

        $data = [
            'ID_Usuario' => $id,
            'Nombre' => $nombre,
            'Email' => $email,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $tarjeta,
        ];

        // Actualizar los datos del usuario
        if ($userModel->updateUser($id, $data)) {
            // Verificar si hubo cambios y registrar cada uno
            if ($usuarioAnterior['Nombre'] !== $nombre) {
                $mensaje = "MU: El usuario con ID \"{$id}\" cambió su nombre de \"{$usuarioAnterior['Nombre']}\" a \"{$nombre}\".";
                $this->registrarCambio($mensaje);
            }
            if ($usuarioAnterior['Email'] !== $email) {
                $mensaje = "ME: El usuario \"{$nombre}\" actualizó su email de \"{$usuarioAnterior['Email']}\" a \"{$email}\".";
                $this->registrarCambio($mensaje);
            }
            if ($usuarioAnterior['ID_Rol'] !== $rol) {
                $mensaje = "MR: El usuario \"{$nombre}\" cambió su rol de \"{$usuarioAnterior['ID_Rol']}\" a \"{$rol}\".";
                $this->registrarCambio($mensaje);
            }
            if ($usuarioAnterior['ID_Tarjeta'] !== $tarjeta) {
                $mensaje = "MT: El usuario \"{$nombre}\" cambió su tarjeta de \"{$usuarioAnterior['ID_Tarjeta']}\" a \"{$tarjeta}\".";
                $this->registrarCambio($mensaje);
            }

            log_message('info', 'Actualización de usuario realizada: ' . $mensaje);

            return redirect()->to(site_url('/modificar-usuario'))->with('success', 'Usuario actualizado correctamente');
        } else {
            log_message('error', 'Error al actualizar el usuario.');
            return redirect()->to(site_url('/modificar-usuario'))->with('error', 'Hubo un problema al actualizar el usuario.');
        }
    }

    // Función para mostrar la vista de modificar usuarios
    public function VistaModificar()
    {
        $userModel = new UserModel();
    
        // Obtener el id_empresa de la sesión
        $idEmpresa = session()->get('id_empresa');
    
        // Obtener solo los usuarios de esa empresa
        $usuarios = $userModel->getUserByEmpresa($idEmpresa);
    
        return view("modificar-usuario", ['user' => $usuarios]);
    }
    

    // Función para mostrar la vista de modificación de un usuario específico
    public function VistaModificar2()
    {
        $id = $this->request->getPost('id');
        $userModel = new UserModel();
        $tarjetaModel = new \App\Models\TarjetaModel();
        
        $user = $userModel->getUserbyid($id);
    
        // Obtener ID_Empresa de la sesión
        $idEmpresa = session()->get('id_empresa');
    
        // Obtener solo las tarjetas asociadas a la empresa
        $tarjetas = $tarjetaModel->getTarjetasPorEmpresa($idEmpresa);
    
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
            $mensaje = "EU: El usuario \"{$usuario['Nombre']}\" con ID \"{$id}\" ha sido eliminado.";
            $this->registrarCambio($mensaje);
            //
            return redirect()->to('/modificar-usuario')->with('success', 'Usuario eliminado correctamente');
        } else {
            return redirect()->to('/modificar-usuario')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }
}

