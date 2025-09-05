<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertaModel extends Model
{

    public function insertAlerta($rack){

        $tabla=$this->db->table('alertas');

        $tabla->insert(['id_rack' => $rack]);

    }


}
