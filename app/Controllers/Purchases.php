<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Purchases extends ResourceController
{
    use ResponseTrait;

    public function save()
    {
        // Verificar que sea una petición AJAX
        if (!$this->request->isAJAX()) {
            return $this->fail('Método no permitido', 405);
        }

        // Obtener los datos JSON del request
        $json = $this->request->getJSON();
        
        // Validar datos requeridos
        if (!$json || !isset($json->email)) {
            return $this->fail('Datos incompletos', 400);
        }

        try {
            // Preparar datos para insertar en la base de datos
            $purchaseData = [
                'email' => $json->email,
                'company_name' => $json->company_name ?? '',
                'contact_person' => $json->contact_person ?? '',
                'phone' => $json->phone ?? '',
                'tax_id' => $json->tax_id ?? '',
                'quantity' => $json->quantity ?? 1,
                'device_total' => $json->device_total ?? 0,
                'support_plan' => $json->support_plan ?? 'monthly',
                'support_amount' => $json->support_amount ?? 0,
                'total_amount' => $json->total_amount ?? 0,
                'delivery_address' => $json->delivery_address ?? '',
                'delivery_city' => $json->delivery_city ?? '',
                'delivery_state' => $json->delivery_state ?? '',
                'delivery_zip' => $json->delivery_zip ?? '',
                'delivery_country' => $json->delivery_country ?? '',
                'payment_status' => $json->payment_status ?? 'completed',
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insertar en la base de datos
            $db = \Config\Database::connect();
            $builder = $db->table('purchases');
            
            $result = $builder->insert($purchaseData);
            $insertId = $db->insertID();

            if ($result) {
                // También puedes guardar en un log
                log_message('info', "Nueva compra registrada: {$json->email} - ID: {$insertId}");
                
                return $this->respondCreated([
                    'status' => 'success',
                    'message' => 'Compra registrada exitosamente',
                    'purchase_id' => $insertId
                ]);
            } else {
                return $this->fail('Error al guardar en la base de datos');
            }

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}