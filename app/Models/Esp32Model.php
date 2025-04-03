<?php

namespace App\Models;

use CodeIgniter\Model;

class Esp32Model extends Model
{
    // Método para insertar un registro en la tabla 'registro_acceso_rf' utilizando el ID de la tarjeta
    public function insertar_registro($id)
    {
        // Obtiene la tabla 'registro_acceso_rf' desde la base de datos
        $table = $this->db->table('registro_acceso_rf');
        
        // Busca la tarjeta correspondiente al ID proporcionado
        $tarjeta = $this->buscar_id($id);
        
        // Prepara los datos a insertar
        $data = array(
            "Resultado" => $tarjeta[0]["Estado"],                      // Resultado del acceso (1 = permitido)
            "Accion_Tomada" => NULL,               // Acción tomada (sin especificar en este caso)
            "Fecha_Hora_Grabacion" => NULL,        // Fecha y hora de grabación (sin especificar en este caso)
            "Archivo_Video" => NULL,                // Archivo de video relacionado (sin especificar en este caso)
            "Ubicacion_Camara" => NULL,            // Ubicación de la cámara (sin especificar en este caso)
            "ID_Sistema" => NULL,                  // ID del sistema (sin especificar en este caso)
            "ID_Tarjeta" => $tarjeta[0]["ID_Tarjeta"] // ID de la tarjeta encontrada
        );

        // Inserta el registro en la tabla
        $table->insert($data);
    }

    // Método para buscar una tarjeta en la tabla 'tarjeta_acceso' utilizando su UID
    public function buscar_id($id)
    {
        // Obtiene la tabla 'tarjeta_acceso' desde la base de datos
        $table = $this->db->table('tarjeta_acceso');
        
        // Aplica una condición para buscar la tarjeta con el UID proporcionado
        $table->where(["UID" => $id]);
        
        // Devuelve el resultado de la búsqueda como un array
        return $table->get()->getResultArray();
    }
}
?>