<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table            = 'empresa';
    protected $primaryKey       = 'id_empresa';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['nombre', 'Ecode'];
    public    $timestamps       = false; // tu tabla no tiene created_at / updated_at

    // Validación simple
    protected $validationRules = [
        'nombre' => 'required|max_length[100]'
    ];

    public function getEmpresaDataById($id_empresa)
    {
        return $this->select('nombre, Ecode')
                    ->where('id_empresa', $id_empresa)
                    ->first(); 
    }

}
