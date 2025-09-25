<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{
    protected $format = 'json';

    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->fail('Método no permitido', 405);
        }

        $json = $this->request->getJSON(true); // true = array asociativo

        if (!$json || empty($json['email'])) {
            return $this->fail('Datos incompletos', 400);
        }

        try {
            $purchaseModel = new PurchaseModel();

            // Insertar y obtener ID
            $insertId = $purchaseModel->insert($json, true);

            if ($insertId) {
                log_message('info', "Nueva compra registrada: {$json['email']} - ID: {$insertId}");

                return $this->respondCreated([
                    'status'      => 'success',
                    'message'     => 'Compra registrada exitosamente',
                    'purchase_id' => $insertId
                ]);
            } else {
                // Mostrar errores de validación del modelo
                return $this->failValidationErrors($purchaseModel->errors());
            }

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}
