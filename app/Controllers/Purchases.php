<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use App\Models\UserModel;
use CodeIgniter\Email\Email;

class Purchases extends BaseController
{
    protected $validation;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->validation = \Config\Services::validation();
    }

    /**
     * Genera un Ecode aleatorio
     */
    private function generateEcode(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, 12));
    }

    /**
     * Función principal para guardar la compra
     */
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

            // 3. Crear usuario para la empresa y enviar mail
            $this->createUserForCompany([
                'email'      => $json['email'],
                'company_id' => $idEmpresa,
                'ecode'      => $ecode
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->failServerError('Error al guardar datos relacionados');
            }

            return $this->respondCreated([
                'status'       => 'success',
                'message'      => 'Compra, empresa y usuario registradas exitosamente',
                'purchase_id'  => $insertId,
                'empresa_id'   => $idEmpresa,
                'ecode'        => $ecode
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }

    /**
     * Crea un usuario asociado a la empresa y envía mail con credenciales
     */
    private function createUserForCompany(array $data)
    {
        $userModel = new UserModel();

        // Generar contraseña aleatoria
        $password = substr(bin2hex(random_bytes(4)), 0, 8);

        $userData = [
            'email'     => $data['email'],
            'id_empresa'=> $data['company_id'],
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'role_id'   => 2 // Supongamos que 2 = Usuario estándar
        ];

        $userModel->insert($userData);

        // Enviar email
        $email = \Config\Services::email();

        $email->setTo($data['email']);
        $email->setSubject('Tus credenciales de RackON');
        $email->setMessage("Hola,\n\nTu usuario ha sido creado para la empresa. \nEcode: {$data['ecode']}\nEmail: {$data['email']}\nContraseña: {$password}\n\nSaludos,\nRackON");

        $email->send();
    }
}
