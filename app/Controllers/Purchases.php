<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{
    protected $format = 'json';

    private function generateEcode(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, 12));
    }

    private function generatePassword(): string
    {
        return bin2hex(random_bytes(4)); // Ej: "A1B2C3D4"
    }

    private function sendUserCredentials($toEmail, $tempPass, $ecode)
    {
        $email = \Config\Services::email();

        $email->setFrom('tu_correo@gmail.com', 'RackON Soporte');
        $email->setTo($toEmail);
        $email->setSubject('Bienvenido a RackON - Tus credenciales de acceso');

        $message = "
            <h2>Bienvenido a RackON</h2>
            <p>Se ha creado tu usuario con éxito. Aquí están tus credenciales:</p>
            <ul>
                <li><b>Email:</b> {$toEmail}</li>
                <li><b>Contraseña temporal:</b> {$tempPass}</li>
                <li><b>Ecode Empresa:</b> {$ecode}</li>
            </ul>
            <p>Por motivos de seguridad, te recomendamos cambiar tu contraseña al primer inicio de sesión.</p>
            <br>
            <p>Saludos,<br>Equipo RackON</p>
        ";

        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Error al enviar email: ' . print_r($email->printDebugger(['headers']), true));
            return false;
        }

        return true;
    }

    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->fail('Método no permitido', 405);
        }

        $json = $this->request->getJSON(true);

        if (!$json || empty($json['email']) || empty($json['company_name'])) {
            return $this->fail('Datos incompletos', 400);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $purchaseModel = new PurchaseModel();
            $empresaModel  = new EmpresaModel();
            $userModel     = new UserModel();

            // 1. Guardar la compra
            $purchaseId = $purchaseModel->insert($json, true);
            if (!$purchaseId) {
                return $this->failValidationErrors($purchaseModel->errors());
            }

            // 2. Crear empresa con Ecode
            $ecode = $this->generateEcode();
            $empresaId = $empresaModel->insert([
                'nombre' => $json['company_name'],
                'Ecode'  => $ecode
            ], true);

            // 3. Crear usuario vinculado a la empresa
            $rawPass = $this->generatePassword();
            $hashedPass = password_hash($rawPass, PASSWORD_DEFAULT);

            $userId = $userModel->insertUser([
                'Nombre'        => $json['company_name'] . ' Admin',
                'Email'         => $json['email'],
                'Contraseña'    => $hashedPass,
                'Ultimo_Acceso' => date('Y-m-d H:i:s'),
                'ID_Rol'        => 5, // Rol por defecto
                'Verificado'    => 1,
                'id_empresa'    => $empresaId
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->failServerError('Error al guardar datos relacionados');
            }

            // 4. Enviar correo con credenciales
            $this->sendUserCredentials($json['email'], $rawPass, $ecode);

            return $this->respondCreated([
                'status'       => 'success',
                'message'      => 'Compra, empresa y usuario registrados exitosamente',
                'purchase_id'  => $purchaseId,
                'empresa_id'   => $empresaId,
                'usuario_id'   => $userId,
                'ecode'        => $ecode,
                'temp_pass'    => $rawPass // opcional: debug
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}

