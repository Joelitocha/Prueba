<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'ID_Usuario';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'Nombre', 
        'Contraseña', 
        'Email', 
        'Ultimo_Acceso', 
        'ID_Rol', 
        'ID_Tarjeta', 
        'Token', 
        'Verificado', 
        'id_empresa'
    ];
    protected $useTimestamps = false;

    public function insertUser($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID(); // Devuelve el ID del nuevo usuario
    }
    

    public function userExists($email, $nombre)
    {
        return $this->where('Email', $email)
                    ->orWhere('Nombre', $nombre)
                    ->first();
    }

    public function getRoleName($id_rol)
    {
        $db = \Config\Database::connect();
        $query = $db->table('rol')->select('N_Rol')->where('ID_Rol', $id_rol)->get();
        $result = $query->getRowArray();
        return $result ? $result['N_Rol'] : null;
    }

    public function getUserByEmpresa($id_empresa)
    {
        return $this->db->table($this->table)
                        ->select('*')
                        ->where('id_empresa', $id_empresa)
                        ->get()
                        ->getResultArray();
    }
    
    public function updateUser($id, $data)
    {
        return $this->db->table($this->table)
                        ->where(['ID_Usuario' => $id])
                        ->update($data);
    }

    public function getUserbyid($id)
    {
        $tabla = $this->db->table('usuario')->select('*');
        $tabla->where(['ID_Usuario' => $id]);
        $query = $tabla->get()->getResultArray();
        return $query;
    }

    public function deleteUser($id)
    {
        $builder = $this->db->table('usuario');
        $builder->where('ID_Usuario', $id);
        return $builder->delete();
    }
}
