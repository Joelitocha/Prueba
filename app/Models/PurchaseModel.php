<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    // Campos permitidos para insert/update
    protected $allowedFields    = [
        'email',
        'company_name',
        'contact_person',
        'phone',
        'tax_id',
        'quantity',
        'device_total',
        'support_plan',
        'support_amount',
        'total_amount',
        'delivery_address',
        'delivery_city',
        'delivery_state',
        'delivery_zip',
        'delivery_country',
        'payment_status',
        'empresa_id'
    ];

    // Manejo automático de timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validaciones básicas
    protected $validationRules = [
        'email'         => 'required|valid_email|max_length[255]',
        'quantity'      => 'required|integer|greater_than[0]',
        'device_total'  => 'decimal|greater_than_equal_to[0]',
        'support_plan'  => 'in_list[monthly,annual]',
        'support_amount'=> 'decimal|greater_than_equal_to[0]',
        'total_amount'  => 'decimal|greater_than_equal_to[0]'
    ];

    protected $validationMessages = [
        'email' => [
            'required'    => 'El correo es obligatorio',
            'valid_email' => 'El correo no es válido'
        ],
        'quantity' => [
            'greater_than' => 'La cantidad debe ser mayor que 0'
        ]
    ];

    protected $skipValidation = false;

    //Obtener todas las compras, ordenadas por fecha descendente.
    public function getAllPurchases()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    //Obtener compras paginadas (ej: para tablas grandes).
    public function getPaginatedPurchases(int $perPage = 10)
    {
        return $this->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    //Buscar compras por email.
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    //Actualizar estado de pago de una compra.
    public function updatePaymentStatus(int $id, string $status)
    {
        return $this->update($id, ['payment_status' => $status]);
    }

    //Eliminar una compra por ID.
    public function deletePurchase(int $id)
    {
        return $this->delete($id);
    }
}
