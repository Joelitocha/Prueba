<?php

namespace App\Models;

use CodeIgniter\Model;

class TarjetaModel extends Model
{
    protected $table = 'tarjeta_acceso';
    protected $primaryKey = 'ID_Tarjeta';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'ID_Tarjeta', 
        'Estado', 
        'Fecha_emision', 
        'UID',
        'Fecha_Expiracion',
        'Intentos_Fallidos',
        'id_empresa'
    ];

    public function getTarjetasPorEmpresa($idEmpresa)
    {
        return $this->where('id_empresa', $idEmpresa)->findAll();
    }

    public function getTarjetaById($id)
    {
        return $this->find($id);
    }

    public function insertTarjeta($data)
    {
        return $this->insert($data);
    }

    public function updateTarjeta($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTarjeta($id)
    {
        return $this->delete($id);
    }

    public function obtenerEstado($idTarjeta)
    {
        return $this->find($idTarjeta); // devuelve directamente UNA tarjeta
    }
}

