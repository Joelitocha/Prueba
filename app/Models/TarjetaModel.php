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
        'Horario_Uso',
        'id_empresa'
    ];
    public function getTarjetasPorEmpresa($idEmpresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('id_empresa', $idEmpresa)
                        ->get()
                        ->getResultArray();
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
        $update=$this->db->table($this->table);

        if($update->update($data, [$this->primaryKey => $id])){
            return true;
        }
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
