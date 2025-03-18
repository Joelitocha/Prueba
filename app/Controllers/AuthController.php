<?php

namespace App\Controllers; // Define el espacio de nombres para organizar el proyecto

use App\Models\UserModel; // Importa el modelo de usuario para interactuar con la base de datos q9wuhqwi9ouehjfew
use Config\Services;

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
        $model = new UserModel();
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Contraseña');

        $user = $model->where('Email', $email)->first();

        // Verifica si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['Contraseña'])) {
            // Verificar si la cuenta está verificada
            if ($user['Verificado'] == 0) {
                return redirect()->to('/')->with('error', 'Cuenta no verificada. Por favor, revisa tu correo.');
            }

            $model->update($user['ID_Usuario'], ['Ultimo_Acceso' => date('Y-m-d H:i:s')]);
            $session = session();
            $datos = [
                "user_id" => $user["ID_Usuario"],
                "logged_in" => true,
                "username" => $user["Nombre"],
                "ID_Rol" => $user["ID_Rol"],
                'ID_tarjeta' => $user['ID_Tarjeta']
            ];
            $session->set($datos);

            return redirect()->to('/bienvenido');
        } else {
            return redirect()->to('/')->with('error', 'Usuario o clave incorrectos');
        }
    }
    private function generarToken()
    {
        return bin2hex(random_bytes(16));
    }
    private function enviarCorreoVerificacion($email, $token)
    {
        $verificationLink = base_url("verify?token=" . $token);
        $cuerpo = "
            <h2>¡Bienvenido a RackON!</h2>
            <p>Haz clic en el siguiente enlace para verificar tu cuenta:</p>
            <a href='$verificationLink'>Verificar Cuenta</a>
            <p>Si no solicitaste esta cuenta, ignora este mensaje.</p>
        ";
        return Services::sendEmail($email, 'Verificación de cuenta - RackON', $cuerpo);
    }
    private function enviarCredenciales($email, $nombre, $password)
    {
        $cuerpo = "
            <h2>Cuenta Verificada</h2>
            <p>Tu cuenta ha sido verificada exitosamente.</p>
            <p>Nombre de usuario: $nombre</p>
            <p>Contraseña: $password</p>
        ";
        return Services::sendEmail($email, 'Credenciales de acceso - RackON', $cuerpo);
    }
    public function verifyEmail()
    {
        $model = new UserModel();
        $token = $this->request->getGet('token');
        $user = $model->where('Token', $token)->first();

        if ($user) {
            $model->update($user['ID_Usuario'], ['Verificado' => 1, 'Token' => null]);
            $this->enviarCredenciales($user['Email'], $user['Nombre'], 'contraseña');
            return redirect()->to('/')->with('success', 'Cuenta verificada correctamente.');
        }

        return redirect()->to('/')->with('error', 'Enlace de verificación inválido.');
    }
    // Método para registrar un nuevo usuario
    public function registerUser()
    {
        $model = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $password = password_hash($this->request->getPost('Contraseña'), PASSWORD_DEFAULT);
        $uid = $this->request->getPost('ID_Tarjeta');
        $rol = $this->request->getPost('ID_Rol');

        $token = $this->generarToken();

        $model->insertUser([
            'Nombre' => $nombre,
            'Email' => $email,
            'Contraseña' => $password,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid,
            'Token' => $token,
            'Verificado' => 0
        ]);

        $this->enviarCorreoVerificacion($email, $token);
        return redirect()->to('/register')->with('success', 'Usuario creado. Verifica tu correo.');
    }

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