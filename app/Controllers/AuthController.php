<?php

namespace App\Controllers; // Define el espacio de nombres para organizar el proyecto

use App\Models\UserModel; // Importa el modelo de usuario para interactuar con la base de datos

class AuthController extends BaseController
{
    // Método para mostrar la vista de login
    public function index()
    {
        return view('login'); // Carga la vista de inicio de sesión
    }

    // Método para iniciar sesión
    public function loginUser()
    {
        $model = new UserModel(); // Crea una instancia del modelo UserModel
        $email = $this->request->getPost('Email'); // Obtiene el email ingresado por el usuario
        $password = $this->request->getPost('Contraseña'); // Obtiene la contraseña ingresada por el usuario

        $user = $model->where('Email', $email)->first(); // Busca en la base de datos un usuario con el email ingresado

        // Verifica si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['Contraseña'])) {
            // Actualiza el campo Ultimo_Acceso con la fecha y hora actual
            $model->update($user['ID_Usuario'], ['Ultimo_Acceso' => date('Y-m-d H:i:s')]);

            $session = session(); // Inicia la sesión

            // Define los datos de sesión para el usuario
            $datos = [
                "user_id" => $user["ID_Usuario"],
                "logged_in" => true,
                "username" => $user["Nombre"],
                "ID_Rol" => $user["ID_Rol"]
            ];
            $session->set($datos); // Guarda los datos en la sesión

            return redirect()->to('/bienvenido'); // Redirige a la página de bienvenida
        } else {
            // Si el usuario o la contraseña no son correctos, redirige al login con un mensaje de error
            return redirect()->to('/')->with('error', 'Usuario o clave incorrectos');
        }
    }

    // Método para registrar un nuevo usuario
    public function registerUser()
    {
        $session=session();
        $model = new UserModel(); // Crea una instancia del modelo UserModel
        $nombre = $this->request->getPost('Nombre'); // Obtiene el nombre ingresado
        $email = $this->request->getPost('Email'); // Obtiene el email ingresado
        $password = password_hash($this->request->getPost('Contraseña'), PASSWORD_DEFAULT); // Hashea la contraseña ingresada
        $uid = $this->request->getPost('ID_Tarjeta'); // Obtiene el ID de tarjeta ingresado
        $rol = $this->request->getPost('ID_Rol'); // Obtiene el rol ingresado

        $existingUser = $model->userExists($email, $nombre); // Verifica si el usuario ya existe

        if ($existingUser) {
            // Si el usuario ya está registrado, redirige al login con un mensaje de error
            return redirect()->to('/')->with('error', 'El correo o usuario ya están registrados');
        }

        // Inserta el nuevo usuario en la base de datos
        $model->insertUser([
            'Nombre' => $nombre,
            'Email' => $email,
            'Contraseña' => $password,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid
        ]);
        $session->setFlashdata('success','Usuario creado correctamente');
        return redirect()->to('/register'); // Redirige a la bienvenida con mensaje de éxito
    }

    // Método para mostrar la página de bienvenida solo si el usuario tiene sesión iniciada
    public function welcome()
    {
        $session = session(); // Inicia la sesión
        if (!$session->has('username')) {
            // Si no hay sesión iniciada, redirige al login
            return redirect()->to('/');
        }
        $userRole = $session->get('rol'); // Obtiene el rol del usuario desde la sesión
        return view("inicio"); // Muestra la vista de bienvenida
    }

    // Método para mostrar la vista de registro
    public function registro()
    {
        $tarjetaModel = new \App\Models\TarjetaModel(); // Instancia del modelo TarjetaModel
        $tarjetas = $tarjetaModel->getAllTarjetas(); // Obtiene solo tarjetas activas

        return view('register', ['tarjetas' => $tarjetas]); // Envía las tarjetas a la vista
    }

    // Método para cerrar la sesión del usuario
    public function logout()
    {
        $session = session(); // Inicia la sesión
        $session->remove('user_id'); // Elimina el ID del usuario de la sesión
        $session->remove('logged_in'); // Elimina el estado de "logged_in" de la sesión
        $session->remove('username'); // Elimina el nombre del usuario de la sesión
        $session->destroy(); // Destruye la sesión completamente
        setcookie(session_name(), '', time() - 3600); // Borra la cookie de sesión
        return redirect()->to('/'); // Redirige al login
    }
}

?>