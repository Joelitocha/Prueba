<?php

namespace App\Controllers; 

use App\Models\UserModel; 
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function loginUser()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('Contraseña');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['Contraseña'])) {
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
                "ID_tarjeta" => $user["ID_Tarjeta"]
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
            <p>Después de la verificación, podrás establecer tu contraseña.</p>
            <p>Si no solicitaste esta cuenta, ignora este mensaje.</p>
        ";
        return Services::sendEmail($email, 'Verificación de cuenta - RackON', $cuerpo);
    }

    private function enviarCredenciales($email, $nombre, $mensaje)
    {
        $cuerpo = "
            <h2>Cuenta Verificada</h2>
            <p>Hola $nombre,</p>
            <p>$mensaje</p>
            <p>Puedes acceder a la plataforma utilizando tu correo electrónico y la contraseña que estableciste.</p>
            <p>Gracias por unirte a RackON!</p>
        ";
        return Services::sendEmail($email, 'Cuenta verificada - RackON', $cuerpo);
    }

    public function verifyEmail()
    {
        $model = new UserModel();
        $token = $this->request->getGet('token');
        $user = $model->where('Token', $token)->first();

        if ($user) {
            // Redirigir a la página para establecer contraseña
            return redirect()->to('/set-password?token='.$token);
        }

        return redirect()->to('/')->with('error', 'Enlace de verificación inválido o expirado.');
    }

    public function showSetPassword()
    {
        $token = $this->request->getGet('token');
        
        // Verificar que el token sea válido
        $model = new UserModel();
        $user = $model->where('Token', $token)->first();
        
        if (!$user) {
            return redirect()->to('/')->with('error', 'Token inválido o expirado.');
        }
        
        return view('set_password', ['token' => $token]);
    }

    public function completeRegistration()
    {
        $model = new UserModel();
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Validaciones
        if (empty($password) || empty($confirm_password)) {
            return redirect()->back()->with('error', 'Por favor completa todos los campos.');
        }

        if ($password !== $confirm_password) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
        }

        if (strlen($password) < 8) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }

        $user = $model->where('Token', $token)->first();
        
        if ($user) {
            // Actualizar usuario con nueva contraseña
            $model->update($user['ID_Usuario'], [
                'Contraseña' => password_hash($password, PASSWORD_DEFAULT),
                'Verificado' => 1,
                'Token' => null
            ]);

            // Enviar correo de confirmación
            $this->enviarCredenciales(
                $user['email'], 
                $user['Nombre'], 
                "Tu cuenta ha sido verificada correctamente. Ahora puedes iniciar sesión con tu email y la contraseña que acabas de establecer."
            );

            return redirect()->to('/')->with('success', 'Registro completado. Ahora puedes iniciar sesión.');
        }

        return redirect()->to('/')->with('error', 'Token inválido o expirado.');
    }

    public function registerUser()
    {
        $model = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('email');
        $uid = $this->request->getPost('ID_Tarjeta');
        $rol = $this->request->getPost('ID_Rol');

        // Verificar si el usuario ya existe
        if ($model->where('Email', $email)->first()) {
            return redirect()->to('/register')->with('error', 'El correo electrónico ya está registrado.');
        }

        // Generar token de verificación
        $token = $this->generarToken();

        // Guardar el usuario en la base de datos con el token
        $model->insert([
            'Nombre' => $nombre,
            'email' => $email,
            'Contraseña' => '', // Contraseña vacía temporalmente
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid,
            'Token' => $token,
            'Verificado' => 0
        ]);

        // Enviar el correo de verificación con instrucciones
        $this->enviarCorreoVerificacion($email, $token);
        
        return redirect()->to('/register')->with('success', 'Usuario creado. Verifica tu correo para completar el registro.');
    }

    public function welcome()
    {
        $session = session();
        if (!$session->has('username')) {
            return redirect()->to('/');
        }
        return view("inicio");
    }

    public function registro()
    {
        $tarjetaModel = new \App\Models\TarjetaModel();
        $tarjetas = $tarjetaModel->getAllTarjetas();
        return view('register', ['tarjetas' => $tarjetas]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        setcookie(session_name(), '', time() - 3600);
        return redirect()->to('/');
    }

}