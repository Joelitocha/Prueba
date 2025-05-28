<?php

namespace App\Controllers; 

use App\Models\UserModel; 
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        $session = Services::session();
    
        // Verificar sesión activa con mayor robustez
        if ($session->has('logged_in') && $session->get('logged_in') === true) {
            // Verificar que los datos mínimos de sesión existen
            if ($session->has('user_id') && $session->has('ID_Rol')) {
                return redirect()->to('/bienvenido')->withCookies();
            } else {
                // Sesión corrupta, limpiar y mostrar landing
                $session->destroy();
            }
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
        $model = new UserModel();
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Contraseña');
    
        $user = $model->where('Email', $email)->first();
    
        if ($user && password_verify($password, $user['Contraseña'])) {
            if ($user['Verificado'] == 0) {
                return redirect()->to('/login')->with('error', 'Cuenta no verificada. Por favor verifica tu email.');
            }
    
            // Actualizar último acceso
            $model->update($user['ID_Usuario'], ['Ultimo_Acceso' => date('Y-m-d H:i:s')]);
    
            // Regenerar la sesión de forma segura (solo después de login exitoso)
            session()->regenerate(true);
    
            // Configurar datos de sesión persistentes
            $sessionData = [
                "user_id"    => $user["ID_Usuario"],
                "logged_in"  => true,
                "username"   => $user["Nombre"],
                "ID_Rol"     => $user["ID_Rol"],
                "ID_tarjeta" => $user["ID_Tarjeta"],
                "last_activity" => time()
            ];
    
            session()->set($sessionData);
    
            // Verificación de sesión
            if (!session()->get('logged_in')) {
                log_message('error', 'Falló al establecer sesión para: ' . $email);
                return redirect()->to('/login')->with('error', 'Error técnico al iniciar sesión');
            }
    
            // Limpiar mensajes temporales
            session()->removeTempdata('error');
    
            // Redirección inteligente
            $redirectUrl = session()->get('redirect_url') ?? '/bienvenido';
            session()->remove('redirect_url'); // Limpiar después de usar
    
            return redirect()->to($redirectUrl);
        }
    
        return redirect()->to('/login')
               ->with('error', 'Email o contraseña incorrectos')
               ->withInput(); // Mantener el email en el formulario
    }
    

    private function generarToken()
    {
        return bin2hex(random_bytes(16));
    }
private function enviarCorreoVerificacion($email, $token)
    {
        $verificationLink = base_url("verify?token=" . $token);

        $cuerpo = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Verificación de Cuenta - RackON</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    font-family: Arial, sans-serif;
                    color: #333333;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 0 15px rgba(0,0,0,0.1);
                }
                .header {
                    background-color: #007bff; /* Color principal de RackON */
                    color: #ffffff;
                    padding: 20px;
                    text-align: center;
                }
                .header img {
                    max-width: 150px;
                    margin-bottom: 10px;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 30px;
                    line-height: 1.6;
                }
                .content h2 {
                    color: #007bff; /* Color principal de RackON */
                    font-size: 20px;
                }
                .content p {
                    margin-bottom: 15px;
                }
                .button-container {
                    text-align: center;
                    margin: 25px 0;
                }
                .button {
                    background-color: #28a745; /* Color del botón de acción */
                    color: #ffffff !important; /* Importante para anular estilos de cliente de correo */
                    padding: 12px 25px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 16px;
                    font-weight: bold;
                    display: inline-block;
                }
                .footer {
                    background-color: #f0f0f0;
                    color: #777777;
                    padding: 20px;
                    text-align: center;
                    font-size: 12px;
                }
                .footer p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='background-color: #f4f4f4;'>
                <tr>
                    <td align='center'>
                        <table class='container' width='100%' border='0' cellspacing='0' cellpadding='0' style='max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);'>
                            <tr>
                                <td class='header' style='background-color: #007bff; color: #ffffff; padding: 20px; text-align: center;'>
                                    <h1 style='margin: 0; font-size: 24px;'>RackON</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class='content' style='padding: 30px; line-height: 1.6;'>
                                    <h2 style='color: #007bff; font-size: 20px;'>¡Bienvenido a RackON!</h2>
                                    <p>Gracias por registrarte. Para completar tu registro y asegurar tu cuenta, por favor verifica tu dirección de correo electrónico haciendo clic en el botón de abajo:</p>
                                    <table width='100%' border='0' cellspacing='0' cellpadding='0' class='button-container' style='text-align: center; margin: 25px 0;'>
                                        <tr>
                                            <td align='center'>
                                                <a href='" . $verificationLink . "' class='button' style='background-color: #28a745; color: #ffffff !important; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: bold; display: inline-block;'>Verificar Mi Cuenta</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <p>Después de la verificación, podrás establecer tu contraseña y comenzar a utilizar nuestros servicios.</p>
                                    <p>Si no solicitaste esta cuenta o tienes alguna pregunta, por favor ignora este mensaje o contacta a nuestro equipo de soporte.</p>
                                    <p>¡El equipo de RackON!</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='footer' style='background-color: #f0f0f0; color: #777777; padding: 20px; text-align: center; font-size: 12px;'>
                                    <p>&copy; " . date("Y") . " RackON. Todos los derechos reservados.</p>
                                    <p>Este es un mensaje automático, por favor no respondas directamente a este correo.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ";
        return Services::sendEmail($email, 'Verificación de cuenta - RackON', $cuerpo);
    }

    private function enviarCredenciales($email, $nombre, $mensaje)
    {


        $cuerpo = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Cuenta Verificada - RackON</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    font-family: Arial, sans-serif;
                    color: #333333;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 0 15px rgba(0,0,0,0.1);
                }
                .header {
                    background-color: #007bff; /* Color principal de RackON */
                    color: #ffffff;
                    padding: 20px;
                    text-align: center;
                }
                .header img {
                    max-width: 150px;
                    margin-bottom: 10px;
                }
                .header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .content {
                    padding: 30px;
                    line-height: 1.6;
                }
                .content h2 {
                    color: #007bff; /* Color principal de RackON */
                    font-size: 20px;
                }
                .content p {
                    margin-bottom: 15px;
                }
                .highlight { /* Para el mensaje variable */
                    background-color: #e9ecef;
                    padding: 15px;
                    border-left: 4px solid #007bff;
                    margin: 20px 0;
                }
                .footer {
                    background-color: #f0f0f0;
                    color: #777777;
                    padding: 20px;
                    text-align: center;
                    font-size: 12px;
                }
                .footer p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='background-color: #f4f4f4;'>
                <tr>
                    <td align='center'>
                        <table class='container' width='100%' border='0' cellspacing='0' cellpadding='0' style='max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);'>
                            <tr>
                                <td class='header' style='background-color: #007bff; color: #ffffff; padding: 20px; text-align: center;'>
                                    <h1 style='margin: 0; font-size: 24px;'>RackON</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class='content' style='padding: 30px; line-height: 1.6;'>
                                    <h2 style='color: #007bff; font-size: 20px;'>¡Tu Cuenta Ha Sido Verificada Exitosamente!</h2>
                                    <p>Hola " . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . ",</p>
                                    <p>Nos complace informarte que tu cuenta en RackON ha sido verificada correctamente.</p>
                                    
                                    <div class='highlight' style='background-color: #e9ecef; padding: 15px; border-left: 4px solid #007bff; margin: 20px 0;'>
                                        <p style='margin:0;'><em>" . htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') . "</em></p>
                                    </div>
                                    
                                    <p>Ahora puedes acceder a la plataforma utilizando tu dirección de correo electrónico y la contraseña que estableciste.</p>
                                    <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>
                                    <p>¡Gracias por unirte a RackON!</p>
                                    <p>Atentamente,<br>El equipo de RackON</p>
                                </td>
                            </tr>
                            <tr>
                                <td class='footer' style='background-color: #f0f0f0; color: #777777; padding: 20px; text-align: center; font-size: 12px;'>
                                    <p>&copy; " . date("Y") . " RackON. Todos los derechos reservados.</p>
                                    <p>Este es un mensaje automático, por favor no respondas directamente a este correo.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
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
