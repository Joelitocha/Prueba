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
}

