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
    public function getTarjetasPorEmpresa($idEmpresa)
    {
        return $this->db->table('tarjeta_acceso')
            ->select('tarjeta_acceso.*, usuario.Nombre as nombre_usuario')
            ->join('usuario', 'usuario.ID_Tarjeta = tarjeta_acceso.ID_Tarjeta')
            ->where('usuario.ID_Empresa', $idEmpresa)
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
