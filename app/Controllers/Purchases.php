<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{
    protected $format = 'json';

    public function generateEcode(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, 12));
    }

    public function generateRandomPassword($length = 10)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
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

            // 1. Insertar compra
            $insertId = $purchaseModel->insert($json, true);
            if (!$insertId) {
                return $this->failValidationErrors($purchaseModel->errors());
            }

            // 2. Insertar empresa con nombre + Ecode
            $ecode = $this->generateEcode();
            $idEmpresa = $empresaModel->insert([
                'nombre' => $json['company_name'],
                'Ecode'  => $ecode
            ], true);

            // 3. Crear usuario administrador principal
            $randomPass = $this->generateRandomPassword();
            $hashedPass = password_hash($randomPass, PASSWORD_BCRYPT);

            $idRolAdmin = 5;

            $idUser = $userModel->insertUser([
                'Nombre'        => $json['company_name'] . '_admin',
                'Contraseña'    => $hashedPass,
                'Email'         => $json['email'],
                'Ultimo_Acceso' => null,
                'ID_Rol'        => $idRolAdmin,
                'ID_Tarjeta'    => null,
                'Token'         => null,
                'Verificado'    => 1,
                'id_empresa'    => $idEmpresa
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->failServerError('Error al guardar datos relacionados');
            }

            // 4. Enviar email con datos de acceso
            $email = \Config\Services::email();
            $email->setTo($json['email']);
            $email->setSubject('Bienvenido a la plataforma');
            $email->setMessage("
                Hola {$json['company_name']} 👋,<br><br>
                Tu empresa fue registrada exitosamente.<br>
                Estos son tus datos de acceso:<br><br>
                <b>Usuario:</b> {$json['email']}<br>
                <b>Contraseña temporal:</b> {$randomPass}<br><br>
                Te recomendamos cambiar la contraseña en tu primer inicio de sesión.<br><br>
                Saludos,<br>Equipo RackON
            ");
            $email->send();

            return $this->respondCreated([
                'status'       => 'success',
                'message'      => 'Compra, empresa y usuario administrador creados exitosamente',
                'purchase_id'  => $insertId,
                'empresa_id'   => $idEmpresa,
                'usuario_id'   => $idUser,
                'ecode'        => $ecode
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}
