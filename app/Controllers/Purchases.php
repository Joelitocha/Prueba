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
        return bin2hex(random_bytes(4)); // 8 caracteres
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

        // Remover campos de timestamp para evitar conflictos con useTimestamps
        unset($json['created_at']);

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $purchaseModel = new PurchaseModel();
            $empresaModel  = new EmpresaModel();
            $userModel     = new UserModel();

            // 1️⃣ Guardar la compra
            $purchaseId = $purchaseModel->insert($json, true);
            if (!$purchaseId) {
                $db->transRollback();
                return $this->failValidationErrors($purchaseModel->errors());
            }

            // 2️⃣ Crear empresa con Ecode
            $ecode = $this->generateEcode();
            $empresaData = [
                'nombre' => $json['company_name'],
                'Ecode'  => $ecode
            ];
            $empresaId = $empresaModel->insert($empresaData, true);
            if (!$empresaId) {
                $db->transRollback();
                return $this->failValidationErrors($empresaModel->errors());
            }

            // Actualizar la compra con el empresa_id
            $updateResult = $purchaseModel->update($purchaseId, ['empresa_id' => $empresaId]);
            if (!$updateResult) {
                $db->transRollback();
                return $this->failServerError('Error al actualizar la compra con empresa_id');
            }

            // 3️⃣ Crear usuario asociado a la empresa
            $passwordPlain = $this->generatePassword();
            $userData = [
                'Email'       => $json['email'],
                'Contraseña'  => password_hash($passwordPlain, PASSWORD_DEFAULT),
                'ID_Rol'      => 2, // Suponiendo que 2 = Usuario
                'id_empresa'  => $empresaId,
                'Nombre'      => $json['contact_person'] ?? 'Cliente',
            ];
            $userId = $userModel->insert($userData, true);
            if (!$userId) {
                $db->transRollback();
                return $this->failValidationErrors($userModel->errors());
            }

            $db->transComplete();

        } catch (\Exception $e) {
            log_message('error', 'Purchases::save error: ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}
