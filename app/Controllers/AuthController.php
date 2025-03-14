<?php 

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

class AuthController extends BaseController
{
    // Método para mostrar la vista de login
    public function index()
    {
        return view('login');
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
            // Verificar si la cuenta está activada
            if ($user['Verificado'] == 0) {
                return redirect()->to('/')->with('error', 'Por favor, verifica tu cuenta antes de iniciar sesión.');
            }

            // Actualiza el campo Ultimo_Acceso con la fecha y hora actual
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

    // Método privado para generar un token único
    private function generarToken() {
        return bin2hex(random_bytes(16));
    }

    // Método para enviar el correo de verificación
    private function enviarCorreoVerificacion($email, $token) {
        $emailService = \Config\Services::email();
        
        $verificationLink = base_url("verify?token={$token}");
        $message = "
            <h2>¡Bienvenido a RackON!</h2>
            <p>Por favor, haz clic en el siguiente enlace para verificar tu cuenta:</p>
            <a href='{$verificationLink}'>Verificar cuenta</a>
            <p>Si no solicitaste esta cuenta, simplemente ignora este mensaje.</p>
        ";

        $emailService->setFrom('RackOnOficial@gmail.com', 'RackON');
        $emailService->setTo($email);
        $emailService->setSubject('Verificación de cuenta - RackON');
        $emailService->setMessage($message);

        if (!$emailService->send()) {
            echo 'Error al enviar el correo de verificación: ' . $emailService->printDebugger();
        }
    }

    // Método para verificar la cuenta a partir del token
    public function verificarCuenta()
    {
        $model = new UserModel();
        $token = $this->request->getGet('token');

        if (!$token) {
            return redirect()->to('/')->with('error', 'Token no proporcionado.');
        }

        $user = $model->where('Token', $token)->first();

        if ($user) {
            // Actualizar el estado de verificación del usuario
            $model->update($user['ID_Usuario'], ['Verificado' => 1, 'Token' => null]);
            return redirect()->to('/')->with('success', 'Cuenta verificada correctamente.');
        } else {
            return redirect()->to('/')->with('error', 'Token inválido o expirado.');
        }
    }

    // Método para registrar un nuevo usuario
    public function registerUser()
    {
        $session = session();
        $model = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $password = password_hash($this->request->getPost('Contraseña'), PASSWORD_DEFAULT);
        $uid = $this->request->getPost('ID_Tarjeta');
        $rol = $this->request->getPost('ID_Rol');

        $existingUser = $model->userExists($email, $nombre);

        if ($existingUser) {
            return redirect()->to('/')->with('error', 'El correo o usuario ya están registrados');
        }

        // Generar el token de verificación
        $token = $this->generarToken();

        // Inserta el nuevo usuario en la base de datos
        $model->insertUser([
            'Nombre' => $nombre,
            'Email' => $email,
            'Contraseña' => $password,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid,
            'Token' => $token,
            'Verificado' => 0
        ]);

        // Enviar el correo de verificación
        $this->enviarCorreoVerificacion($email, $token);

        $session->setFlashdata('success', 'Usuario creado correctamente. Por favor verifica tu correo.');
        return redirect()->to('/register');
    }

    // Método para mostrar la página de bienvenida solo si el usuario tiene sesión iniciada
    public function welcome()
    {
        $session = session();
        if (!$session->has('username')) {
            return redirect()->to('/');
        }
        return view("inicio");
    }

    // Método para mostrar la vista de registro
    public function registro()
    {
        $tarjetaModel = new \App\Models\TarjetaModel();
        $tarjetas = $tarjetaModel->getAllTarjetas();
        return view('register', ['tarjetas' => $tarjetas]);
    }

    // Método para cerrar la sesión del usuario
    public function logout()
    {
        $session = session();
        $session->destroy();
        setcookie(session_name(), '', time() - 3600);
        return redirect()->to('/');
    }
}

?>
