<?php

namespace App\Models;

use CodeIgniter\Model;

class TarjetaModel extends Model
{
    protected $table = 'tarjeta_acceso'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'ID_Tarjeta'; // Clave primaria de la tabla
    protected $useAutoIncrement = true; // Indica si la clave primaria es auto-incrementable
    
    protected $allowedFields = ['ID_Tarjeta', 'Estado', 'Fecha_emision', 'UID']; // Campos permitidos para operaciones de inserción y actualización

    // Método para obtener todas las tarjetas
    public function getAllTarjetas()
    {
        return $this->findAll(); // Devuelve todas las filas de la tabla
    }

    // Método para obtener una tarjeta específica por su ID
    public function getTarjetaById($id)
    {
        return $this->find($id); // Devuelve una tarjeta según el ID proporcionado
    }

    // Método para insertar una nueva tarjeta
    public function insertTarjeta($data)
    {
        return $this->insert($data); // Inserta una nueva tarjeta en la tabla
    }

    // Método para actualizar una tarjeta existente
    public function updateTarjeta($id, $data)
    {
        return $this->update($id, $data); // Actualiza una tarjeta según el ID y los datos proporcionados
    }

    // Método para eliminar una tarjeta
    public function deleteTarjeta($id)
    {
        return $this->delete($id); // Elimina una tarjeta según el ID proporcionado
    }

    // Función para obtener el estado de la tarjeta según su ID
    public function obtenerEstado($idTarjeta)
    {
        $tabla = $this->db->table("tarjeta_acceso"); // Accede a la tabla 'tarjeta_acceso'
        $tabla->where('ID_Tarjeta', $idTarjeta); // Aplica una condición para buscar la tarjeta por ID
        return $tabla->get()->getResultArray(); // Devuelve el resultado de la búsqueda como un array
    }
}
?>