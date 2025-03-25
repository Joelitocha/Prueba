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
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Contraseña');

        $user = $model->where('Email', $email)->first();

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
            <p>Si no solicitaste esta cuenta, ignora este mensaje.</p>
        ";
        return Services::sendEmail($email, 'Verificación de cuenta - RackON', $cuerpo);
    }

    private function enviarCredenciales($email, $nombre, $password)
    {
        $cuerpo = "
            <h2>Cuenta Verificada</h2>
            <p>Tu cuenta ha sido verificada exitosamente.</p>
            <p>Nombre de usuario (Email): $email</p>
            <p>Contraseña: $password</p>
            <p>Puedes acceder a la plataforma utilizando estas credenciales.</p>
        ";
        return Services::sendEmail($email, 'Credenciales de acceso - RackON', $cuerpo);
    }

    private function generarContrasena($longitud = 16)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $contrasena = '';
        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $contrasena;
    }

    public function verifyEmail()
    {
        $model = new UserModel();
        $token = $this->request->getGet('token');
        $user = $model->where('Token', $token)->first();

        if ($user) {
            $model->update($user['ID_Usuario'], ['Verificado' => 1, 'Token' => null]);

            // Recuperar datos de sesión
            $plainPassword = session()->get('plainPassword');
            $plainEmail = session()->get('plainEmail');
            $plainNombre = session()->get('plainNombre');

            // Verificar que los datos estén disponibles
            if (!empty($plainEmail) && !empty($plainPassword) && !empty($plainNombre)) {
                $this->enviarCredenciales($plainEmail, $plainNombre, $plainPassword);

                // Limpiar datos de sesión
                session()->remove('plainPassword');
                session()->remove('plainEmail');
                session()->remove('plainNombre');

                return redirect()->to('/')->with('success', 'Cuenta verificada correctamente. Credenciales enviadas por correo.');
            } else {
                log_message('error', '❌ Error: No se encontraron datos de sesión para enviar credenciales.');
                return redirect()->to('/')->with('error', 'Error al enviar las credenciales después de la verificación.');
            }
        }

        return redirect()->to('/')->with('error', 'Enlace de verificación inválido.');
    }

    public function registerUser()
    {
        $model = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
        $uid = $this->request->getPost('ID_Tarjeta');
        $rol = $this->request->getPost('ID_Rol');

        // Generar una contraseña segura y aleatoria
        $password = $this->generarContrasena();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $token = $this->generarToken();

        // Guardar el usuario en la base de datos con la contraseña hasheada
        $model->insertUser([
            'Nombre' => $nombre,
            'Email' => $email,
            'Contraseña' => $hashedPassword,
            'ID_Rol' => $rol,
            'ID_Tarjeta' => $uid,
            'Token' => $token,
            'Verificado' => 0
        ]);

        // Guardar la contraseña en sesión temporal para enviarla después de la verificación
        session()->set('plainPassword', $password);
        session()->set('plainEmail', $email);
        session()->set('plainNombre', $nombre);

        // Enviar el correo de verificación
        $this->enviarCorreoVerificacion($email, $token);
        return redirect()->to('/register')->with('success', 'Usuario creado. Verifica tu correo.');
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
