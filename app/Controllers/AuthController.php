<?php

namespace App\Controllers; 

use App\Models\UserModel; 
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
            // Verificar si hay sesión activa
    $session = \Config\Services::session();
    if ($session->get('logged_in')) {
        return redirect()->to('/bienvenido');
    }
        $data = [
            // SEO Solo para la página principal
            'meta_title' => "RackON - Control de Acceso con Tecnología RFID | Argentina",
            'meta_description' => "Sistema profesional de gestión de accesos mediante tarjetas RFID para empresas. Soluciones seguras en Buenos Aires.",
            'og_image' => base_url('assets/img/rackon-og.jpg'), // Imagen 1200x630px
            'canonical_url' => base_url()
        ];
        return view('landing/index', $data);
    }
    public function inicio(){
        return view("login");
    }
    public function loginUser()
    {
        // Limpiar sesión completamente antes de nuevo login
        session()->start();
        session()->regenerate(true);
    
        $model = new UserModel();
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Contraseña');
    
        $user = $model->where('Email', $email)->first();
    
        if ($user && password_verify($password, $user['Contraseña'])) {
            if ($user['Verificado'] == 0) {
                return redirect()->to('/login')->with('error', 'Cuenta no verificada');
            }
    
            $model->update($user['ID_Usuario'], ['Ultimo_Acceso' => date('Y-m-d H:i:s')]);
    
            // Establecer datos de sesión
            $sessionData = [
                "user_id"    => $user["ID_Usuario"],
                "logged_in"  => true, // Asegurar que es booleano
                "username"   => $user["Nombre"],
                "ID_Rol"     => $user["ID_Rol"],
                "ID_tarjeta" => $user["ID_Tarjeta"]
            ];
            
            session()->set($sessionData);
    
            // Verificación inmediata
            if (session()->get('logged_in') !== true) {
                log_message('error', 'Error crítico: No se pudo establecer sesión para '.$email);
                return redirect()->to('/login')->with('error', 'Error al iniciar sesión');
            }
    
            // Limpiar mensajes flash previos
            session()->removeTempdata('error');
    
            // Redirigir a URL previa o a bienvenido por defecto
            return redirect()->to(session()->get('redirect_url') ?? '/bienvenido');
        }
    
        return redirect()->to('/login')->with('error', 'Credenciales incorrectas');
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
                $user['Email'], 
                $user['Nombre'], 
                "Tu cuenta ha sido verificada correctamente. Ahora puedes iniciar sesión con tu email y la contraseña que acabas de establecer."
            );

            return redirect()->to('/login')->with('success', 'Registro completado. Ahora puedes iniciar sesión.');
        }

        return redirect()->to('/login')->with('error', 'Token inválido o expirado.');
    }

    public function registerUser()
    {
        $model = new UserModel();
        $nombre = $this->request->getPost('Nombre');
        $email = $this->request->getPost('Email');
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
            'Email' => $email,
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
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Por favor inicia sesión');
        }
        
        // Verificar rol para mostrar contenido específico
        $rol = $session->get('ID_Rol');
        if (!in_array($rol, [5, 6, 7])) {
            return redirect()->to('/login')->with('error', 'Rol no válido');
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
