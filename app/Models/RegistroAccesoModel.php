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
        'ID_Rack',
        'ID_Tarjeta'
    ];
    
    public function getPaginatedRecordsByEmpresa($idEmpresa, $perPage, $offset)
    {
        return $this->db->table($this->table)
            ->select('registro_acceso_rf.*, usuario.Nombre as Nombre_Usuario, usuario.Apellido as Apellido_Usuario, tarjeta_acceso.Codigo_Tarjeta')
            ->join('tarjeta_acceso', 'tarjeta_acceso.ID_Tarjeta = registro_acceso_rf.ID_Tarjeta')
            ->join('usuario', 'usuario.ID_Usuario = tarjeta_acceso.ID_Usuario')
            ->where('tarjeta_acceso.id_empresa', $idEmpresa)
            ->orderBy('registro_acceso_rf.Fecha_Hora', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
    }
    
    public function getTotalRecordsByEmpresa($idEmpresa)
    {
        return $this->db->table($this->table)
            ->join('tarjeta_acceso', 'tarjeta_acceso.ID_Tarjeta = registro_acceso_rf.ID_Tarjeta')
            ->join('usuario', 'usuario.ID_Usuario = tarjeta_acceso.ID_Usuario')
            ->where('tarjeta_acceso.id_empresa', $idEmpresa)
            ->countAllResults();
    }

    public function getRegisterwithoutphoto($rackId)
    {
        return $this->db->table($this->table)
            ->where(['Archivo_Video' => null, 'ID_Rack' => $rackId])
            ->get()
            ->getResultArray();
    }
    
    public function updateregistro($id, $archivo)
    {
        $table = $this->db->table('registro_acceso_rf');
        $table->where(['ID_Acceso' => $id]);
        $table->set(['Archivo_Video' => $archivo]);
        $table->update();
    }
}