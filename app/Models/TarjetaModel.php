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
        'Horario_Uso'
    ];

    public function getAllTarjetas()
    {
        return $this->findAll();
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
        return $this->table->update($id, $data);
    }

    public function deleteTarjeta($id)
    {
        return $this->delete($id);
    }

    public function obtenerEstado($idTarjeta)
    {
        $tabla = $this->db->table("tarjeta_acceso");
        $tabla->where('ID_Tarjeta', $idTarjeta);
        return $tabla->get()->getResultArray();
    }
}
