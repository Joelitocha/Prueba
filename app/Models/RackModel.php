<?php

namespace App\Models;

use CodeIgniter\Model;

class RackModel extends Model
{
    protected $table = 'rack';
    protected $primaryKey = 'ID_Rack';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'ID_Rack',
        'Ubicacion',
        'Estado',
        'id_empresa'
    ];

    // Obtener todos los racks de una empresa
    public function getRacksPorEmpresa($idEmpresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('id_empresa', $idEmpresa)
                        ->get()
                        ->getResultArray();
    }

    // Obtener un rack específico pero validando que sea de la empresa
    public function getRackByIdAndEmpresa($id, $idEmpresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('ID_Rack', $id)
                        ->where('id_empresa', $idEmpresa)
                        ->get()
                        ->getRowArray();
    }
}
