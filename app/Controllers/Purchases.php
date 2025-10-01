<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{
    protected $format = 'json';

    public function generateEcode(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, 12));
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

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->failServerError('Error al guardar datos relacionados');
            }

            return $this->respondCreated([
                'status'       => 'success',
                'message'      => 'Compra y empresa registradas exitosamente',
                'purchase_id'  => $insertId,
                'empresa_id'   => $idEmpresa,
                'ecode'        => $ecode
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}
