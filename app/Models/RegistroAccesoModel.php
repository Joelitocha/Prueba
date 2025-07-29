<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroAccesoModel extends Model
{
    protected $table = 'registro_acceso_rf';
    protected $primaryKey = 'ID_Acceso';
    protected $returnType = 'array';
    protected $allowedFields = [
        'Fecha_Hora',
        'Resultado',
        'Accion_Tomada',
        'Archivo_Video',
        'Ubicacion_Camara',
        'ID_Sistema',
        'ID_Tarjeta'
    ];

    public function getPaginatedRecords($perPage, $offset)
    {
        return $this->orderBy('Fecha_Hora', 'DESC')
                    ->findAll($perPage, $offset);
    }

    public function getTotalRecords()
    {
        return $this->countAllResults();
    }

    public function getAllRecords()
    {
        return $this->db->table($this->table)
            ->select('registro_acceso_rf.*')
            ->join('tarjeta_acceso', 'tarjeta_acceso.ID_Tarjeta = registro_acceso_rf.ID_Tarjeta')
            ->where('tarjeta_acceso.id_empresa', $idEmpresa)
            ->orderBy('registro_acceso_rf.Fecha_Hora', 'DESC')
            ->get()
            ->getResultArray();
    }
}
