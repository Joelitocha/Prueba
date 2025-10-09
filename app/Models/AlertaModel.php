<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertaModel extends Model
{
    protected $table = 'alertas';
    protected $primaryKey = 'id_alerta';
    protected $allowedFields = ['id_rack', 'fecha'];

    public function insertAlerta($rack)
    {
        $this->db->table('alertas')->insert(['id_rack' => $rack]);
    }

    public function getAlertasByEmpresa($id_empresa)
    {
        $builder = $this->db->table('alertas a');
        $builder->select('a.*, r.id_empresa, e.nombre AS nombre_empresa, r.id_rack');
        $builder->join('rack r', 'a.id_rack = r.id_rack');
        $builder->join('empresa e', 'r.id_empresa = e.id_empresa');
        $builder->where('r.id_empresa', $id_empresa);
        $builder->orderBy('a.fecha', 'DESC');

        return $builder->get()->getResultArray();
    }
    public function getAlertasByEmpresaPaginadas($id_empresa, $perPage = 10)
    {
        return $this->select('alertas.*, rack.id_empresa, empresa.nombre AS nombre_empresa')
                ->join('rack', 'alertas.id_rack = rack.id_rack')
                ->join('empresa', 'rack.id_empresa = empresa.id_empresa')
                ->where('rack.id_empresa', $id_empresa)
                ->orderBy('alertas.fecha', 'DESC')
                ->paginate($perPage);
    }

}

