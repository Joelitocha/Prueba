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

    /**
     * Obtener todos los racks de una empresa
     */
    public function getRacksPorEmpresa($idEmpresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('id_empresa', $idEmpresa)
                        ->get()
                        ->getResultArray();
    }

    /**
     * Obtener un rack específico validando que pertenezca a una empresa
     */
    public function getRackByIdAndEmpresa($id, $idEmpresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('ID_Rack', $id)
                        ->where('id_empresa', $idEmpresa)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Insertar un nuevo rack
     */
    public function insertRack($ubicacion, $estado, $idEmpresa)
    {
        $data = [
            'Ubicacion'  => $ubicacion,
            'Estado'     => $estado,
            'id_empresa' => $idEmpresa
        ];
    
        return $this->db->table($this->table)->insert($data);
    }

    /**
     * Racks con la cantidad de dispositivos asociados (filtrados por empresa)
     */
    public function getRacksConDispositivos($idEmpresa)
    {
        return $this->select('rack.*, COUNT(dispositivo.ID_Sistema) as cantidad_dispositivos')
                    ->join('dispositivo', 'dispositivo.ID_Rack = rack.ID_Rack', 'left')
                    ->where('rack.id_empresa', $idEmpresa)
                    ->groupBy('rack.ID_Rack')
                    ->findAll();
    }
}
