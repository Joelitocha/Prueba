<?php

namespace App\Models;

use CodeIgniter\Model;

class RackModel extends Model
{
    protected $table = 'rack';
    protected $primaryKey = 'ID_Rack';
    protected $allowedFields = ['Ubicacion', 'Estado', 'id_empresa'];

    // Obtener racks filtrados por empresa
    public function getRacksByEmpresa($idEmpresa)
    {
        return $this->where('id_empresa', $idEmpresa)->findAll();
    }

    // Insertar un rack con empresa
    public function insertRack($ubicacion, $estado, $id_empresa)
    {
        $data = [
            'Ubicacion'  => $ubicacion,
            'Estado'     => $estado,
            'id_empresa' => $id_empresa
        ];
        return $this->db->table('rack')->insert($data);
    }

    // Racks con dispositivos contados, filtrados por empresa
    public function getRacksConDispositivos($idEmpresa)
    {
        return $this->select('rack.*, COUNT(dispositivo.ID_Sistema) as cantidad_dispositivos')
                    ->join('dispositivo', 'dispositivo.ID_Rack = rack.ID_Rack', 'left')
                    ->where('rack.id_empresa', $idEmpresa)
                    ->groupBy('rack.ID_Rack')
                    ->findAll();
    }
}
