<?php

namespace App\Models;

use CodeIgniter\Model;

class RackModel extends Model
{
    protected $table = 'rack';
    protected $primaryKey = 'ID_Rack';
    protected $allowedFields = ['Ubicacion', 'Estado'];


        // Función para insertar un rack
        public function insertRack($ubicacion, $estado)
        {
            $data = [
                'ubicacion' => $ubicacion,
                'estado'    => $estado
            ];
    
            return $this->insert($data);
        }
    
        // Función para obtener racks con dispositivos contados (opcional)
        public function getRacksConDispositivos()
        {
            return $this->select('rack.*, COUNT(dispositivo.ID_Sistema) as cantidad_dispositivos')
                        ->join('dispositivo', 'dispositivo.ID_Rack = rack.ID_Rack', 'left')
                        ->groupBy('rack.ID_Rack')
                        ->findAll();
        }
}