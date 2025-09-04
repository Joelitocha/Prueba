<?php

namespace App\Models;

use CodeIgniter\Model;

class RackModel extends Model
{
    protected $table = 'rack';
    protected $primaryKey = 'ID_Rack';
    protected $allowedFields = ['Ubicacion', 'Estado'];
}
