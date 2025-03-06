<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'Usuario'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'ID_Usuario'; // Clave primaria de la tabla

    protected $useAutoIncrement = true; // Indica si la clave primaria es auto-incrementable

    protected $returnType     = 'array'; // Tipo de retorno para los resultados
    protected $useSoftDeletes = false; // Indica si se utilizarán eliminaciones suaves

    protected $allowedFields = ['Nombre', 'Contraseña', 'Email', 'Ultimo_Acceso', 'ID_Rol', 'ID_Tarjeta']; // Campos permitidos para operaciones de inserción y actualización

    protected $useTimestamps = false; // Indica si se utilizarán marcas de tiempo

    // Método para insertar un nuevo usuario
    public function insertUser($data)
    {
        return $this->db->table($this->table)->insert($data); // Inserta un nuevo usuario en la tabla
    }

    // Método para verificar si un usuario existe por su correo o nombre
    public function userExists($email, $nombre)
    {
        return $this->where('Email', $email)
                    ->orWhere('Nombre', $nombre)
                    ->first(); // Devuelve el primer usuario que coincide con el correo o nombre
    }

    // Método para obtener el nombre del rol según su ID
    public function getRoleName($id_rol)
    {
        $db = \Config\Database::connect(); // Conecta a la base de datos
        $query = $db->table('rol')->select('N_Rol')->where('ID_Rol', $id_rol)->get(); // Consulta el nombre del rol
        $result = $query->getRowArray(); // Obtiene el resultado como un array
        return $result ? $result['N_Rol'] : null; // Devuelve el nombre del rol o null si no existe
    }

    // Método para obtener todos los usuarios
    public function getUser()
    {
        $tabla = $this->db->table('usuario')->select('*'); // Selecciona todos los campos de la tabla 'usuario'
        $query = $tabla->get()->getResultArray(); // Obtiene todos los resultados como un array
        return $query; // Devuelve el array de usuarios
    }

    // Método para actualizar un usuario existente
    public function updateUser($id, $data)
    {
        $query = $this->db->table('usuario'); // Accede a la tabla 'usuario'
        $query->where(['ID_Usuario' => $id]); // Aplica una condición para buscar el usuario por ID
        $query->update($data); // Actualiza los datos del usuario
    }

    // Método para obtener un usuario específico por su ID
    public function getUserbyid($id)
    {
        $tabla = $this->db->table('usuario')->select('*'); // Selecciona todos los campos de la tabla 'usuario'
        $tabla->where(['ID_Usuario' => $id]); // Aplica una condición para buscar el usuario por ID
        $query = $tabla->get()->getResultArray(); // Obtiene el resultado como un array
        return $query; // Devuelve el usuario encontrado
    }

    // Método para eliminar un usuario
    public function deleteUser($id)
    {
        $builder = $this->db->table('usuario'); // Accede a la tabla 'usuario'
        $builder->where('ID_Usuario', $id); // Aplica una condición para buscar el usuario por ID
        return $builder->delete(); // Elimina el usuario de la tabla
    }
}
?>